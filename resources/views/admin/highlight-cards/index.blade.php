@extends('admin.layouts.app')
@section('title', 'Highlight Cards')
@section('page-title', 'Highlight Cards')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-card-heading me-2"></i>Manage Highlight Cards</span>
        <a href="{{ route('admin.highlight-cards.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Add New
        </a>
    </div>
    <div class="card-body p-0">
        @if($cards->count() > 0)
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">Order</th>
                    <th width="60">Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="80">Status</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $card)
                <tr>
                    <td><span class="badge bg-secondary">{{ $card->order }}</span></td>
                    <td>
                        @if($card->icon_type === 'image' && $card->icon)
                            <img src="{{ asset('storage/' . $card->icon) }}" width="30" height="30" class="rounded">
                        @else
                            <i class="{{ $card->icon ?? 'bi bi-star' }} fs-4"></i>
                        @endif
                    </td>
                    <td><strong>{{ $card->title }}</strong></td>
                    <td><small class="text-muted">{{ Str::limit($card->description, 50) }}</small></td>
                    <td>
                        <span class="badge bg-{{ $card->is_active ? 'success' : 'secondary' }}">
                            {{ $card->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.highlight-cards.edit', $card) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.highlight-cards.destroy', $card) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="p-5 text-center">
            <i class="bi bi-card-heading fs-1 text-muted"></i>
            <p class="text-muted mt-3">No highlight cards yet</p>
            <a href="{{ route('admin.highlight-cards.create') }}" class="btn btn-primary">Add First Card</a>
        </div>
        @endif
    </div>
</div>
@endsection