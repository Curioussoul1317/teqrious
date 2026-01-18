<aside class="d-none d-md-flex flex-column flex-shrink-0 bg-dark text-white" style="width: 256px; min-height: 100vh;">
    <div class="p-3 border-bottom border-secondary">
        <h1 class="h5 fw-bold d-flex align-items-center gap-2 mb-0">
            <i class="bi bi-diagram-3"></i>
            ProjectHub
        </h1>
    </div>

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