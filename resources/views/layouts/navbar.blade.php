<header class="bg-white shadow-sm border-bottom px-4 py-3">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <!-- Mobile menu button -->
            <button class="d-md-none btn btn-link text-secondary p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
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
                <button class="btn btn-link text-decoration-none d-flex align-items-center gap-2 p-2 rounded dropdown-toggle-no-caret" 
                        type="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-semibold" 
                         style="width: 32px; height: 32px;">
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

<style>
    .dropdown-toggle-no-caret::after {
        display: none;
    }
    .dropdown-toggle-no-caret:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
</style>