<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - TEQRIOUS Admin</title>
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
            --sidebar-width: 260px; 
        }
        
        body { 
            background: #f4f6f9; 
        }
        
        /* Sidebar */
        .sidebar { 
            position: fixed; 
            top: 0; 
            left: 0; 
            width: var(--sidebar-width); 
            height: 100vh; 
            background: var(--primary); 
            overflow-y: auto; 
            z-index: 1000; 
        }
        
        .sidebar-brand { 
            padding: 1.5rem; 
            border-bottom: 1px solid rgba(255,255,255,0.1); 
        }
        
        .sidebar-brand h4 { 
            color: #fff; 
            margin: 0; 
            font-weight: 800; 
        }
        
        .sidebar-brand span { 
            color: var(--third); 
        }
        
        .sidebar-nav { 
            padding: 1rem 0; 
        }
        
        .sidebar-nav .nav-link { 
            color: rgba(255,255,255,0.7); 
            padding: 0.75rem 1.5rem; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            transition: all 0.2s; 
            text-decoration: none;
        }
        
        .sidebar-nav .nav-link:hover, 
        .sidebar-nav .nav-link.active { 
            color: #fff; 
            background: rgba(255,255,255,0.1); 
        }
        
        .sidebar-nav .nav-link i { 
            width: 20px; 
        }
        
        .sidebar-heading { 
            color: rgba(255,255,255,0.4); 
            font-size: 0.75rem; 
            text-transform: uppercase; 
            padding: 1rem 1.5rem 0.5rem; 
            letter-spacing: 1px; 
        }
        
        /* Main Content */
        .main-content { 
            margin-left: var(--sidebar-width); 
            padding: 2rem; 
            min-height: 100vh; 
        }
        
        .top-bar { 
            background: #fff; 
            padding: 1rem 1.5rem; 
            margin: -2rem -2rem 2rem; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        
        /* Cards */
        .card { 
            border: none; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
            border-radius: 10px; 
        }
        
        .card-header { 
            background: #fff; 
            border-bottom: 1px solid #eee; 
            font-weight: 600; 
        }
        
        /* Buttons */
        .btn-primary { 
            background: var(--primary); 
            border-color: var(--primary); 
        }
        
        .btn-primary:hover { 
            background: var(--secondary); 
            border-color: var(--secondary); 
        }
        
        /* Status badges */
        .thumb-img { width: 60px; height: 40px; object-fit: cover; border-radius: 5px; }
        .badge.status-new { background: var(--third); }
        .badge.status-read, .badge.status-reviewed { background: #17a2b8; }
        .badge.status-replied, .badge.status-quoted { background: #28a745; }
        .badge.status-closed, .badge.status-rejected { background: #6c757d; }
        .badge.status-accepted { background: var(--secondary); }
        
        /* User avatar */
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
            font-size: 0.75rem;
        }
        
        /* Mobile toggle */
        .sidebar-toggle {
            display: none;
        }
        
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
                transition: transform 0.3s; 
            }
            
            .sidebar.show { 
                transform: translateX(0); 
            }
            
            .sidebar-overlay.show {
                display: block;
            }
            
            .main-content { 
                margin-left: 0; 
            }
            
            .sidebar-toggle {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4>TEQ<span>RIOUS</span></h4>
            <small class="text-white-50">Admin Panel</small>
        </div>
        
        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
                {{-- Admin Navigation --}}
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                
                <div class="sidebar-heading">Home Page</div>
                <a href="{{ route('admin.hero-slides.index') }}" class="nav-link {{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Hero Slides
                </a>
                </a>
                <a href="{{ route('admin.featured-works.index') }}" class="nav-link {{ request()->routeIs('admin.featured-works.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase"></i> Projects
                </a>
                
                <div class="sidebar-heading">Management</div>
                <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Clients
                </a>
                <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-folder"></i> Projects
                </a>
                <a href="{{ route('admin.bills.index') }}" class="nav-link {{ request()->routeIs('admin.bills.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> Bills
                </a>
                
                <div class="sidebar-heading">About</div>
                <a href="{{ route('admin.about.edit') }}" class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i> About Content
                </a>
                <a href="{{ route('admin.values.index') }}" class="nav-link {{ request()->routeIs('admin.values.*') ? 'active' : '' }}">
                    <i class="bi bi-heart"></i> Values
                </a>
                <a href="{{ route('admin.work-steps.index') }}" class="nav-link {{ request()->routeIs('admin.work-steps.*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3"></i> Work Steps
                </a>
                
                <div class="sidebar-heading">Website Content</div>
                <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Services
                </a>
                <a href="{{ route('admin.our-clients.index') }}" class="nav-link {{ request()->routeIs('admin.our-clients.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Our Clients
                </a>
                
                <div class="sidebar-heading">Inquiries</div>
                <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="bi bi-envelope"></i> Contacts
                    @if(($newContacts = \App\Models\Contact::new()->count()) > 0)
                        <span class="badge bg-danger ms-auto">{{ $newContacts }}</span>
                    @endif
                </a>
                
                <div class="sidebar-heading">Settings</div>
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="bi bi-sliders"></i> Site Settings
                </a>
                
                <hr class="mx-3 my-3 border-secondary">
                <a href="{{ route('home') }}" class="nav-link" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Site
                </a>
            @else
                {{-- Client Navigation --}}
                <a href="{{ route('client.dashboard') }}" class="nav-link {{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                
                <div class="sidebar-heading">My Account</div>
                <a href="{{ route('client.projects.index') }}" class="nav-link {{ request()->routeIs('client.projects.*') ? 'active' : '' }}">
                    <i class="bi bi-folder"></i> My Projects
                </a>
                <a href="{{ route('client.bills.index') }}" class="nav-link {{ request()->routeIs('client.bills.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt"></i> My Bills
                </a>
                
                <div class="sidebar-heading">Settings</div>
                <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Settings
                </a>
            @endif
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="top-bar">
            <div class="d-flex align-items-center gap-3">
                <!-- Mobile menu button -->
                <button class="sidebar-toggle btn btn-link text-secondary p-0" id="sidebarToggle">
                    <i class="bi bi-list fs-4"></i>
                </button>
                
                <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
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
