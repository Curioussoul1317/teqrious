<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkStep;
use Illuminate\Http\Request;

class WorkStepController extends Controller
{
    public function index()
    {
        $steps = WorkStep::ordered()->get();
        return view('admin.work-steps.index', compact('steps'));
    }

    public function create()
    {
        $nextStepNumber = WorkStep::max('step_number') + 1;
        return view('admin.work-steps.create', compact('nextStepNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'step_number' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        WorkStep::create($validated);

        return redirect()->route('admin.work-steps.index')->with('success', 'Work step created successfully.');
    }

    public function edit(WorkStep $workStep)
    {
        return view('admin.work-steps.edit', compact('workStep'));
    }

    public function update(Request $request, WorkStep $workStep)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'step_number' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $workStep->update($validated);

        return redirect()->route('admin.work-steps.index')->with('success', 'Work step updated successfully.');
    }

    public function destroy(WorkStep $workStep)
    {
        $workStep->delete();
        return redirect()->route('admin.work-steps.index')->with('success', 'Work step deleted successfully.');
    }
}