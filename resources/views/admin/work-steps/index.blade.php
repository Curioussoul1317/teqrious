@extends('admin.layouts.app')
@section('title', 'Work Steps')
@section('page-title', 'How We Work - Steps')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-diagram-3 me-2"></i>Manage Work Steps</span>
        <a href="{{ route('admin.work-steps.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if($steps->count() > 0)
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="80">Step #</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="80">Status</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($steps as $step)
                <tr>
                    <td><span class="badge bg-primary fs-6">{{ $step->step_number }}</span></td>
                    <td><strong>{{ $step->title }}</strong></td>
                    <td><small class="text-muted">{{ Str::limit($step->description, 60) }}</small></td>
                    <td>
                        <span class="badge bg-{{ $step->is_active ? 'success' : 'secondary' }}">
                            {{ $step->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.work-steps.edit', $step) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.work-steps.destroy', $step) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center">
            <p class="text-muted">No work steps yet</p>
            <a href="{{ route('admin.work-steps.create') }}" class="btn btn-primary">Add First Step</a>
        </div>
        @endif
    </div>
</div>
@endsection