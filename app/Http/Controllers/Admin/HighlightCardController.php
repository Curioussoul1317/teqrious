<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HighlightCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HighlightCardController extends Controller
{
    public function index()
    {
        $cards = HighlightCard::ordered()->get();
        return view('admin.highlight-cards.index', compact('cards'));
    }

    public function create()
    {
        return view('admin.highlight-cards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['icon_type'] = $request->icon_type ?? 'class';

        if ($request->hasFile('icon_image')) {
            $validated['icon'] = $request->file('icon_image')->store('highlight-cards', 'public');
            $validated['icon_type'] = 'image';
        }

        HighlightCard::create($validated);

        return redirect()->route('admin.highlight-cards.index')->with('success', 'Highlight card created successfully.');
    }

    public function edit(HighlightCard $highlightCard)
    {
        return view('admin.highlight-cards.edit', compact('highlightCard'));
    }

    public function update(Request $request, HighlightCard $highlightCard)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon_image')) {
            if ($highlightCard->icon_type === 'image' && $highlightCard->icon) {
                Storage::disk('public')->delete($highlightCard->icon);
            }
            $validated['icon'] = $request->file('icon_image')->store('highlight-cards', 'public');
            $validated['icon_type'] = 'image';
        }

        $highlightCard->update($validated);

        return redirect()->route('admin.highlight-cards.index')->with('success', 'Highlight card updated successfully.');
    }

    public function destroy(HighlightCard $highlightCard)
    {
        if ($highlightCard->icon_type === 'image' && $highlightCard->icon) {
            Storage::disk('public')->delete($highlightCard->icon);
        }
        $highlightCard->delete();

        return redirect()->route('admin.highlight-cards.index')->with('success', 'Highlight card deleted successfully.');
    }
}