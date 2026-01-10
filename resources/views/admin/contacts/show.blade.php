@extends('admin.layouts.app')
@section('title', 'View Contact')
@section('page-title', 'Contact Details')
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header"><i class="bi bi-envelope me-2"></i>Message</div>
            <div class="card-body">
                <div class="mb-4">{{ $contact->message }}</div>
                @if($contact->attachment)
                <div class="p-3 bg-light rounded">
                    <strong>Attachment:</strong>
                    <a href="{{ asset('storage/' . $contact->attachment) }}" target="_blank" class="ms-2">
                        <i class="bi bi-download"></i> Download
                    </a>
                </div>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header">Update Status</div>
            <div class="card-body">
                <form action="{{ route('admin.contacts.update', $contact) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="new" {{ $contact->status == 'new' ? 'selected' : '' }}>New</option>
                                <option value="read" {{ $contact->status == 'read' ? 'selected' : '' }}>Read</option>
                                <option value="replied" {{ $contact->status == 'replied' ? 'selected' : '' }}>Replied</option>
                                <option value="closed" {{ $contact->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Admin Notes</label>
                            <textarea name="admin_notes" class="form-control" rows="2">{{ $contact->admin_notes }}</textarea>
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
                <p><strong>Name:</strong> {{ $contact->name }}</p>
                <p><strong>Email:</strong> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                @if($contact->phone)<p><strong>Phone:</strong> {{ $contact->phone }}</p>@endif
                @if($contact->company)<p><strong>Company:</strong> {{ $contact->company }}</p>@endif
                <p><strong>Type:</strong> {{ ucfirst($contact->contact_type) }}</p>
                @if($contact->service)<p><strong>Service:</strong> {{ $contact->service->title }}</p>@endif
                <p><strong>Received:</strong> {{ $contact->created_at->format('M d, Y H:i') }}</p>
                <hr>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>
@endsection