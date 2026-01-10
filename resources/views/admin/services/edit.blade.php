@extends('admin.layouts.app')
@section('title', 'Edit Service')
@section('page-title', 'Edit Service')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.services.update', $service) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title', $service->title) }}" required></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="3">{{ old('description', $service->description) }}</textarea></div>
                    <div class="mb-3"><label class="form-label">Icon Class</label><input type="text" class="form-control" name="icon" value="{{ old('icon', $service->icon) }}"></div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">What's Included</label>
                                <div id="includes-container">
                                    @foreach($service->includes ?? [] as $item)
                                    <div class="input-group mb-2"><input type="text" class="form-control" name="includes[]" value="{{ $item }}"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button></div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addInclude()"><i class="bi bi-plus"></i> Add</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Deliverables</label>
                                <div id="deliverables-container">
                                    @foreach($service->deliverables ?? [] as $item)
                                    <div class="input-group mb-2"><input type="text" class="form-control" name="deliverables[]" value="{{ $item }}"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button></div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addDeliverable()"><i class="bi bi-plus"></i> Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ $service->order }}"></div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $service->is_active ? 'checked' : '' }}><label class="form-check-label">Active</label></div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
function addInclude(){document.getElementById('includes-container').insertAdjacentHTML('beforeend','<div class="input-group mb-2"><input type="text" class="form-control" name="includes[]"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button></div>');}
function addDeliverable(){document.getElementById('deliverables-container').insertAdjacentHTML('beforeend','<div class="input-group mb-2"><input type="text" class="form-control" name="deliverables[]"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button></div>');}
</script>
@endpush
@endsection