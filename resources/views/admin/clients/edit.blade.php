@extends('layouts.app')

@section('title', 'Edit Client')
@section('page-title', 'Edit Client')

@section('content')
<div class="container" style="max-width: 768px;">
    <div class="mb-4">
        <a href="{{ route('admin.clients.show', $client) }}" class="text-secondary text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i> Back to Client
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-semibold text-dark mb-0">Edit Client Information</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.clients.update', $client) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name', $client->name) }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">
                            Email Address <span class="text-danger">*</span>
                        </label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               value="{{ old('email', $client->email) }}"
                               class="form-control @error('email') is-invalid @enderror"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="company_name" class="form-label">
                            Company Name
                        </label>
                        <input type="text" 
                               name="company_name" 
                               id="company_name" 
                               value="{{ old('company_name', $client->company_name) }}"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">
                            Phone Number
                        </label>
                        <input type="text" 
                               name="phone" 
                               id="phone" 
                               value="{{ old('phone', $client->phone) }}"
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">
                            Address
                        </label>
                        <textarea name="address" 
                                  id="address" 
                                  rows="3"
                                  class="form-control">{{ old('address', $client->address) }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" 
                                   name="is_active" 
                                   id="is_active"
                                   value="1"
                                   {{ $client->is_active ? 'checked' : '' }}
                                   class="form-check-input">
                            <label for="is_active" class="form-check-label text-muted">Account is active</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-3 pt-4 mt-4 border-top">
                    <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-link text-secondary text-decoration-none">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i> Update Client
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Reset Password Section -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white py-3">
            <h6 class="fw-semibold text-dark mb-0">Reset Password</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.clients.reset-password', $client) }}" method="POST">
                @csrf
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label">
                            New Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password
                        </label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="form-control"
                               required>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-key me-2"></i> Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Danger Zone -->
    <div class="card border-danger border-opacity-50 shadow-sm mt-4">
        <div class="card-header bg-danger-subtle border-bottom border-danger border-opacity-25 py-3">
            <h6 class="fw-semibold text-danger mb-0">Danger Zone</h6>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-dark mb-1">Delete this client</p>
                    <p class="text-muted small mb-0">Once deleted, all associated data will be permanently removed.</p>
                </div>
                <form action="{{ route('admin.clients.destroy', $client) }}" 
                      method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this client? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-2"></i> Delete Client
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection