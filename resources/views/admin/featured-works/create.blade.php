@extends('admin.layouts.app')
@section('title', 'Add Project')
@section('page-title', 'Add Project')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.featured-works.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Project Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Problem / Challenge</label>
                        <textarea class="form-control" name="problem" rows="3">{{ old('problem') }}</textarea>
                        <small class="text-muted">What problem did the client face?</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Solution</label>
                        <textarea class="form-control" name="solution" rows="3">{{ old('solution') }}</textarea>
                        <small class="text-muted">How did you solve it?</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Outcome / Results</label>
                        <textarea class="form-control" name="outcome" rows="3">{{ old('outcome') }}</textarea>
                        <small class="text-muted">What were the results?</small>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Project Image</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Client Type</label>
                        <select class="form-select" name="client_type">
                            <option value="">Select...</option>
                            @foreach($clientTypes as $value => $label)
                                <option value="{{ $value }}" {{ old('client_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
                    </div>

                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    <i class="bi bi-star-fill text-warning"></i> Featured
                                </label>
                            </div>
                            
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.featured-works.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>Create Project
                </button>
            </div>
        </form>
    </div>
</div>
@endsection