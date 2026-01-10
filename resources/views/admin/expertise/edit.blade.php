@extends('admin.layouts.app')
@section('title', 'Edit Expertise')
@section('page-title', 'Edit Expertise')
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.expertise.update', $expertise) }}" method="POST">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3"><label class="form-label">Title *</label><input type="text" class="form-control" name="title" value="{{ old('title', $expertise->title) }}" required></div>
                    <div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="3">{{ old('description', $expertise->description) }}</textarea></div>
                    <div class="mb-3"><label class="form-label">Icon Class</label><input type="text" class="form-control" name="icon" value="{{ old('icon', $expertise->icon) }}"></div>
                    <div class="mb-3">
                        <label class="form-label">Outcomes</label>
                        <div id="outcomes-container">
                            @foreach($expertise->outcomes ?? [] as $outcome)
                            <div class="input-group mb-2"><input type="text" class="form-control" name="outcomes[]" value="{{ $outcome }}"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button></div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addOutcome()"><i class="bi bi-plus"></i> Add</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3"><label class="form-label">Order</label><input type="number" class="form-control" name="order" value="{{ $expertise->order }}"></div>
                    <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $expertise->is_active ? 'checked' : '' }}><label class="form-check-label">Active</label></div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.expertise.index') }}" class="btn btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
function addOutcome(){
    document.getElementById('outcomes-container').insertAdjacentHTML('beforeend',
    '<div class="input-group mb-2"><input type="text" class="form-control" name="outcomes[]"><button type="button" class="btn btn-outline-danger" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button></div>');
}
</script>
@endpush
@endsection