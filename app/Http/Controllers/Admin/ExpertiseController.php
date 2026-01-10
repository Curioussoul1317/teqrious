<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertiseController extends Controller
{
    public function index()
    {
        $expertises = Expertise::ordered()->get();
        return view('admin.expertise.index', compact('expertises'));
    }

    public function create()
    {
        return view('admin.expertise.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'outcomes' => 'nullable|array',
            'outcomes.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['outcomes'] = array_filter($validated['outcomes'] ?? []);

        if ($request->hasFile('icon_image')) {
            $validated['icon'] = $request->file('icon_image')->store('expertise', 'public');
            $validated['icon_type'] = 'image';
        }

        Expertise::create($validated);

        return redirect()->route('admin.expertise.index')->with('success', 'Expertise created successfully.');
    }

    public function edit(Expertise $expertise)
    {
        return view('admin.expertise.edit', compact('expertise'));
    }

    public function update(Request $request, Expertise $expertise)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'outcomes' => 'nullable|array',
            'outcomes.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['outcomes'] = array_filter($validated['outcomes'] ?? []);

        if ($request->hasFile('icon_image')) {
            if ($expertise->icon_type === 'image' && $expertise->icon) {
                Storage::disk('public')->delete($expertise->icon);
            }
            $validated['icon'] = $request->file('icon_image')->store('expertise', 'public');
            $validated['icon_type'] = 'image';
        }

        $expertise->update($validated);

        return redirect()->route('admin.expertise.index')->with('success', 'Expertise updated successfully.');
    }

    public function destroy(Expertise $expertise)
    {
        if ($expertise->icon_type === 'image' && $expertise->icon) {
            Storage::disk('public')->delete($expertise->icon);
        }
        $expertise->delete();

        return redirect()->route('admin.expertise.index')->with('success', 'Expertise deleted successfully.');
    }
}