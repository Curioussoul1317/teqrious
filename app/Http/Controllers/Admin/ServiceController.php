<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::ordered()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string|max:255',
            'deliverables' => 'nullable|array',
            'deliverables.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['includes'] = array_filter($validated['includes'] ?? []);
        $validated['deliverables'] = array_filter($validated['deliverables'] ?? []);

        if ($request->hasFile('icon_image')) {
            $validated['icon'] = $request->file('icon_image')->store('services', 'public');
            $validated['icon_type'] = 'image';
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string|max:255',
            'deliverables' => 'nullable|array',
            'deliverables.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['includes'] = array_filter($validated['includes'] ?? []);
        $validated['deliverables'] = array_filter($validated['deliverables'] ?? []);

        if ($request->hasFile('icon_image')) {
            if ($service->icon_type === 'image' && $service->icon) {
                Storage::disk('public')->delete($service->icon);
            }
            $validated['icon'] = $request->file('icon_image')->store('services', 'public');
            $validated['icon_type'] = 'image';
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->icon_type === 'image' && $service->icon) {
            Storage::disk('public')->delete($service->icon);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}