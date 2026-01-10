@extends("admin.layouts.app")
@section("content")
<div class="card">
    <div class="card-body"><form method="POST"><p>Form fields here</p><button class="btn btn-primary">Save</button></form></div>
</div>
@endsection
@extends('admin.layouts.app')
@section('title', 'View Quote')
@section('page-title', 'Quote Request Details')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header"><i class="bi bi-receipt me-2"></i>Request Details</div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Subsidiary:</strong> {{ $subsidiaryQuote->subsidiary->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Service:</strong> {{ $subsidiaryQuote->service->title ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Quantity:</strong> {{ $subsidiaryQuote->quantity ?? 'Not specified' }}
                    </div>
                </div>
                @if($subsidiaryQuote->requirements)
                <div class="mb-3">
                    <strong>Requirements:</strong>
                    <div class="mt-2 p-3 bg-light rounded">{{ $subsidiaryQuote->requirements }}</div>
                </div>
                @endif
                @if($subsidiaryQuote->attachment)
                <div class="p-3 bg-light rounded">
                    <strong>Attachment:</strong>
                    <a href="{{ asset('storage/' . $subsidiaryQuote->attachment) }}" target="_blank" class="ms-2">
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form action="{{ route('admin.subsidiary-quotes.update', $subsidiaryQuote) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $subsidiaryQuote->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Admin Notes</label>
                            <textarea name="admin_notes" class="form-control" rows="2">{{ $subsidiaryQuote->admin_notes }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Contact Info</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $subsidiaryQuote->name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $subsidiaryQuote->email }}">{{ $subsidiaryQuote->email }}</a></p>
                @if($subsidiaryQuote->phone)<p><strong>Phone:</strong> {{ $subsidiaryQuote->phone }}</p>@endif
                <p><strong>Received:</strong> {{ $subsidiaryQuote->created_at->format('M d, Y H:i') }}</p>
                <hr>
                <a href="{{ route('admin.subsidiary-quotes.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection