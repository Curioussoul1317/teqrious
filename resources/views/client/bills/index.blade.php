@extends('layouts.app')

@section('title', 'My Bills')
@section('page-title', 'My Bills')

@section('content')
<div class="d-flex flex-column gap-4">
    <div>
        <h1 class="h4 fw-bold text-dark mb-1">My Bills</h1>
        <p class="text-muted mb-0">View and manage your invoices</p>
    </div>

    <!-- Stats -->
    <div class="row g-3">
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Total Billed</p>
                    <p class="h4 fw-bold text-dark mb-0">${{ number_format($stats['total_billed'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Paid</p>
                    <p class="h4 fw-bold text-success mb-0">${{ number_format($stats['total_paid'], 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted small mb-1">Outstanding</p>
                    <p class="h4 fw-bold text-warning mb-0">${{ number_format($stats['outstanding'], 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('client.bills.index') }}" method="GET" class="d-flex gap-3">
                <select name="status" class="form-select" style="width: auto;">
                    <option value="">All Status</option>
                    @foreach(['sent', 'paid', 'overdue'] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-dark">
                    <i class="bi bi-funnel me-2"></i> Filter
                </button>
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
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Project</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Amount</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Status</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase">Due Date</th>
                        <th class="px-4 py-3 small fw-semibold text-muted text-uppercase text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bills as $bill)
                        <tr>
                            <td class="px-4 py-3 fw-medium">{{ $bill->bill_number }}</td>
                            <td class="px-4 py-3 text-muted">{{ $bill->project->title }}</td>
                            <td class="px-4 py-3 fw-semibold">${{ number_format($bill->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="badge rounded-pill {{ $bill->status_badge }}">
                                    {{ ucfirst($bill->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 {{ $bill->is_overdue ? 'text-danger' : 'text-muted' }}">
                                {{ $bill->due_date->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-end">
                                <a href="{{ route('client.bills.show', $bill) }}" class="text-decoration-none">
                                    View <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-5 text-center text-muted">
                                <i class="bi bi-receipt fs-1 d-block mb-3" style="opacity: 0.3;"></i>
                                <p class="mb-0">No bills yet</p>
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