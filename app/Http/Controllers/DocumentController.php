<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        // Check authorization
        $user = auth()->user();
        if ($user->isClient() && $project->client_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'file' => ['required', 'file', 'max:20480'], // 20MB max
            'visibility' => ['nullable', 'in:admin_only,client_visible'],
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $path = $file->store('documents/' . $project->id, 'public');

        Document::create([
            'project_id' => $project->id,
            'uploaded_by' => $user->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_name' => $fileName,
            'file_path' => $path,
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'visibility' => $user->isAdmin() ? ($validated['visibility'] ?? 'client_visible') : 'client_visible',
        ]);

        return back()->with('success', 'Document uploaded successfully.');
    }

    public function download(Document $document)
    {
        $user = auth()->user();
        
        // Check authorization
        if ($user->isClient()) {
            if ($document->project->client_id !== $user->id) {
                abort(403);
            }
            if ($document->visibility === 'admin_only') {
                abort(403);
            }
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }

    public function destroy(Document $document)
    {
        $user = auth()->user();

        // Only admin or the uploader can delete
        if ($user->isClient() && $document->uploaded_by !== $user->id) {
            abort(403);
        }

        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return back()->with('success', 'Document deleted successfully.');
    }
}
