@extends('admin.layouts.app')
@section('title', 'Contacts')
@section('page-title', 'Contact Messages')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col"><i class="bi bi-envelope me-2"></i>Contact Messages</div>
            <div class="col-auto">
                <form class="d-flex gap-2">
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
                </form>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if($contacts->count() > 0)
        <table class="table table-hover mb-0">
            <thead><tr><th>Contact</th><th>Type</th><th>Service</th><th>Status</th><th>Date</th><th width="100">Actions</th></tr></thead>
            <tbody>
                @foreach($contacts as $contact)
                <tr>
                    <td>
                        <strong>{{ $contact->name }}</strong><br>
                        <small class="text-muted">{{ $contact->email }}</small>
                        @if($contact->company)<br><small>{{ $contact->company }}</small>@endif
                    </td>
                    <td>{{ ucfirst($contact->contact_type) }}</td>
                    <td>{{ $contact->service->title ?? '-' }}</td>
                    <td><span class="badge status-{{ $contact->status }}">{{ ucfirst($contact->status) }}</span></td>
                    <td><small>{{ $contact->created_at->format('M d, Y') }}</small></td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $contacts->links() }}</div>
        @else
        <div class="p-5 text-center text-muted">No contacts yet</div>
        @endif
    </div>
</div>
@endsection