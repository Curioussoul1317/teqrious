<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = $user->projects()->with('creator');

        // Search
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();

        return view('client.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        // Ensure client can only view their own projects
        if ($project->client_id !== auth()->id()) {
            abort(403);
        }

        $project->load([
            'creator',
            'updates.user',
            'documents' => fn($q) => $q->visibleToClient()->with('uploader'),
            'comments' => fn($q) => $q->visibleTo(auth()->user())->with(['user', 'replies' => fn($r) => $r->visibleTo(auth()->user())->with('user')]),
            'bills',
        ]);

        return view('client.projects.show', compact('project'));
    }
}
