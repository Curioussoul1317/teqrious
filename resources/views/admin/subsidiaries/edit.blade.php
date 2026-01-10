@extends('admin.layouts.app')
@section('title', 'Edit Subsidiary')
@section('page-title', 'Edit Subsidiary')

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.subsidiaries.update', $subsidiary) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <h5 class="mb-3">Basic Information</h5>
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $subsidiary->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" value="{{ old('slug', $subsidiary->slug) }}">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Tagline</label>
                        <input type="text" class="form-control" name="tagline" value="{{ old('tagline', $subsidiary->tagline) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description', $subsidiary->description) }}</textarea>
                    </div>

                    <h5 class="mb-3 mt-4">Contact Information</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $subsidiary->email) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', $subsidiary->phone) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" name="whatsapp" value="{{ old('whatsapp', $subsidiary->whatsapp) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Website</label>
                            <input type="url" class="form-control" name="website" value="{{ old('website', $subsidiary->website) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="2">{{ old('address', $subsidiary->address) }}</textarea>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        @if($subsidiary->logo)
                            <div class="mb-2 p-3 bg-light rounded text-center">
                                <img src="{{ asset('storage/' . $subsidiary->logo) }}" style="max-height: 80px;">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="logo" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cover Image</label>
                        @if($subsidiary->cover_image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $subsidiary->cover_image) }}" class="img-fluid rounded">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="cover_image" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Display Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $subsidiary->order) }}">
                    </div>

                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $subsidiary->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.subsidiaries.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-1"></i>Update Subsidiary
                </button>
            </div>
        </form>
    </div>
</div>
@endsection