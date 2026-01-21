@extends('admin.layouts.app')

@section('title', 'Clients')
@section('page-title', 'Clients')

@section('content')
<div class="d-flex flex-column gap-4">
    <!-- Header -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Clients</h1>
            <p class="text-muted mb-0">Manage your client accounts</p>
        </div>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Add Client
        </a>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.clients.index') }}" method="GET" class="row g-3">
                <div class="col-12 col-sm">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search by name, email, or company..."
                           class="form-control">
                </div>
                <div class="col-12 col-sm-auto">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-12 col-sm-auto d-flex gap-2">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-search me-2"></i> Search
                    </button>
                    @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-link text-secondary text-decoration-none">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Clients Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Client</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Contact</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Projects</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Status</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Created</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-semibold flex-shrink-0" style="width: 40px; height: 40px;">
                                        {{ $client->initials }}
                                    </div>
                                    <div class="ms-3">
                                        <a href="{{ route('admin.clients.show', $client) }}" class="fw-medium text-dark text-decoration-none">
                                            {{ $client->name }}
                                        </a>
                                        @if($client->company_name)
                                            <p class="text-muted small mb-0">{{ $client->company_name }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <p class="small text-dark mb-0">{{ $client->email }}</p>
                                @if($client->phone)
                                    <p class="small text-muted mb-0">{{ $client->phone }}</p>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span class="small text-dark">{{ $client->projects->count() }} projects</span>
                            </td>
                            <td class="px-4 py-3">
                                @if($client->is_active)
                                    <span class="badge bg-success-subtle text-success rounded-pill">Active</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger rounded-pill">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-muted small">
                                {{ $client->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-end">
                                <div class="d-flex align-items-center justify-content-end gap-1">
                                    <a href="{{ route('admin.clients.show', $client) }}" 
                                       class="btn btn-link btn-sm text-secondary p-1" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.clients.edit', $client) }}" 
                                       class="btn btn-link btn-sm text-secondary p-1" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.clients.toggle-status', $client) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" 
                                                class="btn btn-link btn-sm text-secondary p-1" 
                                                title="{{ $client->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="bi {{ $client->is_active ? 'bi-slash-circle' : 'bi-check-circle' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-5 text-center">
                                <div class="text-muted">
                                    <i class="bi bi-people fs-1 d-block mb-3" style="opacity: 0.3;"></i>
                                    <p class="fs-5 fw-medium mb-1">No clients found</p>
                                    <p class="small mb-3">Get started by adding your first client.</p>
                                    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-lg me-2"></i> Add Client
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($clients->hasPages())
            <div class="card-footer bg-white border-top">
                {{ $clients->links() }}
            </div>
        @endif
    </div>
</div>
@endsection