@extends('admin.layouts.app')

@section('title', 'Bills')
@section('page-title', 'Bills & Invoices')

@section('content')
<div class="d-flex flex-column gap-4">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-3">
        <div>
            <h1 class="h4 fw-bold text-dark mb-1">Bills & Invoices</h1>
            <p class="text-muted mb-0">Manage client billing</p>
        </div>
        <a href="{{ route('admin.bills.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i> Create Bill
        </a>
    </div>

    <!-- Stats -->
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Total Billed</p>
                    <p class="h4 fw-bold mb-0">${{ number_format($stats['total'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Paid</p>
                    <p class="h4 fw-bold text-success mb-0">${{ number_format($stats['paid'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Pending</p>
                    <p class="h4 fw-bold text-warning mb-0">${{ number_format($stats['pending'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Overdue</p>
                    <p class="h4 fw-bold text-danger mb-0">${{ number_format($stats['overdue'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.bills.index') }}" method="GET" class="row g-3">
                <div class="col-12 col-md">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bills..."
                           class="form-control">
                </div>
                <div class="col-12 col-sm-6 col-md-auto">
                    <select name="client_id" class="form-select">
                        <option value="">All Clients</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-auto">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach(['draft', 'sent', 'paid', 'overdue', 'cancelled'] as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
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

    <!-- Bills Table -->
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Bill #</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Client</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Project</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Amount</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Status</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Due Date</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                        <tr>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.bills.show', $bill) }}" class="text-decoration-none fw-medium">
                                    {{ $bill->bill_number }}
                                </a>
                            </td>
                            <td class="px-4 py-3">{{ $bill->client->name }}</td>
                            <td class="px-4 py-3 text-muted">{{ $bill->project->title }}</td>
                            <td class="px-4 py-3 fw-medium">${{ number_format($bill->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="badge rounded-pill {{ $bill->status_badge }}">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 {{ $bill->is_overdue ? 'text-danger' : 'text-muted' }}">
                                {{ $bill->due_date->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('admin.bills.show', $bill) }}" class="btn btn-link btn-sm text-secondary p-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.bills.edit', $bill) }}" class="btn btn-link btn-sm text-secondary p-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-5 text-center text-muted">
                                <i class="bi bi-receipt fs-1 d-block mb-3" style="opacity: 0.3;"></i>
                                <p class="mb-0">No bills found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($bills->hasPages())
            <div class="card-footer bg-white border-top">
                {{ $bills->links() }}
            </div>
        @endif
    </div>
</div>
@endsection