<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with(['client', 'creator']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('client', fn($c) => $c->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by client
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        // Filter by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();
        $clients = User::clients()->active()->orderBy('name')->get();

        return view('admin.projects.index', compact('projects', 'clients'));
    }

    public function create(Request $request)
    {
        $clients = User::clients()->active()->orderBy('name')->get();
        $selectedClient = $request->client_id ? User::find($request->client_id) : null;
        
        return view('admin.projects.create', compact('clients', 'selectedClient'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,on_hold,completed,cancelled'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'progress' => ['required', 'integer', 'min:0', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'budget' => ['nullable', 'numeric', 'min:0'],
        ]);

        $validated['created_by'] = auth()->id();

        $project = Project::create($validated);

        // Create initial update
        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'title' => 'Project Created',
            'content' => 'Project has been created and assigned.',
            'progress_after' => $project->progress,
            'status_after' => $project->status,
        ]);

        return redirect()->route('admin.projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load([
            'client',
            'creator',
            'updates.user',
            'documents.uploader',
            'comments' => fn($q) => $q->with(['user', 'replies.user']),
            'bills',
        ]);

        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $clients = User::clients()->active()->orderBy('name')->get();
        return view('admin.projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,on_hold,completed,cancelled'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'progress' => ['required', 'integer', 'min:0', 'max:100'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'actual_end_date' => ['nullable', 'date'],
            'budget' => ['nullable', 'numeric', 'min:0'],
        ]);

        $oldProgress = $project->progress;
        $oldStatus = $project->status;

        $project->update($validated);

        // Create update if progress or status changed
        if ($oldProgress !== $project->progress || $oldStatus !== $project->status) {
            ProjectUpdate::create([
                'project_id' => $project->id,
                'user_id' => auth()->id(),
                'title' => 'Project Updated',
                'content' => $request->input('update_note', 'Project details have been updated.'),
                'progress_before' => $oldProgress,
                'progress_after' => $project->progress,
                'status_before' => $oldStatus,
                'status_after' => $project->status,
            ]);
        }

        return redirect()->route('admin.projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function addUpdate(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'progress' => ['nullable', 'integer', 'min:0', 'max:100'],
            'status' => ['nullable', 'in:pending,in_progress,on_hold,completed,cancelled'],
        ]);

        $oldProgress = $project->progress;
        $oldStatus = $project->status;

        // Update project if new progress/status provided
        if (isset($validated['progress']) || isset($validated['status'])) {
            $project->update([
                'progress' => $validated['progress'] ?? $project->progress,
                'status' => $validated['status'] ?? $project->status,
            ]);
        }

        ProjectUpdate::create([
            'project_id' => $project->id,
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'progress_before' => $oldProgress,
            'progress_after' => $validated['progress'] ?? $oldProgress,
            'status_before' => $oldStatus,
            'status_after' => $validated['status'] ?? $oldStatus,
        ]);

        return back()->with('success', 'Update added successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
