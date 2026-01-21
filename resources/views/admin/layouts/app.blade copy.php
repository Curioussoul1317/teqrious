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
        :root { --primary: #001348; --secondary: #aa134a; --third: #cb9430; --sidebar-width: 260px; }
        body { background: #f4f6f9; }
        .sidebar { position: fixed; top: 0; left: 0; width: var(--sidebar-width); height: 100vh; background: var(--primary); overflow-y: auto; z-index: 1000; }
        .sidebar-brand { padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand h4 { color: #fff; margin: 0; font-weight: 800; }
        .sidebar-brand span { color: var(--third); }
        .sidebar-nav { padding: 1rem 0; }
        .sidebar-nav .nav-link { color: rgba(255,255,255,0.7); padding: 0.75rem 1.5rem; display: flex; align-items: center; gap: 10px; transition: all 0.2s; }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); }
        .sidebar-nav .nav-link i { width: 20px; }
        .sidebar-heading { color: rgba(255,255,255,0.4); font-size: 0.75rem; text-transform: uppercase; padding: 1rem 1.5rem 0.5rem; letter-spacing: 1px; }
        .main-content { margin-left: var(--sidebar-width); padding: 2rem; min-height: 100vh; }
        .top-bar { background: #fff; padding: 1rem 1.5rem; margin: -2rem -2rem 2rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .card { border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-radius: 10px; }
        .card-header { background: #fff; border-bottom: 1px solid #eee; font-weight: 600; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--secondary); border-color: var(--secondary); }
        .thumb-img { width: 60px; height: 40px; object-fit: cover; border-radius: 5px; }
        .badge.status-new { background: var(--third); }
        .badge.status-read, .badge.status-reviewed { background: #17a2b8; }
        .badge.status-replied, .badge.status-quoted { background: #28a745; }
        .badge.status-closed, .badge.status-rejected { background: #6c757d; }
        .badge.status-accepted { background: var(--secondary); }
        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.3s; }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <h4>TEQ<span>RIOUS</span></h4>
            <small class="text-white-50">Admin Panel</small>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            
            <div class="sidebar-heading">Home Page</div>
            <a href="{{ route('admin.hero-slides.index') }}" class="nav-link {{ request()->routeIs('admin.hero-slides.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Hero Slides
            </a>
            <a href="{{ route('admin.highlight-cards.index') }}" class="nav-link {{ request()->routeIs('admin.highlight-cards.*') ? 'active' : '' }}">
                <i class="bi bi-card-heading"></i> Highlight Cards
            </a>
            <a href="{{ route('admin.service-tiles.index') }}" class="nav-link {{ request()->routeIs('admin.service-tiles.*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3"></i> Service Tiles
            </a>
            <a href="{{ route('admin.featured-works.index') }}" class="nav-link {{ request()->routeIs('admin.featured-works.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i> Projects
            </a>
            <a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.index.*') ? 'active' : '' }}">
                <i class="bi bi-briefcase"></i> Clients
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
            
            <div class="sidebar-heading">Services</div>
            <a href="{{ route('admin.expertise.index') }}" class="nav-link {{ request()->routeIs('admin.expertise.*') ? 'active' : '' }}">
                <i class="bi bi-lightbulb"></i> Expertise
            </a>
            <a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Services
            </a>
            
            <div class="sidebar-heading">Subsidiaries</div>
            <a href="{{ route('admin.subsidiaries.index') }}" class="nav-link {{ request()->routeIs('admin.subsidiaries.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Subsidiaries
            </a>
            
            <div class="sidebar-heading">Inquiries</div>
            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i> Contacts
                @if(($newContacts = \App\Models\Contact::new()->count()) > 0)
                    <span class="badge bg-danger ms-auto">{{ $newContacts }}</span>
                @endif
            </a>
            <a href="{{ route('admin.subsidiary-quotes.index') }}" class="nav-link {{ request()->routeIs('admin.subsidiary-quotes.*') ? 'active' : '' }}">
                <i class="bi bi-receipt"></i> Quotes
                @if(($newQuotes = \App\Models\SubsidiaryQuote::new()->count()) > 0)
                    <span class="badge bg-danger ms-auto">{{ $newQuotes }}</span>
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
            <form method="POST" action="{{ route('logout') }}" class="px-3">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100 mt-2">
                    <i class="bi bi-box-arrow-left me-1"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="main-content">
        <div class="top-bar">
            <h5 class="mb-0">@yield('page-title', 'Dashboard')</h5>
            <span class="text-muted">{{ Auth::user()->name ?? 'Admin' }}</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
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
    @stack('scripts')
</body>
</html>
