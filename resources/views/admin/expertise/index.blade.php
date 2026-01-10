@extends('admin.layouts.app')
@section('title', 'Expertise')
@section('page-title', 'Expertise / Capabilities')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-lightbulb me-2"></i>Manage Expertise</span>
        <a href="{{ route('admin.expertise.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle me-1"></i>Add New</a>
    </div>
    <div class="card-body p-0">
        @if($expertises->count() > 0)
        <table class="table table-hover mb-0">
            <thead><tr><th width="60">Order</th><th>Title</th><th>Outcomes</th><th width="80">Status</th><th width="120">Actions</th></tr></thead>
            <tbody>
                @foreach($expertises as $exp)
                <tr>
                    <td><span class="badge bg-secondary">{{ $exp->order }}</span></td>
                    <td><strong>{{ $exp->title }}</strong></td>
                    <td><span class="badge bg-info">{{ count($exp->outcomes ?? []) }} outcomes</span></td>
                    <td><span class="badge bg-{{ $exp->is_active ? 'success' : 'secondary' }}">{{ $exp->is_active ? 'Active' : 'Inactive' }}</span></td>
                    <td>
                        <a href="{{ route('admin.expertise.edit', $exp) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('admin.expertise.destroy', $exp) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button></form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center"><p class="text-muted">No expertise yet</p><a href="{{ route('admin.expertise.create') }}" class="btn btn-primary">Add First</a></div>
        @endif
    </div>
</div>
@endsection