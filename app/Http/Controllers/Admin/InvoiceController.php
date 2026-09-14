<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Package;
use App\Models\Setting;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Invoice::with(['items', 'package'])->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('package_name', 'like', "%{$search}%");
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Date Filter
        if ($request->filled('date_from')) {
            $query->whereDate('invoice_date', '>=', $request->input('date_from'));
        }
        if ($request->filled('date_to')) {
            $query->whereDate('invoice_date', '<=', $request->input('date_to'));
        }

        $invoices = $query->paginate(4)->withQueryString();

        // Summary Statistics
        $stats = [
            'total_count' => Invoice::count(),
            'total_amount' => (float) Invoice::where('status', '!=', 'CANCELLED')->sum('total_amount'),
            'total_paid' => (float) Invoice::where('status', '!=', 'CANCELLED')->sum('paid_amount'),
            'total_remaining' => (float) Invoice::where('status', '!=', 'CANCELLED')->sum('remaining_amount'),
            'paid_count' => Invoice::where('status', 'PAID')->count(),
            'partial_count' => Invoice::where('status', 'PARTIAL')->count(),
            'unpaid_count' => Invoice::where('status', 'UNPAID')->count(),
        ];

        return view('admin.invoices.index', compact('invoices', 'stats'));
    }

    public function create(Request $request): View
    {
        $nextInvoiceNumber = Invoice::generateInvoiceNumber();
        $packages = Package::where('status', 'PUBLISHED')->orderBy('name')->get();
        $settings = Setting::all()->pluck('value', 'key');

        // Pre-fill from package if package_id passed in query
        $selectedPackage = null;
        if ($request->filled('package_id')) {
            $selectedPackage = Package::find($request->input('package_id'));
        }

        // Default bank payment details
        $defaultBankDetails = "BCA: 123-456-7890 (a/n Puja Tour & Travel)\nMandiri: 177-00-1234567-8 (a/n Puja Tour & Travel)\nBRI: 0123-01-001234-50-1 (a/n Puja Tour & Travel)\nQRIS: Tersedia (Scan via e-Wallet / Mobile Banking)";

        $defaultNotes = "1. Pembayaran DP minimal 30% untuk konfirmasi jadwal reservasi.\n2. Pelunasan sisa pembayaran dapat dilakukan H-1 sebelum keberangkatan atau saat tiba di meeting point.\n3. Harap konfirmasi bukti transfer via WhatsApp Official kami.";

        return view('admin.invoices.create', compact(
            'nextInvoiceNumber',
            'packages',
            'settings',
            'selectedPackage',
            'defaultBankDetails',
            'defaultNotes'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'invoice_number' => ['required', 'string', 'max:60', 'unique:invoices,invoice_number'],
            'invoice_date' => ['required', 'date'],
            'due_date' => ['nullable', 'date'],
            'travel_date' => ['nullable', 'date'],
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_email' => ['nullable', 'email', 'max:150'],
            'customer_address' => ['nullable', 'string'],
            'package_id' => ['nullable', 'exists:packages,id'],
            'package_name' => ['nullable', 'string', 'max:150'],
            'pax_count' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:UNPAID,PARTIAL,PAID,CANCELLED'],
            'payment_method' => ['nullable', 'string', 'max:100'],
            'bank_details' => ['nullable', 'string'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'paid_amount' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'admin_notes' => ['nullable', 'string'],
            
            // Items
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit' => ['nullable', 'string', 'max:50'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::beginTransaction();
        try {
            // Calculate Financials
            $subtotal = 0;
            $itemsData = [];
            foreach ($validated['items'] as $index => $item) {
                $itemQty = (float) $item['quantity'];
                $itemPrice = (float) $item['price'];
                $itemSubtotal = round($itemQty * $itemPrice, 2);
                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'quantity' => $itemQty,
                    'unit' => $item['unit'] ?? 'pax',
                    'price' => $itemPrice,
                    'subtotal' => $itemSubtotal,
                    'display_order' => $index + 1,
                ];
            }

            $discount = (float) ($validated['discount'] ?? 0);
            $subtotalAfterDiscount = max(0, $subtotal - $discount);

            $taxPercent = (float) ($validated['tax_percent'] ?? 0);
            $taxAmount = round(($subtotalAfterDiscount * $taxPercent) / 100, 2);

            $totalAmount = round($subtotalAfterDiscount + $taxAmount, 2);

            $paidAmount = (float) ($validated['paid_amount'] ?? 0);
            $status = $validated['status'];

            // Auto sync status based on paid amount if not cancelled
            if ($status !== 'CANCELLED') {
                if ($paidAmount >= $totalAmount && $totalAmount > 0) {
                    $status = 'PAID';
                    $paidAmount = $totalAmount;
                } elseif ($paidAmount > 0) {
                    $status = 'PARTIAL';
                } else {
                    $status = 'UNPAID';
                }
            }

            $remainingAmount = max(0, $totalAmount - $paidAmount);

            $invoice = Invoice::create([
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'] ?? null,
                'travel_date' => $validated['travel_date'] ?? null,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'customer_address' => $validated['customer_address'] ?? null,
                'package_id' => $validated['package_id'] ?? null,
                'package_name' => $validated['package_name'] ?? ($itemsData[0]['item_name'] ?? null),
                'pax_count' => $validated['pax_count'] ?? 1,
                'status' => $status,
                'payment_method' => $validated['payment_method'] ?? null,
                'bank_details' => $validated['bank_details'] ?? null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax_percent' => $taxPercent,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'notes' => $validated['notes'] ?? null,
                'admin_notes' => $validated['admin_notes'] ?? null,
                'created_by' => Auth::id(),
            ]);

            foreach ($itemsData as $item) {
                $invoice->items()->create($item);
            }

            DB::commit();

            ActivityLogger::log('CREATE', 'Invoice', "Menerbitkan invoice baru #{$invoice->invoice_number} untuk {$invoice->customer_name}", [
                'id' => $invoice->id,
                'total' => $invoice->total_amount,
                'status' => $invoice->status,
                'customer' => $invoice->customer_name,
            ]);

            return redirect()->route('admin.invoices.show', $invoice->id)
                ->with('success', "Invoice {$invoice->invoice_number} berhasil dibuat!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['items', 'package', 'creator']);
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.invoices.show', compact('invoice', 'settings'));
    }

    public function edit(Invoice $invoice): View
    {
        $invoice->load('items');
        $packages = Package::where('status', 'PUBLISHED')->orderBy('name')->get();
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.invoices.edit', compact('invoice', 'packages', 'settings'));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $validated = $request->validate([
            'invoice_number' => ['required', 'string', 'max:60', 'unique:invoices,invoice_number,' . $invoice->id],
            'invoice_date' => ['required', 'date'],
            'due_date' => ['nullable', 'date'],
            'travel_date' => ['nullable', 'date'],
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_email' => ['nullable', 'email', 'max:150'],
            'customer_address' => ['nullable', 'string'],
            'package_id' => ['nullable', 'exists:packages,id'],
            'package_name' => ['nullable', 'string', 'max:150'],
            'pax_count' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:UNPAID,PARTIAL,PAID,CANCELLED'],
            'payment_method' => ['nullable', 'string', 'max:100'],
            'bank_details' => ['nullable', 'string'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax_percent' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'paid_amount' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'admin_notes' => ['nullable', 'string'],
            
            // Items
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_name' => ['required', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit' => ['nullable', 'string', 'max:50'],
            'items.*.price' => ['required', 'numeric', 'min:0'],
        ]);

        DB::beginTransaction();
        try {
            $subtotal = 0;
            $itemsData = [];
            foreach ($validated['items'] as $index => $item) {
                $itemQty = (float) $item['quantity'];
                $itemPrice = (float) $item['price'];
                $itemSubtotal = round($itemQty * $itemPrice, 2);
                $subtotal += $itemSubtotal;

                $itemsData[] = [
                    'item_name' => $item['item_name'],
                    'description' => $item['description'] ?? null,
                    'quantity' => $itemQty,
                    'unit' => $item['unit'] ?? 'pax',
                    'price' => $itemPrice,
                    'subtotal' => $itemSubtotal,
                    'display_order' => $index + 1,
                ];
            }

            $discount = (float) ($validated['discount'] ?? 0);
            $subtotalAfterDiscount = max(0, $subtotal - $discount);

            $taxPercent = (float) ($validated['tax_percent'] ?? 0);
            $taxAmount = round(($subtotalAfterDiscount * $taxPercent) / 100, 2);

            $totalAmount = round($subtotalAfterDiscount + $taxAmount, 2);

            $paidAmount = (float) ($validated['paid_amount'] ?? 0);
            $status = $validated['status'];

            if ($status !== 'CANCELLED') {
                if ($paidAmount >= $totalAmount && $totalAmount > 0) {
                    $status = 'PAID';
                    $paidAmount = $totalAmount;
                } elseif ($paidAmount > 0) {
                    $status = 'PARTIAL';
                } else {
                    $status = 'UNPAID';
                }
            }

            $remainingAmount = max(0, $totalAmount - $paidAmount);

            $invoice->update([
                'invoice_number' => $validated['invoice_number'],
                'invoice_date' => $validated['invoice_date'],
                'due_date' => $validated['due_date'] ?? null,
                'travel_date' => $validated['travel_date'] ?? null,
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? null,
                'customer_address' => $validated['customer_address'] ?? null,
                'package_id' => $validated['package_id'] ?? null,
                'package_name' => $validated['package_name'] ?? ($itemsData[0]['item_name'] ?? null),
                'pax_count' => $validated['pax_count'] ?? 1,
                'status' => $status,
                'payment_method' => $validated['payment_method'] ?? null,
                'bank_details' => $validated['bank_details'] ?? null,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'tax_percent' => $taxPercent,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'remaining_amount' => $remainingAmount,
                'notes' => $validated['notes'] ?? null,
                'admin_notes' => $validated['admin_notes'] ?? null,
            ]);

            // Recreate items
            $invoice->items()->delete();
            foreach ($itemsData as $item) {
                $invoice->items()->create($item);
            }

            DB::commit();

            ActivityLogger::log('UPDATE', 'Invoice', "Memperbarui data invoice #{$invoice->invoice_number} ({$invoice->customer_name})", [
                'id' => $invoice->id,
                'total' => $invoice->total_amount,
                'status' => $invoice->status,
            ]);

            return redirect()->route('admin.invoices.show', $invoice->id)
                ->with('success', "Invoice {$invoice->invoice_number} berhasil diperbarui!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $num = $invoice->invoice_number;
        $invoice->delete();

        ActivityLogger::log('DELETE', 'Invoice', "Menghapus invoice #{$num}");

        return redirect()->route('admin.invoices.index')
            ->with('success', "Invoice {$num} berhasil dihapus.");
    }

    public function print(Invoice $invoice): View
    {
        $invoice->load(['items', 'package', 'creator']);
        $settings = Setting::all()->pluck('value', 'key');

        return view('admin.invoices.print', compact('invoice', 'settings'));
    }

    public function updateStatus(Request $request, Invoice $invoice): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:UNPAID,PARTIAL,PAID,CANCELLED'],
            'paid_amount' => ['nullable', 'numeric', 'min:0'],
        ]);

        $status = $validated['status'];
        $paidAmount = isset($validated['paid_amount']) ? (float) $validated['paid_amount'] : $invoice->paid_amount;

        if ($status === 'PAID') {
            $paidAmount = $invoice->total_amount;
        } elseif ($status === 'UNPAID') {
            $paidAmount = 0;
        }

        $remainingAmount = max(0, $invoice->total_amount - $paidAmount);

        $invoice->update([
            'status' => $status,
            'paid_amount' => $paidAmount,
            'remaining_amount' => $remainingAmount,
        ]);

        ActivityLogger::log('UPDATE_STATUS', 'Invoice', "Mengubah status pembayaran invoice #{$invoice->invoice_number} menjadi {$status}", [
            'id' => $invoice->id,
            'status' => $status,
            'paid_amount' => $paidAmount,
            'remaining_amount' => $remainingAmount,
        ]);

        return back()->with('success', "Status Invoice {$invoice->invoice_number} berhasil diubah menjadi {$invoice->status_label}!");
    }
}
