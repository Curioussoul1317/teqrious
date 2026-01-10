@extends('admin.layouts.app')
@section('title', 'Add Highlight Card')
@section('page-title', 'Add Highlight Card')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.highlight-cards.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icon Type</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="icon_type" id="icon_class" value="class" checked>
                            <label class="btn btn-outline-primary" for="icon_class">Icon Class</label>
                            <input type="radio" class="btn-check" name="icon_type" id="icon_image" value="image">
                            <label class="btn btn-outline-primary" for="icon_image">Upload Image</label>
                        </div>
                    </div>

                    <div class="mb-3" id="iconClassField">
                        <label class="form-label">Icon Class (Bootstrap Icons)</label>
                        <input type="text" class="form-control" name="icon" value="{{ old('icon', 'bi bi-star') }}" placeholder="bi bi-star">
                        <small class="text-muted">Browse icons at <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a></small>
                    </div>

                    <div class="mb-3 d-none" id="iconImageField">
                        <label class="form-label">Icon Image</label>
                        <input type="file" class="form-control" name="icon_image" accept="image/*">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Display Order</label>
                                <input type="number" class="form-control" name="order" value="{{ old('order', 0) }}">
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
                <a href="{{ route('admin.highlight-cards.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>Create Card
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.querySelectorAll('input[name="icon_type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        document.getElementById('iconClassField').classList.toggle('d-none', this.value !== 'class');
        document.getElementById('iconImageField').classList.toggle('d-none', this.value !== 'image');
    });
});
</script>
@endpush
@endsection