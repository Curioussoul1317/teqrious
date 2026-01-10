<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsidiary;
use App\Models\SubsidiaryService;
use App\Models\SubsidiaryGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubsidiaryController extends Controller
{
    public function index()
    {
        $subsidiaries = Subsidiary::withCount(['services', 'gallery', 'quotes'])->ordered()->get();
        return view('admin.subsidiaries.index', compact('subsidiaries'));
    }

    public function create()
    {
        return view('admin.subsidiaries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subsidiaries',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:5120',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name']);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('subsidiaries', 'public');
        }

        Subsidiary::create($validated);

        return redirect()->route('admin.subsidiaries.index')->with('success', 'Subsidiary created successfully.');
    }

    public function show(Subsidiary $subsidiary)
    {
        $subsidiary->load(['services' => fn($q) => $q->ordered(), 'gallery' => fn($q) => $q->ordered()]);
        return view('admin.subsidiaries.show', compact('subsidiary'));
    }

    public function edit(Subsidiary $subsidiary)
    {
        return view('admin.subsidiaries.edit', compact('subsidiary'));
    }

    public function update(Request $request, Subsidiary $subsidiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subsidiaries,slug,' . $subsidiary->id,
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'cover_image' => 'nullable|image|max:5120',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('logo')) {
            if ($subsidiary->logo) Storage::disk('public')->delete($subsidiary->logo);
            $validated['logo'] = $request->file('logo')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('cover_image')) {
            if ($subsidiary->cover_image) Storage::disk('public')->delete($subsidiary->cover_image);
            $validated['cover_image'] = $request->file('cover_image')->store('subsidiaries', 'public');
        }

        $subsidiary->update($validated);

        return redirect()->route('admin.subsidiaries.index')->with('success', 'Subsidiary updated successfully.');
    }

    public function destroy(Subsidiary $subsidiary)
    {
        if ($subsidiary->logo) Storage::disk('public')->delete($subsidiary->logo);
        if ($subsidiary->cover_image) Storage::disk('public')->delete($subsidiary->cover_image);
        foreach ($subsidiary->gallery as $item) {
            Storage::disk('public')->delete($item->image);
        }
        $subsidiary->delete();

        return redirect()->route('admin.subsidiaries.index')->with('success', 'Subsidiary deleted successfully.');
    }

    // Subsidiary Services
    public function storeService(Request $request, Subsidiary $subsidiary)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $subsidiary->services()->create($validated);

        return back()->with('success', 'Service added successfully.');
    }

    public function updateService(Request $request, Subsidiary $subsidiary, SubsidiaryService $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'price' => 'nullable|numeric|min:0',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $service->update($validated);

        return back()->with('success', 'Service updated successfully.');
    }

    public function destroyService(Subsidiary $subsidiary, SubsidiaryService $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted successfully.');
    }

    // Gallery
    public function storeGallery(Request $request, Subsidiary $subsidiary)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'title' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('subsidiary-gallery', 'public');
        $subsidiary->gallery()->create([
            'image' => $path,
            'title' => $request->title,
            'order' => $subsidiary->gallery()->count(),
        ]);

        return back()->with('success', 'Image added to gallery.');
    }

    public function destroyGallery(Subsidiary $subsidiary, SubsidiaryGallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return back()->with('success', 'Image removed from gallery.');
    }
}