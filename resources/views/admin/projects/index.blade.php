@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('content')
<div class="d-flex flex-column gap-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Projects</h1>
            <p class="text-muted mb-0">Manage all client projects</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> New Project
        </a>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.projects.index') }}" method="GET" class="row g-3">
                <div class="col-12 col-lg">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search projects..."
                           class="form-control">
                </div>
                <div class="col-12 col-sm-6 col-lg-auto">
                    <select name="client_id" class="form-select">
                        <option value="">All Clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-auto">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="on_hold" {{ request('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-auto">
                    <select name="priority" class="form-select">
                        <option value="">All Priority</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                        <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-lg-auto d-flex gap-2">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-search me-2"></i> Filter
                    </button>
                    @if(request()->hasAny(['search', 'status', 'client_id', 'priority']))
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-link text-secondary text-decoration-none">Clear</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="row g-4">
        @forelse($projects as $project)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div>
                                <a href="{{ route('admin.projects.show', $project) }}" 
                                   class="h6 fw-semibold text-dark text-decoration-none d-block">
                                    {{ $project->title }}
                                </a>
                                <p class="text-muted small mt-1 mb-0">
                                    <i class="bi bi-person me-1"></i> {{ $project->client->name }}
                                </p>
                            </div>
                            <span class="badge rounded-pill {{ $project->priority_badge }}">
                                {{ ucfirst($project->priority) }}
                            </span>
                        </div>

                        @if($project->description)
                            <p class="text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $project->description }}
                            </p>
                        @endif

                        <div class="d-flex flex-column gap-3">
                            <div>
                                <div class="d-flex align-items-center justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-medium {{ $project->progress == 100 ? 'text-success' : 'text-dark' }}">
                                        {{ $project->progress }}%
                                    </span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar {{ $project->progress_color }}" 
                                         role="progressbar" 
                                         style="width: {{ $project->progress }}%;" 
                                         aria-valuenow="{{ $project->progress }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between small">
                                <span class="badge rounded-pill {{ $project->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                                @if($project->end_date)
                                    <span class="text-muted {{ $project->is_overdue ? 'text-danger' : '' }}">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $project->end_date->format('M d, Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light border-top d-flex align-items-center justify-content-between py-2">
                        <div class="d-flex align-items-center gap-3 small text-muted">
                            <span><i class="bi bi-file-earmark me-1"></i> {{ $project->documents->count() }}</span>
                            <span><i class="bi bi-chat me-1"></i> {{ $project->allComments->count() }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-1">
                            <a href="{{ route('admin.projects.show', $project) }}" 
                               class="btn btn-link btn-sm text-secondary p-1">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" 
                               class="btn btn-link btn-sm text-secondary p-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class="bi bi-folder2-open text-secondary fs-1 d-block mb-3" style="opacity: 0.3;"></i>
                        <h5 class="fw-medium text-dark">No projects found</h5>
                        <p class="text-muted mb-3">Get started by creating your first project.</p>
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-lg me-2"></i> New Project
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if($projects->hasPages())
        <div class="mt-3">
            {{ $projects->links() }}
        </div>
    @endif
</div>
@endsection