{{-- resources/views/layouts/backend/partials/header.blade.php --}}
<nav class="app-header navbar navbar-expand bg-body" id="navigation" tabindex="-1">
    <div class="container-fluid">

        {{-- Start: Sidebar toggle --}}
        <ul class="navbar-nav" role="navigation" aria-label="Navigation 1">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        {{-- End: Sidebar toggle --}}

        {{-- End: Right-side navbar items --}}
        <ul class="navbar-nav ms-auto" role="navigation" aria-label="Navigation 2">

            {{-- Notifications Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-item dropdown-header">4 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-envelope me-2"></i>
                        4 new messages
                        <span class="float-end text-secondary fs-7">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>

            {{-- User Menu Dropdown --}}
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/backend/img/user2-160x160.jpg') }}"
                        class="user-image rounded-circle shadow"
                        alt="{{ auth()->user()->name ?? 'User' }}">
                    <span class="d-none d-md-inline">
                        {{ auth()->user()->name ?? 'Guest' }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    {{-- User image header --}}
                    <li class="user-header text-bg-primary">
                        <img src="{{ asset('assets/backend/img/user2-160x160.jpg') }}"
                            class="rounded-circle shadow"
                            alt="{{ auth()->user()->name ?? 'User' }}">
                        <p>
                            {{ auth()->user()->name ?? 'Guest' }}
                            <small>Member since {{ auth()->user()?->created_at?->format('M Y') ?? now()->format('M Y') }}</small>
                        </p>
                    </li>

                    {{-- Menu Footer --}}
                    <li class="user-footer">
                        <a href="#" class="btn btn-outline-secondary">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline float-end">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger">
                                Sign out
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        {{-- End: Right-side navbar items --}}

    </div>
</nav>
