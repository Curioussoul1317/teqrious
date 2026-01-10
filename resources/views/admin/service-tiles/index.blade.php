@extends('admin.layouts.app')
@section('title', 'Service Tiles')
@section('page-title', 'Service Tiles')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-grid-3x3 me-2"></i>Manage Service Tiles</span>
        <a href="{{ route('admin.service-tiles.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if($tiles->count() > 0)
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">Order</th>
                    <th width="60">Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="80">Status</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tiles as $tile)
                <tr>
                    <td><span class="badge bg-secondary">{{ $tile->order }}</span></td>
                    <td>
                        @if($tile->icon_type === 'image' && $tile->icon)
                            <img src="{{ asset('storage/' . $tile->icon) }}" width="30" height="30" class="rounded">
                        @else
                            <i class="{{ $tile->icon ?? 'bi bi-grid' }} fs-4"></i>
                        @endif
                    </td>
                    <td><strong>{{ $tile->title }}</strong></td>
                    <td><small class="text-muted">{{ Str::limit($tile->short_description, 50) }}</small></td>
                    <td>
                        <span class="badge bg-{{ $tile->is_active ? 'success' : 'secondary' }}">
                            {{ $tile->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.service-tiles.edit', $tile) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.service-tiles.destroy', $tile) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center">
            <i class="bi bi-grid-3x3 fs-1 text-muted"></i>
            <p class="text-muted mt-3">No service tiles yet</p>
            <a href="{{ route('admin.service-tiles.create') }}" class="btn btn-primary">Add First Tile</a>
        </div>
        @endif
    </div>
</div>
@endsection