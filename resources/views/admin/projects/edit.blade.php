@extends('admin.layouts.app')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
<div class="container" style="max-width: 768px;">
    <div class="mb-4">
        <a href="{{ route('admin.projects.show', $project) }}" class="text-secondary text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i> Back to Project
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-semibold mb-0">Edit Project</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Client <span class="text-danger">*</span></label>
                        <select name="client_id" class="form-select" required>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $project->title) }}" required
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="4" class="form-control">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            @foreach(['pending', 'in_progress', 'on_hold', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $project->status == $status ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Priority</label>
                        <select name="priority" class="form-select">
                            @foreach(['low', 'medium', 'high', 'urgent'] as $priority)
                                <option value="{{ $priority }}" {{ $project->priority == $priority ? 'selected' : '' }}>
                                    {{ ucfirst($priority) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Progress (%)</label>
                        <input type="number" name="progress" value="{{ old('progress', $project->progress) }}" min="0" max="100"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Budget ($)</label>
                        <input type="number" name="budget" value="{{ old('budget', $project->budget) }}" step="0.01" min="0"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Actual End Date</label>
                        <input type="date" name="actual_end_date" value="{{ old('actual_end_date', $project->actual_end_date?->format('Y-m-d')) }}"
                               class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 pt-4 mt-4 border-top">
                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-link text-secondary text-decoration-none">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i> Update Project
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-danger border-opacity-50 shadow-sm mt-4">
        <div class="card-header bg-danger-subtle border-bottom border-danger border-opacity-25 py-3">
            <h6 class="fw-semibold text-danger mb-0">Danger Zone</h6>
        </div>
        <div class="card-body d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <p class="fw-medium mb-1">Delete this project</p>
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                  onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i> Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection