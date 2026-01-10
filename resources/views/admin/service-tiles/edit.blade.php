@extends('admin.layouts.app')
@section('title', 'Edit Service Tile')
@section('page-title', 'Edit Service Tile')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.service-tiles.update', $serviceTile) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $serviceTile->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Short Description</label>
                        <input type="text" class="form-control @error('short_description') is-invalid @enderror" name="short_description" value="{{ old('short_description', $serviceTile->short_description) }}" maxlength="255">
                        @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Icon Type</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="icon_type" id="icon_class" value="class" {{ $serviceTile->icon_type !== 'image' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="icon_class">Icon Class</label>
                            <input type="radio" class="btn-check" name="icon_type" id="icon_image" value="image" {{ $serviceTile->icon_type === 'image' ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="icon_image">Upload Image</label>
                        </div>
                    </div>

                    <div class="mb-3 {{ $serviceTile->icon_type === 'image' ? 'd-none' : '' }}" id="iconClassField">
                        <label class="form-label">Icon Class</label>
                        <input type="text" class="form-control" name="icon" value="{{ old('icon', $serviceTile->icon_type !== 'image' ? $serviceTile->icon : 'bi bi-grid') }}" placeholder="bi bi-grid">
                        <small class="text-muted">Browse icons at <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a></small>
                    </div>

                    <div class="mb-3 {{ $serviceTile->icon_type !== 'image' ? 'd-none' : '' }}" id="iconImageField">
                        <label class="form-label">Icon Image</label>
                        @if($serviceTile->icon_type === 'image' && $serviceTile->icon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $serviceTile->icon) }}" width="50" height="50" class="rounded">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="icon_image" accept="image/*">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Display Order</label>
                                <input type="number" class="form-control" name="order" value="{{ old('order', $serviceTile->order) }}">
                            </div>
                            
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $serviceTile->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.service-tiles.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>Update Tile
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