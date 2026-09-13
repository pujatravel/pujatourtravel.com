<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InvoicePublicController extends Controller
{
    public function show(string $invoice_number): View
    {
        $invoice = Invoice::with(['items', 'package'])
            ->where('invoice_number', $invoice_number)
            ->firstOrFail();

        $settings = Setting::all()->pluck('value', 'key');

        return view('pages.invoice-public', compact('invoice', 'settings'));
    }
}
