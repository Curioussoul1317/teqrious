@extends('admin.layouts.app')
@section('title', 'Edit Bill')
@section('page-title', 'Edit Bill')

@section('content')
<div class="container" style="max-width: 896px;">
    <div class="mb-4">
        <a href="{{ route('admin.bills.show', $bill) }}" class="text-secondary text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i> Back to Bill
        </a>
    </div>

    <form action="{{ route('admin.bills.update', $bill) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-semibold mb-0">Edit Bill: {{ $bill->bill_number }}</h5>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-12">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ old('title', $bill->title) }}" required
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="2" class="form-control">{{ old('description', $bill->description) }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Issue Date</label>
                        <input type="date" name="issue_date" value="{{ old('issue_date', $bill->issue_date->format('Y-m-d')) }}" required
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Due Date</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $bill->due_date->format('Y-m-d')) }}" required
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" id="taxRate" value="{{ old('tax_rate', $bill->tax_rate) }}" step="0.01"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Discount ($)</label>
                        <input type="number" name="discount" id="discount" value="{{ old('discount', $bill->discount) }}" step="0.01"
                               class="form-control">
                    </div>
                </div>

                <!-- Items -->
                <div class="border-top pt-4 mt-4">
                    <h6 class="fw-semibold mb-3">Line Items</h6>
                    <div id="itemsContainer" class="d-flex flex-column gap-3">
                        @foreach($bill->items as $index => $item)
                        <div class="item-row row g-2 align-items-end">
                            <div class="col-12 col-md-5">
                                <label class="form-label small text-muted">Description</label>
                                <input type="text" name="items[{{ $index }}][description]" value="{{ $item->description }}" required
                                       class="form-control form-control-sm">
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small text-muted">Qty</label>
                                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" required
                                       class="form-control form-control-sm item-qty">
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small text-muted">Price</label>
                                <input type="number" name="items[{{ $index }}][unit_price]" value="{{ $item->unit_price }}" step="0.01" required
                                       class="form-control form-control-sm item-price">
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small text-muted">Total</label>
                                <input type="text" readonly class="form-control form-control-sm bg-light item-total" 
                                       value="${{ number_format($item->total, 2) }}">
                            </div>
                            <div class="col-auto col-md-1">
                                <button type="button" onclick="this.closest('.item-row').remove(); calculateTotals();" 
                                        class="btn btn-link btn-sm text-danger p-0">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="addItem" class="btn btn-link text-decoration-none mt-3 p-0">
                        <i class="bi bi-plus-lg me-2"></i> Add Item
                    </button>
                </div>

                <!-- Totals -->
                <div class="border-top pt-4 mt-4 d-flex justify-content-end">
                    <div style="width: 256px;">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span id="subtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Tax:</span>
                            <span id="taxAmount">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Discount:</span>
                            <span id="discountAmount">-$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between fs-5 fw-bold border-top pt-2">
                            <span>Total:</span>
                            <span id="grandTotal">$0.00</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes', $bill->notes) }}</textarea>
                </div>
            </div>

            <div class="card-footer bg-light d-flex justify-content-end gap-3">
                <a href="{{ route('admin.bills.show', $bill) }}" class="btn btn-link text-secondary text-decoration-none">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-2"></i> Update Bill
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
let itemIndex = {{ $bill->items->count() }};

function calculateTotals() {
    let subtotal = 0;
    document.querySelectorAll('.item-row').forEach(row => {
        const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
        const price = parseFloat(row.querySelector('.item-price').value) || 0;
        const total = qty * price;
        row.querySelector('.item-total').value = '$' + total.toFixed(2);
        subtotal += total;
    });
    
    const taxRate = parseFloat(document.getElementById('taxRate').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const taxAmount = subtotal * (taxRate / 100);
    const grandTotal = subtotal + taxAmount - discount;
    
    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('taxAmount').textContent = '$' + taxAmount.toFixed(2);
    document.getElementById('discountAmount').textContent = '-$' + discount.toFixed(2);
    document.getElementById('grandTotal').textContent = '$' + grandTotal.toFixed(2);
}

document.getElementById('addItem').addEventListener('click', function() {
    const html = `
        <div class="item-row row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <input type="text" name="items[\${itemIndex}][description]" required class="form-control form-control-sm">
            </div>
            <div class="col-4 col-md-2">
                <input type="number" name="items[\${itemIndex}][quantity]" value="1" min="1" required class="form-control form-control-sm item-qty">
            </div>
            <div class="col-4 col-md-2">
                <input type="number" name="items[\${itemIndex}][unit_price]" step="0.01" required class="form-control form-control-sm item-price">
            </div>
            <div class="col-4 col-md-2">
                <input type="text" readonly class="form-control form-control-sm bg-light item-total" value="$0.00">
            </div>
            <div class="col-auto col-md-1">
                <button type="button" onclick="this.closest('.item-row').remove(); calculateTotals();" class="btn btn-link btn-sm text-danger p-0">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', html);
    itemIndex++;
});

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('item-qty') || e.target.classList.contains('item-price') || 
        e.target.id === 'taxRate' || e.target.id === 'discount') {
        calculateTotals();
    }
});

// Initial calculation
calculateTotals();
</script>
@endpush
@endsection