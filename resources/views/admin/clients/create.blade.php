@extends('admin.layouts.app')

@section('title', 'Add Client')
@section('page-title', 'Add New Client')

@section('content')
<div class="container" style="max-width: 768px;">
    <div class="mb-4">
        <a href="{{ route('admin.clients.index') }}" class="text-secondary text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i> Back to Clients
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <h5 class="fw-semibold text-dark mb-1">Client Information</h5>
            <p class="text-muted small mb-0">Add a new client to your system</p>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">
                            Full Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               value="{{ old('name') }}"
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
                               value="{{ old('email') }}"
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
                               value="{{ old('company_name') }}"
                               class="form-control">
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">
                            Phone Number
                        </label>
                        <input type="text" 
                               name="phone" 
                               id="phone" 
                               value="{{ old('phone') }}"
                               class="form-control">
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label">
                            Address
                        </label>
                        <textarea name="address" 
                                  id="address" 
                                  rows="3"
                                  class="form-control">{{ old('address') }}</textarea>
                    </div>
                </div>

                <div class="border-top pt-4 mt-4">
                    <h6 class="fw-medium text-dark mb-3">Account Credentials</h6>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Leave blank to auto-generate">
                        <div class="form-text">If left blank, a random password will be generated.</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" 
                               name="send_credentials" 
                               id="send_credentials"
                               value="1"
                               class="form-check-input">
                        <label for="send_credentials" class="form-check-label text-muted">
                            Send login credentials to client via email
                        </label>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-end gap-3 pt-4 mt-4 border-top">
                    <a href="{{ route('admin.clients.index') }}" class="btn btn-link text-secondary text-decoration-none">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-2"></i> Create Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection