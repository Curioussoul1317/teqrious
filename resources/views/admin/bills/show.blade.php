@extends('layouts.app')

@section('title', $bill->bill_number)
@section('page-title', 'Bill Details')

@section('content')
<div class="container" style="max-width: 896px;">
    <div class="d-flex flex-column gap-4">
        <div class="d-flex justify-content-between align-items-start">
            <a href="{{ route('admin.bills.index') }}" class="text-secondary text-decoration-none">
                <i class="bi bi-arrow-left me-2"></i> Back to Bills
            </a>
            <div class="d-flex gap-2">
                @if($bill->status !== 'paid')
                    <a href="{{ route('admin.bills.edit', $bill) }}" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i> Edit
                    </a>
                @endif
            </div>
        </div>

        <!-- Bill Document -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-md-5">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 fw-bold text-dark">INVOICE</h1>
                        <p class="text-muted mb-0">{{ $bill->bill_number }}</p>
                    </div>
                    <span class="badge rounded-pill fs-6 {{ $bill->status_badge }}">
                        {{ strtoupper($bill->status) }}
                    </span>
                </div>

                <!-- Client & Dates -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-6">
                        <h6 class="text-muted text-uppercase small fw-semibold mb-2">Bill To</h6>
                        <p class="fw-semibold fs-5 mb-1">{{ $bill->client->name }}</p>
                        @if($bill->client->company_name)
                            <p class="text-muted mb-1">{{ $bill->client->company_name }}</p>
                        @endif
                        <p class="text-muted mb-1">{{ $bill->client->email }}</p>
                        @if($bill->client->address)
                            <p class="text-muted mb-0">{{ $bill->client->address }}</p>
                        @endif
                    </div>
                    <div class="col-12 col-md-6 text-md-end">
                        <div class="mb-3">
                            <p class="text-muted small mb-0">Issue Date</p>
                            <p class="fw-medium mb-0">{{ $bill->issue_date->format('F d, Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <p class="text-muted small mb-0">Due Date</p>
                            <p class="fw-medium mb-0 {{ $bill->is_overdue ? 'text-danger' : '' }}">
                                {{ $bill->due_date->format('F d, Y') }}
                            </p>
                        </div>
                        @if($bill->paid_date)
                            <div>
                                <p class="text-muted small mb-0">Paid Date</p>
                                <p class="fw-medium text-success mb-0">{{ $bill->paid_date->format('F d, Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-muted small mb-1">Project</p>
                    <a href="{{ route('admin.projects.show', $bill->project) }}" class="text-decoration-none fw-medium">
                        {{ $bill->project->title }}
                    </a>
                </div>

                <!-- Items Table -->
                <div class="table-responsive mb-4">
                    <table class="table mb-0">
                        <thead>
                            <tr class="border-bottom border-2">
                                <th class="py-3 text-muted fw-semibold">Description</th>
                                <th class="py-3 text-muted fw-semibold text-center" style="width: 96px;">Qty</th>
                                <th class="py-3 text-muted fw-semibold text-end" style="width: 128px;">Unit Price</th>
                                <th class="py-3 text-muted fw-semibold text-end" style="width: 128px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill->items as $item)
                                <tr class="border-bottom">
                                    <td class="py-3">{{ $item->description }}</td>
                                    <td class="py-3 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 text-end">${{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-3 text-end">${{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Totals -->
                <div class="d-flex justify-content-end">
                    <div style="width: 256px;">
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">Subtotal</span>
                            <span>${{ number_format($bill->subtotal, 2) }}</span>
                        </div>
                        @if($bill->tax_rate > 0)
                            <div class="d-flex justify-content-between py-2">
                                <span class="text-muted">Tax ({{ $bill->tax_rate }}%)</span>
                                <span>${{ number_format($bill->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        @if($bill->discount > 0)
                            <div class="d-flex justify-content-between py-2">
                                <span class="text-muted">Discount</span>
                                <span class="text-danger">-${{ number_format($bill->discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between py-3 border-top border-2 border-dark mt-2">
                            <span class="fs-5 fw-bold">Total</span>
                            <span class="fs-5 fw-bold">${{ number_format($bill->total, 2) }}</span>
                        </div>
                    </div>
                </div>

                @if($bill->notes)
                    <div class="mt-4 p-3 bg-light rounded">
                        <h6 class="fw-semibold text-dark mb-2">Notes</h6>
                        <p class="text-muted mb-0">{{ $bill->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Status Actions -->
        @if($bill->status !== 'paid' && $bill->status !== 'cancelled')
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">Update Status</h6>
                    <form action="{{ route('admin.bills.status', $bill) }}" method="POST" class="row g-3 align-items-end">
                        @csrf
                        @method('PATCH')
                        <div class="col-12 col-md">
                            <label class="form-label small text-muted">Status</label>
                            <select name="status" id="statusSelect" class="form-select">
                                <option value="draft" {{ $bill->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="sent" {{ $bill->status == 'sent' ? 'selected' : '' }}>Sent</option>
                                <option value="paid">Paid</option>
                                <option value="overdue" {{ $bill->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-12 col-md d-none" id="paidDateContainer">
                            <label class="form-label small text-muted">Paid Date</label>
                            <input type="date" name="paid_date" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                        <div class="col-12 col-md-auto">
                            <button type="submit" class="btn btn-primary w-100">
                                Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.getElementById('statusSelect').addEventListener('change', function() {
    const paidDateContainer = document.getElementById('paidDateContainer');
    if (this.value === 'paid') {
        paidDateContainer.classList.remove('d-none');
    } else {
        paidDateContainer.classList.add('d-none');
    }
});
</script>
@endpush
@endsection