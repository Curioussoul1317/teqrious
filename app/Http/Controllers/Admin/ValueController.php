<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ValueController extends Controller
{
    public function index()
    {
        $values = Value::ordered()->get();
        return view('admin.values.index', compact('values'));
    }

    public function create()
    {
        return view('admin.values.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon_image')) {
            $validated['icon'] = $request->file('icon_image')->store('values', 'public');
            $validated['icon_type'] = 'image';
        }

        Value::create($validated);

        return redirect()->route('admin.values.index')->with('success', 'Value created successfully.');
    }

    public function edit(Value $value)
    {
        return view('admin.values.edit', compact('value'));
    }

    public function update(Request $request, Value $value)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'icon_type' => 'nullable|string|in:class,image',
            'icon_image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if ($request->hasFile('icon_image')) {
            if ($value->icon_type === 'image' && $value->icon) {
                Storage::disk('public')->delete($value->icon);
            }
            $validated['icon'] = $request->file('icon_image')->store('values', 'public');
            $validated['icon_type'] = 'image';
        }

        $value->update($validated);

        return redirect()->route('admin.values.index')->with('success', 'Value updated successfully.');
    }

    public function destroy(Value $value)
    {
        if ($value->icon_type === 'image' && $value->icon) {
            Storage::disk('public')->delete($value->icon);
        }
        $value->delete();

        return redirect()->route('admin.values.index')->with('success', 'Value deleted successfully.');
    }
}