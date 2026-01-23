<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurClientImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OurClientImageController extends Controller
{
    public function index()
    {
        $clientImages = OurClientImage::ordered()->get();
        return view('admin.client-images.index', compact('clientImages'));
    }

    public function create()
    {
        return view('admin.client-images.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('client-images', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        OurClientImage::create($validated);

        return redirect()->route('admin.client-images.index')
            ->with('success', 'Client image created successfully!');
    }

    public function edit(OurClientImage $clientImage)
    {
        return view('admin.client-images.edit', compact('clientImage'));
    }

    public function update(Request $request, OurClientImage $clientImage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($clientImage->image) {
                Storage::disk('public')->delete($clientImage->image);
            }
            $validated['image'] = $request->file('image')->store('client-images', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $clientImage->update($validated);

        return redirect()->route('admin.client-images.index')
            ->with('success', 'Client image updated successfully!');
    }

    public function destroy(OurClientImage $clientImage)
    {
        if ($clientImage->image) {
            Storage::disk('public')->delete($clientImage->image);
        }

        $clientImage->delete();

        return redirect()->route('admin.client-images.index')
            ->with('success', 'Client image deleted successfully!');
    }
}
