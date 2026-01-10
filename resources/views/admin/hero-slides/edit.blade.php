@extends('admin.layouts.app')
@section('title', isset($heroSlide) ? 'Edit Hero Slide' : 'Add Hero Slide')
@section('page-title', isset($heroSlide) ? 'Edit Hero Slide' : 'Add Hero Slide')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($heroSlide) ? route('admin.hero-slides.update', $heroSlide) : route('admin.hero-slides.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($heroSlide)) @method('PUT') @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $heroSlide->title ?? '') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3">{{ old('description', $heroSlide->description ?? '') }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Button Text</label>
                            <input type="text" class="form-control" name="button_text" value="{{ old('button_text', $heroSlide->button_text ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Button Link</label>
                            <input type="text" class="form-control" name="button_link" value="{{ old('button_link', $heroSlide->button_link ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Background Image</label>
                        @if(isset($heroSlide) && $heroSlide->background_image)
                            <div class="mb-2"><img src="{{ asset('storage/' . $heroSlide->background_image) }}" class="img-fluid rounded"></div>
                        @endif
                        <input type="file" class="form-control" name="background_image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" class="form-control" name="order" value="{{ old('order', $heroSlide->order ?? 0) }}">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ old('is_active', $heroSlide->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.hero-slides.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">{{ isset($heroSlide) ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
