{{-- resources/views/layouts/backend/partials/sidebar.blade.php --}}
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    {{-- Brand --}}
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/backend/img/AdminLTELogo.png') }}"
                alt="{{ config('app.name') }} Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">{{ config('app.name') }}</span>
        </a>
    </div>

    {{-- Sidebar Wrapper --}}
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ── RECORDS ──────────────────────────────────── --}}
                <li class="nav-header">RECORDS</li>

                {{-- Employee Records --}}
                <li class="nav-item {{ request()->routeIs('employee-records*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('employee-records*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-badge"></i>
                        <p>
                            Employee Records
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="{{ route('employee-records.index') }}"
                                class="nav-link {{ request()->routeIs('employee-records.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-ul"></i>
                                <p>All Records</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee-records.create') }}"
                                class="nav-link {{ request()->routeIs('employee-records.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add New Record</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- ── ACCOUNT ──────────────────────────────────── --}}
                <li class="nav-header">ACCOUNT</li>

                {{-- Profile --}}
                <li class="nav-item {{ request()->routeIs('profile*') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ request()->routeIs('profile*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            Profile
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}"
                                class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Edit Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
