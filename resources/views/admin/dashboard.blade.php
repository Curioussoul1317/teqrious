@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="d-flex flex-column gap-4">
    <!-- Stats Grid -->
    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Clients</p>
                            <p class="h3 fw-bold text-dark mb-1">{{ $stats['total_clients'] }}</p>
                            <p class="text-success small mb-0">
                                <i class="bi bi-check-circle-fill"></i> {{ $stats['active_clients'] }} active
                            </p>
                        </div>
                        <div class="rounded d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background-color: rgba(0, 19, 72, 0.1);">
                            <i class="bi bi-people-fill fs-5" style="color: #001348;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Projects</p>
                            <p class="h3 fw-bold text-dark mb-1">{{ $stats['total_projects'] }}</p>
                            <p class="text-primary small mb-0">
                                <i class="bi bi-arrow-repeat"></i> {{ $stats['active_projects'] }} in progress
                            </p>
                        </div>
                        <div class="rounded d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px; background-color: rgba(111, 66, 193, 0.1);">
                            <i class="bi bi-folder-fill fs-5" style="color: #6f42c1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Total Revenue</p>
                            <p class="h3 fw-bold text-dark mb-1">${{ number_format($stats['total_revenue'], 2) }}</p>
                            <p class="text-warning small mb-0">
                                <i class="bi bi-clock-fill"></i> ${{ number_format($stats['pending_bills'], 2) }} pending
                            </p>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px;">
                            <i class="bi bi-currency-dollar text-success fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted small mb-1">Completed Projects</p>
                            <p class="h3 fw-bold text-dark mb-1">{{ $stats['completed_projects'] }}</p>
                            @if($stats['overdue_projects'] > 0)
                                <p class="text-danger small mb-0">
                                    <i class="bi bi-exclamation-circle-fill"></i> {{ $stats['overdue_projects'] }} overdue
                                </p>
                            @else
                                <p class="text-success small mb-0">
                                    <i class="bi bi-check-lg"></i> All on track
                                </p>
                            @endif
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded d-flex align-items-center justify-content-center" 
                             style="width: 48px; height: 48px;">
                            <i class="bi bi-check2-all text-warning fs-5"></i>
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
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h5 class="fw-semibold text-dark mb-0">Recent Projects</h5>
                    <a href="{{ route('admin.projects.index') }}" class="text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentProjects as $project)
                        <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <a href="{{ route('admin.projects.show', $project) }}" 
                                       class="fw-medium text-dark text-decoration-none">
                                        {{ $project->title }}
                                    </a>
                                    <p class="text-muted small mb-0">{{ $project->client->name }}</p>
                                </div>
                                <span class="badge rounded-pill {{ $project->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                            <div class="mt-3">
                                <div class="d-flex align-items-center justify-content-between small text-muted mb-1">
                                    <span>Progress</span>
                                    <span>{{ $project->progress }}%</span>
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
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-folder2-open fs-1 d-block mb-2"></i>
                            <p class="mb-0">No projects yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Bills -->
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h5 class="fw-semibold text-dark mb-0">Recent Bills</h5>
                    <a href="{{ route('admin.bills.index') }}" class="text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentBills as $bill)
                        <div class="p-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <a href="{{ route('admin.bills.show', $bill) }}" 
                                       class="fw-medium text-dark text-decoration-none">
                                        {{ $bill->bill_number }}
                                    </a>
                                    <p class="text-muted small mb-0">
                                        {{ $bill->client->name }} - {{ $bill->project->title }}
                                    </p>
                                </div>
                                <div class="text-end">
                                    <p class="fw-semibold text-dark mb-1">${{ number_format($bill->total, 2) }}</p>
                                    <span class="badge rounded-pill {{ $bill->status_badge }}">
                                        {{ ucfirst($bill->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                            <p class="mb-0">No bills yet</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="fw-semibold text-dark mb-3">Quick Actions</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i> Add Client
                </a>
                <a href="{{ route('admin.projects.create') }}" class="btn text-white" style="background-color: #6f42c1;">
                    <i class="bi bi-folder-plus me-2"></i> New Project
                </a>
                <a href="{{ route('admin.bills.create') }}" class="btn btn-success">
                    <i class="bi bi-receipt me-2"></i> Create Bill
                </a>
            </div>
        </div>
    </div>
</div>
@endsection