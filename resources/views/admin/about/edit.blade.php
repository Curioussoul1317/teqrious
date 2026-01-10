@extends('admin.layouts.app')
@section('title', 'About Content')
@section('page-title', 'About Content')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $about->title ?? '') }}">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" rows="12" required>{{ old('content', $about->content ?? '') }}</textarea>
                        <small class="text-muted">HTML is allowed</small>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        @if(isset($about) && $about->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $about->image) }}" class="img-fluid rounded">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                </div>
            </div>

            <hr>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-1"></i>Save Changes
            </button>
        </form>
    </div>
</div>
@endsection