@extends('admin.layouts.app')
@section('title', 'Values')
@section('page-title', 'Core Values (5 C\'s)')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-heart me-2"></i>Manage Values</span>
        <a href="{{ route('admin.values.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if($values->count() > 0)
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
                @foreach($values as $value)
                <tr>
                    <td><span class="badge bg-secondary">{{ $value->order }}</span></td>
                    <td><i class="{{ $value->icon ?? 'bi bi-heart' }} fs-4"></i></td>
                    <td><strong>{{ $value->title }}</strong></td>
                    <td><small class="text-muted">{{ Str::limit($value->description, 50) }}</small></td>
                    <td>
                        <span class="badge bg-{{ $value->is_active ? 'success' : 'secondary' }}">
                            {{ $value->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.values.edit', $value) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.values.destroy', $value) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center">
            <p class="text-muted">No values yet</p>
            <a href="{{ route('admin.values.create') }}" class="btn btn-primary">Add First Value</a>
        </div>
        @endif
    </div>
</div>
@endsection