@extends('layouts.app')

@section('title', $client->name)
@section('page-title', 'Client Details')

@section('content')
<div class="d-flex flex-column gap-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('admin.clients.index') }}" class="text-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 64px; height: 64px; font-size: 1.25rem;">
                    {{ $client->initials }}
                </div>
                <div>
                    <h1 class="h4 fw-bold text-dark mb-1">{{ $client->name }}</h1>
                    <p class="text-muted mb-0">{{ $client->company_name ?? 'Individual' }}</p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.projects.create', ['client_id' => $client->id]) }}" class="btn text-white" style="background-color: #6f42c1;">
                <i class="bi bi-folder-plus me-2"></i> New Project
            </a>
            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-primary">
                <i class="bi bi-pencil me-2"></i> Edit
            </a>
        </div>
    </div>

    @if(session('generated_password'))
        <div class="alert alert-warning border-warning">
            <div class="d-flex align-items-start gap-3">
                <div class="text-warning">
                    <i class="bi bi-key fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-semibold text-warning mb-1">Generated Password</h6>
                    <p class="mb-2">Please save this password and share it with the client:</p>
                    <code class="d-block bg-warning-subtle px-3 py-2 rounded fs-5">{{ session('generated_password') }}</code>
                    <p class="small text-warning mt-2 mb-0">This password will not be shown again.</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats -->
    <div class="row g-3">
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <p class="h4 fw-bold text-dark mb-1">{{ $stats['total_projects'] }}</p>
                    <p class="text-muted small mb-0">Total Projects</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <p class="h4 fw-bold text-primary mb-1">{{ $stats['active_projects'] }}</p>
                    <p class="text-muted small mb-0">Active</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <p class="h4 fw-bold text-success mb-1">{{ $stats['completed_projects'] }}</p>
                    <p class="text-muted small mb-0">Completed</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <p class="h4 fw-bold text-dark mb-1">${{ number_format($stats['total_billed'], 2) }}</p>
                    <p class="text-muted small mb-0">Total Billed</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <p class="h4 fw-bold text-success mb-1">${{ number_format($stats['total_paid'], 2) }}</p>
                    <p class="text-muted small mb-0">Paid</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <p class="h4 fw-bold text-warning mb-1">${{ number_format($stats['outstanding'], 2) }}</p>
                    <p class="text-muted small mb-0">Outstanding</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Client Info -->
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-semibold text-dark mb-0">Contact Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-envelope text-muted" style="width: 20px;"></i>
                            <a href="mailto:{{ $client->email }}" class="text-decoration-none">{{ $client->email }}</a>
                        </div>
                        @if($client->phone)
                            <div class="d-flex align-items-center gap-3">
                                <i class="bi bi-telephone text-muted" style="width: 20px;"></i>
                                <span>{{ $client->phone }}</span>
                            </div>
                        @endif
                        @if($client->address)
                            <div class="d-flex align-items-start gap-3">
                                <i class="bi bi-geo-alt text-muted mt-1" style="width: 20px;"></i>
                                <span>{{ $client->address }}</span>
                            </div>
                        @endif
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-calendar text-muted" style="width: 20px;"></i>
                            <span>Joined {{ $client->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-circle-fill {{ $client->is_active ? 'text-success' : 'text-danger' }}" style="width: 20px; font-size: 0.5rem;"></i>
                            <span>{{ $client->is_active ? 'Active' : 'Inactive' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                    <h5 class="fw-semibold text-dark mb-0">Projects</h5>
                    <a href="{{ route('admin.projects.index', ['client_id' => $client->id]) }}" class="text-decoration-none small">View All</a>
                </div>
                <div class="card-body p-0">
                    @forelse($client->projects as $project)
                        <div class="p-3 border-bottom {{ $loop->last ? 'border-bottom-0' : '' }}">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <a href="{{ route('admin.projects.show', $project) }}" class="fw-medium text-dark text-decoration-none">
                                        {{ $project->title }}
                                    </a>
                                    @if($project->end_date)
                                        <p class="text-muted small mb-0">Due: {{ $project->end_date->format('M d, Y') }}</p>
                                    @endif
                                </div>
                                <span class="badge rounded-pill {{ $project->status_badge }}">
                                    {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex align-items-center justify-content-between small text-muted mb-1">
                                    <span>Progress</span>
                                    <span>{{ $project->progress }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar {{ $project->progress_color }}" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <p class="mb-1">No projects yet</p>
                            <a href="{{ route('admin.projects.create', ['client_id' => $client->id]) }}" class="text-decoration-none">Create one</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bills -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h5 class="fw-semibold text-dark mb-0">Recent Bills</h5>
            <a href="{{ route('admin.bills.index', ['client_id' => $client->id]) }}" class="text-decoration-none small">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Bill #</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Project</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Amount</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Status</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($client->bills as $bill)
                        <tr>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.bills.show', $bill) }}" class="text-decoration-none">
                                    {{ $bill->bill_number }}
                                </a>
                            </td>
                            <td class="px-4 py-3">{{ $bill->project->title }}</td>
                            <td class="px-4 py-3 fw-medium">${{ number_format($bill->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="badge rounded-pill {{ $bill->status_badge }}">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-muted">{{ $bill->due_date->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-5 text-center text-muted">No bills yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection