@extends('admin.layouts.app')
@section('title', 'Services')
@section('page-title', 'Services')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-gear me-2"></i>Manage Services</span>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i>Add New</a>
    </div>
    <div class="card-body p-0">
        @if($services->count() > 0)
        <table class="table table-hover mb-0">
            <thead><tr><th width="60">Order</th><th>Title</th><th>Includes</th><th>Deliverables</th><th width="80">Status</th><th width="120">Actions</th></tr></thead>
            <tbody>
                @foreach($services as $service)
                <tr>
                    <td><span class="badge bg-secondary">{{ $service->order }}</span></td>
                    <td><strong>{{ $service->title }}</strong></td>
                    <td><span class="badge bg-info">{{ count($service->includes ?? []) }}</span></td>
                    <td><span class="badge bg-warning">{{ count($service->deliverables ?? []) }}</span></td>
                    <td><span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">{{ $service->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center"><p class="text-muted">No services yet</p><a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add First</a></div>
        @endif
    </div>
</div>
@endsection