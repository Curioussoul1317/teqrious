@extends('admin.layouts.app')
@section('title', 'Edit Value')
@section('page-title', 'Edit Value')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.values.update', $value) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $value->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $value->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" name="icon" value="{{ old('icon', $value->icon) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $value->order) }}">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $value->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.values.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Value</button>
            </div>
        </form>
    </div>
</div>
@endsection