@extends('layouts.app')

@section('title', 'Create Bill')
@section('page-title', 'Create New Bill')

@section('content')
<div class="container" style="max-width: 896px;">
    <div class="mb-4">
        <a href="{{ route('admin.bills.index') }}" class="text-secondary text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i> Back to Bills
        </a>
    </div>

    <form action="{{ route('admin.bills.store') }}" method="POST" id="billForm">
        @csrf
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="fw-semibold mb-0">Bill Details</h5>
            </div>

            <div class="card-body">
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Client <span class="text-danger">*</span></label>
                        <select name="client_id" id="clientSelect" class="form-select" required>
                            <option value="">Select a client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', request('client_id')) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Project <span class="text-danger">*</span></label>
                        <select name="project_id" id="projectSelect" class="form-select" required>
                            <option value="">Select a project</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id', request('project_id')) == $project->id ? 'selected' : '' }}>
                                    {{ $project->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Bill Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="2" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Issue Date <span class="text-danger">*</span></label>
                        <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Due Date <span class="text-danger">*</span></label>
                        <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+30 days'))) }}" required
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" id="taxRate" value="{{ old('tax_rate', 0) }}" step="0.01" min="0" max="100"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Discount ($)</label>
                        <input type="number" name="discount" id="discount" value="{{ old('discount', 0) }}" step="0.01" min="0"
                               class="form-control">
                    </div>
                </div>

                <!-- Bill Items -->
                <div class="border-top pt-4 mt-4">
                    <h6 class="fw-semibold mb-3">Line Items</h6>
                    <div id="itemsContainer" class="d-flex flex-column gap-3">
                        <div class="item-row row g-2 align-items-end">
                            <div class="col-12 col-md-6">
                                <label class="form-label small text-muted">Description</label>
                                <input type="text" name="items[0][description]" required class="form-control form-control-sm">
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small text-muted">Qty</label>
                                <input type="number" name="items[0][quantity]" value="1" min="1" required class="form-control form-control-sm item-qty">
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small text-muted">Price</label>
                                <input type="number" name="items[0][unit_price]" step="0.01" min="0" required class="form-control form-control-sm item-price">
                            </div>
                            <div class="col-4 col-md-2">
                                <label class="form-label small text-muted">Total</label>
                                <input type="text" readonly class="form-control form-control-sm bg-light item-total" value="$0.00">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="addItem" class="btn btn-link text-decoration-none mt-3 p-0">
                        <i class="bi bi-plus-lg me-2"></i> Add Item
                    </button>
                </div>

                <!-- Totals -->
                <div class="border-top pt-4 mt-4">
                    <div class="d-flex justify-content-end">
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
                </div>

                <div class="mt-4">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="card-footer bg-light d-flex justify-content-between">
                <button type="submit" name="status" value="draft" class="btn btn-secondary">
                    <i class="bi bi-save me-2"></i> Save as Draft
                </button>
                <button type="submit" name="status" value="sent" class="btn btn-primary">
                    <i class="bi bi-send me-2"></i> Create & Send
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
let itemIndex = 0;

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
    itemIndex++;
    const html = `
        <div class="item-row row g-2 align-items-end">
            <div class="col-12 col-md-5">
                <input type="text" name="items[\${itemIndex}][description]" required class="form-control form-control-sm">
            </div>
            <div class="col-4 col-md-2">
                <input type="number" name="items[\${itemIndex}][quantity]" value="1" min="1" required class="form-control form-control-sm item-qty">
            </div>
            <div class="col-4 col-md-2">
                <input type="number" name="items[\${itemIndex}][unit_price]" step="0.01" min="0" required class="form-control form-control-sm item-price">
            </div>
            <div class="col-3 col-md-2">
                <input type="text" readonly class="form-control form-control-sm bg-light item-total" value="$0.00">
            </div>
            <div class="col-1">
                <button type="button" onclick="this.closest('.item-row').remove(); calculateTotals();" class="btn btn-link btn-sm text-danger p-0">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', html);
});

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('item-qty') || e.target.classList.contains('item-price') || 
        e.target.id === 'taxRate' || e.target.id === 'discount') {
        calculateTotals();
    }
});

// Client -> Project dynamic loading
document.getElementById('clientSelect').addEventListener('change', function() {
    const clientId = this.value;
    const projectSelect = document.getElementById('projectSelect');
    projectSelect.innerHTML = '<option value="">Loading...</option>';
    
    if (clientId) {
        fetch(`/admin/clients/${clientId}/projects`)
            .then(r => r.json())
            .then(projects => {
                projectSelect.innerHTML = '<option value="">Select a project</option>';
                projects.forEach(p => {
                    projectSelect.innerHTML += `<option value="${p.id}">${p.title}</option>`;
                });
            });
    } else {
        projectSelect.innerHTML = '<option value="">Select client first</option>';
    }
});
</script>
@endpush
@endsection