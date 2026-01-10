@extends('admin.layouts.app')
@section('title', 'Hero Slides')
@section('page-title', 'Hero Slides')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-images me-2"></i>Manage Hero Slides</span>
        <a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i>Add New</a>
    </div>
    <div class="card-body p-0">
        @if($slides->count() > 0)
        <table class="table table-hover mb-0">
            <thead><tr><th>Order</th><th>Image</th><th>Title</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @foreach($slides as $slide)
                <tr>
                    <td><span class="badge bg-secondary">{{ $slide->order }}</span></td>
                    <td>@if($slide->background_image)<img src="{{ asset('storage/' . $slide->background_image) }}" class="thumb-img">@endif</td>
                    <td><strong>{{ $slide->title }}</strong></td>
                    <td><span class="badge bg-{{ $slide->is_active ? 'success' : 'secondary' }}">{{ $slide->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.hero-slides.edit', $slide) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center"><p class="text-muted">No slides yet</p><a href="{{ route('admin.hero-slides.create') }}" class="btn btn-primary">Add First Slide</a></div>
        @endif
    </div>
</div>
@endsection
