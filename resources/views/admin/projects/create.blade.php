@extends('admin.layouts.app')

@section('title', 'Create Project')
@section('page-title', 'Create New Project')

@section('content')
<div class="container" style="max-width: 768px;">
    <div class="mb-4">
        <a href="{{ route('admin.projects.index') }}" class="text-secondary text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i> Back to Projects
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-semibold text-dark mb-0">Project Details</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-12">
                        <label for="client_id" class="form-label">
                            Client <span class="text-danger">*</span>
                        </label>
                        <select name="client_id" 
                                id="client_id" 
                                class="form-select @error('client_id') is-invalid @enderror"
                                required>
                            <option value="">Select a client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" 
                                        {{ (old('client_id', $selectedClient?->id) == $client->id) ? 'selected' : '' }}>
                                    {{ $client->name }} {{ $client->company_name ? "({$client->company_name})" : '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="title" class="form-label">
                            Project Title <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">
                            Description
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label">
                            Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" 
                                id="status" 
                                class="form-select"
                                required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="priority" class="form-label">
                            Priority <span class="text-danger">*</span>
                        </label>
                        <select name="priority" 
                                id="priority" 
                                class="form-select"
                                required>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="progress" class="form-label">
                            Progress (%)
                        </label>
                        <input type="number" 
                               name="progress" 
                               id="progress" 
                               value="{{ old('progress', 0) }}"
                               min="0"
                               max="100"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="budget" class="form-label">
                            Budget ($)
                        </label>
                        <input type="number" 
                               name="budget" 
                               id="budget" 
                               value="{{ old('budget') }}"
                               step="0.01"
                               min="0"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="start_date" class="form-label">
                            Start Date
                        </label>
                        <input type="date" 
                               name="start_date" 
                               id="start_date" 
                               value="{{ old('start_date') }}"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="end_date" class="form-label">
                            End Date
                        </label>
                        <input type="date" 
                               name="end_date" 
                               id="end_date" 
                               value="{{ old('end_date') }}"
                               class="form-control">
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-3 pt-4 mt-4 border-top">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-link text-secondary text-decoration-none">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i> Create Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection