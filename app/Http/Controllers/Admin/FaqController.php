<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $this->normalizeOrders();

        $faqs = Faq::orderBy('display_order')->orderBy('id')->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated): void {
            $totalFaqs = Faq::count();
            $requestedOrder = isset($validated['display_order'])
                ? (int) $validated['display_order']
                : ($totalFaqs + 1);

            if ($requestedOrder <= $totalFaqs) {
                // Geser semua FAQ yang display_order >= requestedOrder turun +1
                Faq::where('display_order', '>=', $requestedOrder)->increment('display_order');
            } else {
                $requestedOrder = $totalFaqs + 1;
            }

            Faq::create([
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'display_order' => $requestedOrder,
                'is_published' => true,
            ]);

            $this->normalizeOrders();
        });

        return back()->with('success', 'Pertanyaan FAQ baru berhasil ditambahkan!');
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:1'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $request, $faq): void {
            $oldOrder = (int) $faq->display_order;
            $totalFaqs = Faq::count();
            $newOrder = isset($validated['display_order']) ? (int) $validated['display_order'] : $oldOrder;

            // Batasi newOrder di antara 1 dan totalFaqs
            $newOrder = max(1, min($newOrder, $totalFaqs));

            if ($newOrder !== $oldOrder) {
                if ($newOrder < $oldOrder) {
                    // Misal urutan 5 mau ke 1:
                    // FAQ urutan [1..4] bergeser turun (+1) menjadi [2..5]
                    Faq::where('id', '!=', $faq->id)
                        ->where('display_order', '>=', $newOrder)
                        ->where('display_order', '<', $oldOrder)
                        ->increment('display_order');
                } else {
                    // Misal urutan 1 mau ke 5:
                    // FAQ urutan [2..5] bergeser naik (-1) menjadi [1..4]
                    Faq::where('id', '!=', $faq->id)
                        ->where('display_order', '>', $oldOrder)
                        ->where('display_order', '<=', $newOrder)
                        ->decrement('display_order');
                }
            }

            $faq->update([
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'display_order' => $newOrder,
                'is_published' => $request->has('is_published') ? $request->boolean('is_published') : $faq->is_published,
            ]);

            $this->normalizeOrders();
        });

        return back()->with('success', 'Pertanyaan FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        DB::transaction(function () use ($faq): void {
            $deletedOrder = (int) $faq->display_order;
            $faq->delete();

            // Geser FAQ setelahnya naik (-1) agar tidak bolong
            Faq::where('display_order', '>', $deletedOrder)->decrement('display_order');
            $this->normalizeOrders();
        });

        return back()->with('success', 'Pertanyaan FAQ berhasil dihapus.');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['integer', 'exists:faqs,id'],
        ]);

        DB::transaction(function () use ($validated): void {
            foreach ($validated['order'] as $position => $id) {
                Faq::where('id', $id)->update(['display_order' => $position + 1]);
            }
        });

        return response()->json(['message' => 'Urutan FAQ berhasil diperbarui.']);
    }

    private function normalizeOrders(): void
    {
        $faqs = Faq::orderBy('display_order', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        foreach ($faqs as $index => $item) {
            $expected = $index + 1;
            if ($item->display_order !== $expected) {
                Faq::where('id', $item->id)->update(['display_order' => $expected]);
            }
        }
    }
}
