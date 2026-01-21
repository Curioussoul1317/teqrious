@extends('admin.layouts.app')
@section('title', 'Site Settings')
@section('page-title', 'Site Settings')
@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    
    @foreach($settings as $group => $items)
    <div class="card mb-4">
        <div class="card-header">
            <i class="bi bi-{{ $group == 'general' ? 'gear' : ($group == 'contact' ? 'telephone' : ($group == 'social' ? 'share' : 'search')) }} me-2"></i>
            {{ ucfirst($group) }} Settings
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($items as $setting)
                <div class="col-md-6 mb-3">
                    <label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
                    @if($setting->type === 'textarea')
                        <textarea class="form-control" name="settings[{{ $setting->key }}]" rows="3">{{ $setting->value }}</textarea>
                    @elseif($setting->type === 'image')
                        @if($setting->value)
                        <div class="mb-2"><img src="{{ asset('storage/' . $setting->value) }}" style="max-height: 60px;"></div>
                        @endif
                        <input type="file" class="form-control" name="settings[{{ $setting->key }}]" accept="image/*">
                    @else
                        <input type="text" class="form-control" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
    
    <button type="submit" class="btn btn-primary btn-lg">
        <i class="bi bi-check-circle me-1"></i>Save All Settings
    </button>
</form>

<div class="card mt-4">
    <div class="card-header">Add New Setting</div>
    <div class="card-body">
        <form action="{{ route('admin.settings.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label">Key</label>
                    <input type="text" class="form-control" name="key" required placeholder="setting_key">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Value</label>
                    <input type="text" class="form-control" name="value">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-select">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="image">Image</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-label">Group</label>
                    <select name="group" class="form-select">
                        <option value="general">General</option>
                        <option value="contact">Contact</option>
                        <option value="social">Social</option>
                        <option value="seo">SEO</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection