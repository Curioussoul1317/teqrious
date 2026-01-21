<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Project Manager')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Sidebar styles */
        .sidebar-link:hover {
            background-color: rgba(108, 117, 125, 0.3) !important;
            color: #fff !important;
        }
        .sidebar-link.active {
            color: #fff !important;
        }
        
        /* Dropdown toggle without caret */
        .dropdown-toggle-no-caret::after {
            display: none;
        }
        .dropdown-toggle-no-caret:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        /* Card hover effect for clickable cards */
        a.card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
            transform: translateY(-2px);
        }
        a.card {
            transition: all 0.2s ease-in-out;
        }
        
        /* Custom scrollbar for main content */
        .main-content {
            overflow-y: auto;
        }
        
        /* Ensure full height layout */
        html, body {
            height: 100%;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-light">
    <div class="d-flex" style="height: 100vh; overflow: hidden;">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Mobile Sidebar Offcanvas -->
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="mobileSidebar" style="width: 256px;">
            <div class="offcanvas-header border-bottom border-secondary">
                <h5 class="offcanvas-title fw-bold d-flex align-items-center gap-2">
                    <i class="bi bi-diagram-3"></i>
                    ProjectHub
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <nav class="mt-3">
                    @if(auth()->user()->isAdmin())
                        <div class="px-3 py-2 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem;">Main</div>
                        <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-speedometer2 me-3" style="width: 20px;"></i> Dashboard
                        </a>
                        <div class="px-3 py-2 mt-3 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem;">Management</div>
                        <a href="{{ route('admin.clients.index') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('admin.clients.*') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-people me-3" style="width: 20px;"></i> Clients
                        </a>
                        <a href="{{ route('admin.projects.index') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-folder me-3" style="width: 20px;"></i> Projects
                        </a>
                        <a href="{{ route('admin.bills.index') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('admin.bills.*') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-receipt me-3" style="width: 20px;"></i> Bills
                        </a>
                    @else
                        <div class="px-3 py-2 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem;">Main</div>
                        <a href="{{ route('client.dashboard') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('client.dashboard') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-speedometer2 me-3" style="width: 20px;"></i> Dashboard
                        </a>
                        <div class="px-3 py-2 mt-3 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem;">My Account</div>
                        <a href="{{ route('client.projects.index') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('client.projects.*') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-folder me-3" style="width: 20px;"></i> My Projects
                        </a>
                        <a href="{{ route('client.bills.index') }}" class="nav-link d-flex align-items-center px-3 py-3 text-white-50 sidebar-link {{ request()->routeIs('client.bills.*') ? 'active bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}">
                            <i class="bi bi-receipt me-3" style="width: 20px;"></i> My Bills
                        </a>
                    @endif
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="d-flex flex-column flex-grow-1" style="overflow: hidden;">
            <!-- Top Navigation -->
            @include('layouts.navbar')

            <!-- Page Content -->
            <main class="flex-grow-1 p-4 main-content">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between mb-4" role="alert" id="success-alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-between mb-4" role="alert">
                        <span>{{ session('error') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger mb-4" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
        // Auto-hide success alerts after 5 seconds
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>
</body>
</html>