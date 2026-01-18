@extends('admin.layouts.app')

@section('title', 'Clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Clients</h1>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Client</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">
    <div class="card-body">
        @if($clients->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th width="80">Logo</th>
                        <th>Name</th>
                        <th width="100">Order</th>
                        <th width="100">Status</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                    <tr>
                        <td>
                            @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" style="max-height: 40px; max-width: 60px; object-fit: contain;">
                            @else
                            <span class="text-muted">No logo</span>
                            @endif
                        </td>
                        <td><strong>{{ $client->name }}</strong></td>
                        <td>{{ $client->order }}</td>
                        <td>
                            @if($client->is_active)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this client?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $clients->links() }}
        @else
        <div class="text-center py-5">
            <i class="bi bi-people display-1 text-muted"></i>
            <p class="text-muted mt-3">No clients yet.</p>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Add Client</a>
        </div>
        @endif
    </div>
</div>
@endsection
