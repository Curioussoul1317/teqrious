<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceTile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceTileController extends Controller
{
    public function index()
    {
        $tiles = ServiceTile::ordered()->get();
        return view('admin.service-tiles.index', compact('tiles'));
    }

    public function create()
    {
        return view('admin.service-tiles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon_image')) {
            $validated['icon'] = $request->file('icon_image')->store('service-tiles', 'public');
            $validated['icon_type'] = 'image';
        }

        ServiceTile::create($validated);

        return redirect()->route('admin.service-tiles.index')->with('success', 'Service tile created successfully.');
    }

    public function edit(ServiceTile $serviceTile)
    {
        return view('admin.service-tiles.edit', compact('serviceTile'));
    }

    public function update(Request $request, ServiceTile $serviceTile)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon_image')) {
            if ($serviceTile->icon_type === 'image' && $serviceTile->icon) {
                Storage::disk('public')->delete($serviceTile->icon);
            }
            $validated['icon'] = $request->file('icon_image')->store('service-tiles', 'public');
            $validated['icon_type'] = 'image';
        }

        $serviceTile->update($validated);

        return redirect()->route('admin.service-tiles.index')->with('success', 'Service tile updated successfully.');
    }

    public function destroy(ServiceTile $serviceTile)
    {
        if ($serviceTile->icon_type === 'image' && $serviceTile->icon) {
            Storage::disk('public')->delete($serviceTile->icon);
        }
        $serviceTile->delete();

        return redirect()->route('admin.service-tiles.index')->with('success', 'Service tile deleted successfully.');
    }
}