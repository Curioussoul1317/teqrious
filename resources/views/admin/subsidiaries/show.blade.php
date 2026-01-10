@extends("admin.layouts.app")
@section("content")
<div class="card">
    <div class="card-body"><form method="POST"><p>Form fields here</p><button class="btn btn-primary">Save</button></form></div>
</div>
@endsection
@extends('admin.layouts.app')
@section('title', $subsidiary->name)
@section('page-title', 'Manage: ' . $subsidiary->name)

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                @if($subsidiary->logo)
                    <img src="{{ asset('storage/' . $subsidiary->logo) }}" style="max-height: 100px;" class="mb-3">
                @endif
                <h5>{{ $subsidiary->name }}</h5>
                @if($subsidiary->tagline)
                    <p class="text-muted">{{ $subsidiary->tagline }}</p>
                @endif
                <a href="{{ route('subsidiary.show', $subsidiary->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-box-arrow-up-right me-1"></i>View Page
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-header"><i class="bi bi-info-circle me-2"></i>Quick Info</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <strong>Email:</strong> {{ $subsidiary->email ?? 'N/A' }}<br>
                        <strong>Phone:</strong> {{ $subsidiary->phone ?? 'N/A' }}
                    </div>
                    <div class="col-6">
                        <strong>WhatsApp:</strong> {{ $subsidiary->whatsapp ?? 'N/A' }}<br>
                        <strong>Status:</strong> 
                        <span class="badge bg-{{ $subsidiary->is_active ? 'success' : 'secondary' }}">
                            {{ $subsidiary->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-gear me-2"></i>Services ({{ $subsidiary->services->count() }})</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            <i class="bi bi-plus-circle me-1"></i>Add Service
        </button>
    </div>
    <div class="card-body p-0">
        @if($subsidiary->services->count() > 0)
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th width="100">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subsidiary->services as $service)
                <tr>
                    <td><strong>{{ $service->title }}</strong></td>
                    <td><small class="text-muted">{{ Str::limit($service->description, 50) }}</small></td>
                    <td>{{ $service->price ? 'MVR ' . number_format($service->price, 2) : '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $service->is_active ? 'success' : 'secondary' }}">
                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="editService({{ json_encode($service) }})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('admin.subsidiaries.services.destroy', [$subsidiary, $service]) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this service?')">
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
        <div class="p-4 text-center text-muted">No services added yet</div>
        @endif
    </div>
</div>

<!-- Gallery Section -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-images me-2"></i>Gallery ({{ $subsidiary->gallery->count() }})</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
            <i class="bi bi-plus-circle me-1"></i>Add Image
        </button>
    </div>
    <div class="card-body">
        @if($subsidiary->gallery->count() > 0)
        <div class="row g-3">
            @foreach($subsidiary->gallery as $image)
            <div class="col-6 col-md-3">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid rounded" style="height: 150px; width: 100%; object-fit: cover;">
                    <form action="{{ route('admin.subsidiaries.gallery.destroy', [$subsidiary, $image]) }}" method="POST" class="position-absolute top-0 end-0 m-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this image?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center text-muted">No gallery images yet</div>
        @endif
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.subsidiaries.services.store', $subsidiary) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icon Class</label>
                            <input type="text" class="form-control" name="icon" placeholder="bi bi-star">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (MVR)</label>
                            <input type="number" class="form-control" name="price" step="0.01">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" class="form-control" name="order" value="0">
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editServiceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" class="form-control" name="title" id="edit_title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_description" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Icon Class</label>
                            <input type="text" class="form-control" name="icon" id="edit_icon">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Price (MVR)</label>
                            <input type="number" class="form-control" name="price" id="edit_price" step="0.01">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order</label>
                            <input type="number" class="form-control" name="order" id="edit_order">
                        </div>
                        <div class="col-md-6 mb-3 d-flex align-items-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Gallery Modal -->
<div class="modal fade" id="addGalleryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.subsidiaries.gallery.store', $subsidiary) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Gallery Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Image *</label>
                        <input type="file" class="form-control" name="image" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title (optional)</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editService(service) {
    document.getElementById('editServiceForm').action = '{{ route("admin.subsidiaries.services.update", [$subsidiary, ""]) }}/' + service.id;
    document.getElementById('edit_title').value = service.title;
    document.getElementById('edit_description').value = service.description || '';
    document.getElementById('edit_icon').value = service.icon || '';
    document.getElementById('edit_price').value = service.price || '';
    document.getElementById('edit_order').value = service.order || 0;
    document.getElementById('edit_is_active').checked = service.is_active;
    new bootstrap.Modal(document.getElementById('editServiceModal')).show();
}
</script>
@endpush
@endsection