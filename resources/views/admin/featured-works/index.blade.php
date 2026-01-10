@extends('admin.layouts.app')
@section('title', 'Projects')
@section('page-title', 'Featured Works / Projects')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-briefcase me-2"></i>Manage Projects</span>
        <a href="{{ route('admin.featured-works.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if($works->count() > 0)
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="80">Image</th>
                    <th>Title</th>
                    <th>Client Type</th>
                    <th width="80">Featured</th>
                    <th width="80">Status</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($works as $work)
                <tr>
                    <td>
                        @if($work->image)
                            <img src="{{ asset('storage/' . $work->image) }}" class="thumb-img">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px;height:40px;">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $work->title }}</strong></td>
                    <td>
                        @if($work->client_type)
                            <span class="badge bg-info">{{ ucfirst($work->client_type) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($work->is_featured)
                            <i class="bi bi-star-fill text-warning"></i>
                        @else
                            <i class="bi bi-star text-muted"></i>
                        @endif
                    </td>
                    <td>
                        <span class="badge bg-{{ $work->is_active ? 'success' : 'secondary' }}">
                            {{ $work->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.featured-works.edit', $work) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.featured-works.destroy', $work) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-3">{{ $works->links() }}</div>
        @else
        <div class="p-5 text-center">
            <i class="bi bi-briefcase fs-1 text-muted"></i>
            <p class="text-muted mt-3">No projects yet</p>
            <a href="{{ route('admin.featured-works.create') }}" class="btn btn-primary">Add First Project</a>
        </div>
        @endif
    </div>
</div>
@endsection