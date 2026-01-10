@extends('admin.layouts.app')
@section('title', 'Edit Work Step')
@section('page-title', 'Edit Work Step')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.work-steps.update', $workStep) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $workStep->title) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $workStep->description) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" name="icon" value="{{ old('icon', $workStep->icon) }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Step Number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="step_number" value="{{ old('step_number', $workStep->step_number) }}" required min="1">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $workStep->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.work-steps.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Step</button>
            </div>
        </form>
    </div>
</div>
@endsection