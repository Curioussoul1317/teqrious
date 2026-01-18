@extends('layouts.app')

@section('title', 'My Projects')
@section('page-title', 'My Projects')

<!-- .card.text-decoration-none:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    transform: translateY(-2px);
    transition: all 0.2s ease-in-out;
}

.card.text-decoration-none {
    transition: all 0.2s ease-in-out;
} -->

@section('content')
<div class="d-flex flex-column gap-4">
    <div>
        <h1 class="h4 fw-bold text-dark mb-1">My Projects</h1>
        <p class="text-muted mb-0">View and track your project progress</p>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('client.projects.index') }}" method="GET" class="row g-3">
                <div class="col-12 col-md">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search projects..."
                           class="form-control">
                </div>
                <div class="col-12 col-md-auto">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach(['pending', 'in_progress', 'on_hold', 'completed'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-auto">
                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-search me-2"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="row g-4">
        @forelse($projects as $project)
            <div class="col-12 col-md-6 col-lg-4">
                <a href="{{ route('client.projects.show', $project) }}" 
                   class="card border-0 shadow-sm h-100 text-decoration-none">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h5 class="fw-semibold text-dark mb-0">{{ $project->title }}</h5>
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
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="text-muted">Progress</span>
                                    <span class="fw-medium">{{ $project->progress }}%</span>
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

                            <div class="d-flex justify-content-between align-items-center small">
                                <span class="badge rounded-pill {{ $project->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                                @if($project->end_date)
                                    <span class="{{ $project->is_overdue ? 'text-danger' : 'text-muted' }}">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $project->end_date->format('M d') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <i class="bi bi-folder2-open text-secondary fs-1 d-block mb-3" style="opacity: 0.3;"></i>
                        <h5 class="fw-medium text-dark">No projects yet</h5>
                        <p class="text-muted mb-0">Your projects will appear here once assigned.</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    @if($projects->hasPages())
        <div class="mt-3">{{ $projects->links() }}</div>
    @endif
</div>
@endsection