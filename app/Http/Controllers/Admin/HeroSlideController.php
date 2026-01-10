<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::ordered()->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('hero-slides', 'public');
        }

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|max:5120',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('background_image')) {
            if ($heroSlide->background_image) {
                Storage::disk('public')->delete($heroSlide->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('hero-slides', 'public');
        }

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->background_image) {
            Storage::disk('public')->delete($heroSlide->background_image);
        }
        $heroSlide->delete();

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted successfully.');
    }
}