@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="d-flex flex-column gap-4">
    <div>
        <h1 class="h4 fw-bold text-dark">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-muted mb-0">Here's an overview of your projects and bills.</p>
    </div>

    <!-- Stats -->
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Active Projects</p>
                            <p class="h3 fw-bold text-primary mb-0">{{ $stats['active_projects'] }}</p>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-folder2-open text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Completed</p>
                            <p class="h3 fw-bold text-success mb-0">{{ $stats['completed_projects'] }}</p>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-check-circle text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Outstanding</p>
                            <p class="h3 fw-bold text-warning mb-0">${{ number_format($stats['outstanding']) }}</p>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-clock text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Paid</p>
                            <p class="h3 fw-bold text-dark mb-0">${{ number_format($stats['total_paid']) }}</p>
                        </div>
                        <div class="bg-secondary bg-opacity-10 rounded d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-receipt text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Projects -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-semibold mb-0">My Projects</h5>
                    <a href="{{ route('client.projects.index') }}" class="text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentProjects as $project)
                        <a href="{{ route('client.projects.show', $project) }}" class="d-block p-3 text-decoration-none border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="fw-medium text-dark">{{ $project->title }}</span>
                                <span class="badge rounded-pill {{ $project->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar {{ $project->progress_color }}" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted small mb-0">{{ $project->progress }}% complete</p>
                        </a>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-folder2-open fs-1 d-block mb-2" style="opacity: 0.3;"></i>
                            <p class="mb-0">No projects yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Bills -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="fw-semibold mb-0">Recent Bills</h5>
                    <a href="{{ route('client.bills.index') }}" class="text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentBills as $bill)
                        <a href="{{ route('client.bills.show', $bill) }}" class="d-block p-3 text-decoration-none border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="fw-medium text-dark mb-0">{{ $bill->bill_number }}</p>
                                    <p class="text-muted small mb-0">{{ $bill->project->title }}</p>
                                </div>
                                <div class="text-end">
                                    <p class="fw-semibold mb-1">${{ number_format($bill->total, 2) }}</p>
                                    <span class="badge rounded-pill {{ $bill->status_badge }}">
                                        {{ ucfirst($bill->status) }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-receipt fs-1 d-block mb-2" style="opacity: 0.3;"></i>
                            <p class="mb-0">No bills yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Updates -->
    @if($recentUpdates->count())
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-semibold mb-0">Recent Project Updates</h5>
            </div>
            <div class="card-body p-0">
                @foreach($recentUpdates as $update)
                    <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                        <div class="d-flex gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="bi bi-clipboard-check text-primary"></i>
                            </div>
                            <div>
                                <p class="fw-medium text-dark mb-0">{{ $update->title }}</p>
                                <p class="text-muted small mb-1">
                                    {{ $update->project->title }} • {{ $update->created_at->diffForHumans() }}
                                </p>
                                <p class="text-muted mb-0">{{ Str::limit($update->content, 150) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection