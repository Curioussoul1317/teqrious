@extends("admin.layouts.app")
@section("content")
<div class="card">
    <div class="card-header d-flex justify-content-between"><span>Manage Items</span><a href="{{ url()->current() }}/create" class="btn btn-primary btn-sm">Add New</a></div>
    <div class="card-body"><p>Add content management here</p></div>
</div>
@endsection
@extends('admin.layouts.app')
@section('title', 'Quotes')
@section('page-title', 'Subsidiary Quote Requests')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col"><i class="bi bi-receipt me-2"></i>Quote Requests</div>
            <div class="col-auto">
                <form class="d-flex gap-2">
                    <select name="subsidiary_id" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Subsidiaries</option>
                        @foreach($subsidiaries as $sub)
                        <option value="{{ $sub->id }}" {{ request('subsidiary_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($quotes->count() > 0)
        <table class="table table-hover mb-0">
            <thead><tr><th>Contact</th><th>Subsidiary</th><th>Service</th><th>Qty</th><th>Status</th><th>Date</th><th width="100">Actions</th></tr></thead>
            <tbody>
                @foreach($quotes as $quote)
                <tr>
                    <td>
                        <strong>{{ $quote->name }}</strong><br>
                        <small class="text-muted">{{ $quote->email }}</small>
                    </td>
                    <td>{{ $quote->subsidiary->name ?? '-' }}</td>
                    <td>{{ $quote->service->title ?? '-' }}</td>
                    <td>{{ $quote->quantity ?? '-' }}</td>
                    <td><span class="badge status-{{ $quote->status }}">{{ ucfirst($quote->status) }}</span></td>
                    <td><small>{{ $quote->created_at->format('M d, Y') }}</small></td>
                    <td>
                        <a href="{{ route('admin.subsidiary-quotes.show', $quote) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.subsidiary-quotes.destroy', $quote) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $quotes->links() }}</div>
        @else
        <div class="p-5 text-center text-muted">No quote requests yet</div>
        @endif
    </div>
</div>
@endsection