<aside class="d-none d-md-flex flex-column flex-shrink-0 bg-dark text-white" style="width: 256px; min-height: 100vh;">
    <div class="p-3 border-bottom border-secondary">
    <h4>TEQ<span>RIOUS</span></h4>
    <small class="text-white-50">ProjectHub</small>
        
    </div>
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
    <nav class="flex-grow-1 mt-3">
        @if(auth()->user()->isAdmin())
            {{-- Admin Navigation --}}
            <div class="px-3 py-2 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                Main
            </div>
            <a href="{{ route('admin.dashboard') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('admin.dashboard') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('admin.dashboard') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-speedometer2 me-3" style="width: 20px;"></i>
                Dashboard
            </a>

            <div class="px-3 py-2 mt-3 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                Management
            </div>
            <a href="{{ route('admin.clients.index') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('admin.clients.*') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('admin.clients.*') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-people me-3" style="width: 20px;"></i>
                Clients
            </a>
            <a href="{{ route('admin.projects.index') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('admin.projects.*') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('admin.projects.*') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-folder me-3" style="width: 20px;"></i>
                Projects
            </a>
            <a href="{{ route('admin.bills.index') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('admin.bills.*') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('admin.bills.*') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-receipt me-3" style="width: 20px;"></i>
                Bills
            </a>

        @else
            {{-- Client Navigation --}}
            <div class="px-3 py-2 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                Main
            </div>
            <a href="{{ route('client.dashboard') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('client.dashboard') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('client.dashboard') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-speedometer2 me-3" style="width: 20px;"></i>
                Dashboard
            </a>

            <div class="px-3 py-2 mt-3 text-uppercase small fw-semibold text-secondary" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                My Account
            </div>
            <a href="{{ route('client.projects.index') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('client.projects.*') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('client.projects.*') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-folder me-3" style="width: 20px;"></i>
                My Projects
            </a>
            <a href="{{ route('client.bills.index') }}" 
               class="nav-link d-flex align-items-center px-3 py-3 text-light text-decoration-none {{ request()->routeIs('client.bills.*') ? 'bg-secondary bg-opacity-50 border-start border-4 border-primary' : '' }}"
               style="{{ !request()->routeIs('client.bills.*') ? 'border-left: 4px solid transparent;' : '' }}">
                <i class="bi bi-receipt me-3" style="width: 20px;"></i>
                My Bills
            </a>
        @endif
    </nav>

    <div class="p-3 border-top border-secondary mt-auto">
        <a href="{{ route('profile') }}" 
           class="nav-link d-flex align-items-center px-3 py-2 text-light text-decoration-none rounded">
            <i class="bi bi-gear me-3" style="width: 20px;"></i>
            Settings
        </a>
    </div>
</aside>

<style>
    aside .nav-link:hover {
        background-color: rgba(108, 117, 125, 0.3) !important;
    }
</style>