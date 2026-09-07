<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(): View
    {
        $faqs = Faq::orderBy('display_order')->orderBy('id')->get();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        Faq::create([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'display_order' => $validated['display_order'] ?? (Faq::max('display_order') + 1),
            'is_published' => true,
        ]);

        return back()->with('success', 'Pertanyaan FAQ baru berhasil ditambahkan!');
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $faq->update([
            'question' => $validated['question'],
            'answer' => $validated['answer'],
            'display_order' => $validated['display_order'] ?? $faq->display_order,
            'is_published' => $request->has('is_published') ? $request->boolean('is_published') : $faq->is_published,
        ]);

        return back()->with('success', 'Pertanyaan FAQ berhasil diperbarui!');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return back()->with('success', 'Pertanyaan FAQ berhasil dihapus.');
    }
}
