<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - TEQRIOUS ProjectHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="/img/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/img/favicon.svg" />
    <link rel="shortcut icon" href="/img/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-touch-icon.png" />
    <meta name="theme-color" content="#001348">
    <style>
        :root {
            --primary: #001348;
            --secondary: #aa134a;
            --third: #cb9430;
            --sidebar-width: 256px;
        }
        
        body {
            background: #f4f6f9;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: #212529;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(108, 117, 125, 0.3);
        }
        
        .sidebar-brand h4 {
            color: #fff;
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar-brand h4 span {
            color: var(--third);
        }
        
        .sidebar-heading {
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.75rem;
            text-transform: uppercase;
            padding: 1rem 1.25rem 0.5rem;
            letter-spacing: 0.05em;
            font-weight: 600;
        }
        
        .sidebar-nav {
            padding: 0.5rem 0;
        }
        
        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
            text-decoration: none;
        }
        
        .sidebar-nav .nav-link:hover {
            color: #fff;
            background: rgba(108, 117, 125, 0.3);
        }
        
        .sidebar-nav .nav-link.active {
            color: #fff;
            background: rgba(108, 117, 125, 0.5);
            border-left-color: var(--primary);
        }
        
        .sidebar-nav .nav-link i {
            width: 20px;
            font-size: 1rem;
        }
        
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid rgba(108, 117, 125, 0.3);
            margin-top: auto;
        }
        
        /* Main Content Area */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header Styles */
        .top-header {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 0.75rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .main-content {
            padding: 1.5rem;
            flex: 1;
        }
        
        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
        }
        
        .card-header {
            background: #fff;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }
        
        /* Button Styles */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background: #00205a;
            border-color: #00205a;
        }
        
        /* Mobile Toggle Button */
        .sidebar-toggle {
            display: none;
        }
        
        /* Mobile Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .main-wrapper {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: block;
            }
        }
        
        /* User initials avatar */
        .user-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        /* Progress bar colors */
        .progress-bar.bg-success { background-color: #198754 !important; }
        .progress-bar.bg-primary { background-color: var(--primary) !important; }
        .progress-bar.bg-warning { background-color: #ffc107 !important; }
        .progress-bar.bg-danger { background-color: #dc3545 !important; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar d-flex flex-column" id="sidebar">
        <div class="sidebar-brand">
            <h4>TEQ<span>RIOUS</span></h4>
            <small class="text-white-50">ProjectHub</small>
        </div>
        
        <nav class="sidebar-nav flex-grow-1 mt-2">
            @if(auth()->user()->isAdmin())
                {{-- Admin Navigation --}}
                <div class="sidebar-heading">Main</div>
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <div class="sidebar-heading">Management</div>
                <a href="{{ route('admin.clients.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Clients
                </a>
                <a href="{{ route('admin.projects.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-folder"></i>
                    Projects
                </a>
                <a href="{{ route('admin.bills.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.bills.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    Bills
                </a>
            @else
                {{-- Client Navigation --}}
                <div class="sidebar-heading">Main</div>
                <a href="{{ route('client.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <div class="sidebar-heading">My Account</div>
                <a href="{{ route('client.projects.index') }}" 
                   class="nav-link {{ request()->routeIs('client.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-folder"></i>
                    My Projects
                </a>
                <a href="{{ route('client.bills.index') }}" 
                   class="nav-link {{ request()->routeIs('client.bills.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i>
                    My Bills
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('profile') }}" 
               class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                Settings
            </a>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="top-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <!-- Mobile menu button -->
                    <button class="sidebar-toggle btn btn-link text-secondary p-0" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    
                    <h2 class="h5 fw-semibold text-dark mb-0">
                        @yield('page-title', 'Dashboard')
                    </h2>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Notifications -->
                    <button class="btn btn-link text-secondary p-0 position-relative">
                        <i class="bi bi-bell fs-5"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-link text-decoration-none d-flex align-items-center gap-2 p-2 rounded" 
                                type="button" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                            <div class="user-avatar">
                                {{ auth()->user()->initials }}
                            </div>
                            <div class="d-none d-sm-block text-start">
                                <p class="small fw-medium text-dark mb-0">{{ auth()->user()->name }}</p>
                                <p class="small text-muted mb-0 text-capitalize">{{ auth()->user()->role }}</p>
                            </div>
                            <i class="bi bi-chevron-down text-muted small"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="bi bi-person me-2"></i> Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });
        }
        
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>