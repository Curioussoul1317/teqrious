@extends('admin.layouts.app')
@section('title', 'Subsidiaries')
@section('page-title', 'Subsidiaries')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-building me-2"></i>Manage Subsidiaries</span>
        <a href="{{ route('admin.subsidiaries.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if($subsidiaries->count() > 0)
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">Order</th>
                    <th width="60">Logo</th>
                    <th>Name</th>
                    <th>Services</th>
                    <th>Quotes</th>
                    <th width="80">Status</th>
                    <th width="150">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subsidiaries as $subsidiary)
                <tr>
                    <td><span class="badge bg-secondary">{{ $subsidiary->order }}</span></td>
                    <td>
                        @if($subsidiary->logo)
                            <img src="{{ asset('storage/' . $subsidiary->logo) }}" width="40" height="40" class="rounded" style="object-fit: contain;">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:40px;height:40px;">
                                <i class="bi bi-building text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $subsidiary->name }}</strong>
                        @if($subsidiary->tagline)
                            <br><small class="text-muted">{{ $subsidiary->tagline }}</small>
                        @endif
                    </td>
                    <td><span class="badge bg-info">{{ $subsidiary->services_count }} services</span></td>
                    <td><span class="badge bg-warning">{{ $subsidiary->quotes_count }} quotes</span></td>
                    <td>
                        <span class="badge bg-{{ $subsidiary->is_active ? 'success' : 'secondary' }}">
                            {{ $subsidiary->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.subsidiaries.show', $subsidiary) }}" class="btn btn-sm btn-outline-info" title="Manage">
                            <i class="bi bi-gear"></i>
                        </a>
                        <a href="{{ route('admin.subsidiaries.edit', $subsidiary) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.subsidiaries.destroy', $subsidiary) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subsidiary and all its data?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" title="Delete"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center">
            <i class="bi bi-building fs-1 text-muted"></i>
            <p class="text-muted mt-3">No subsidiaries yet</p>
            <a href="{{ route('admin.subsidiaries.create') }}" class="btn btn-primary">Add First Subsidiary</a>
        </div>
        @endif
    </div>
</div>
@endsection