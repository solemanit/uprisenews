{{-- resources/views/layouts/backend/partials/sidebar.blade.php --}}
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    {{-- Brand --}}
    <div class="sidebar-brand">
        <a href="{{ route('backend.dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/backend/img/AdminLTELogo.png') }}" alt="{{ config('app.name') }} Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">{{ config('app.name') }}</span>
        </a>
    </div>

    {{-- Sidebar Wrapper --}}
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('backend.dashboard') }}"
                        class="nav-link {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- ── CONTENT MANAGEMENT ───────────────────────── --}}
                <li class="nav-header">CONTENT MANAGEMENT</li>

                {{-- Articles --}}
                <li class="nav-item {{ request()->routeIs('backend.articles*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('backend.articles*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-newspaper"></i>
                        <p>
                            Articles
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.articles.index') }}"
                                class="nav-link {{ request()->routeIs('backend.articles.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-ul"></i>
                                <p>All Articles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.articles.create') }}"
                                class="nav-link {{ request()->routeIs('backend.articles.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add Article</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Categories --}}
                <li class="nav-item {{ request()->routeIs('backend.categories*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('backend.categories*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tags"></i>
                        <p>
                            Categories
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.categories.index') }}"
                                class="nav-link {{ request()->routeIs('backend.categories.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-ul"></i>
                                <p>All Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.categories.create') }}"
                                class="nav-link {{ request()->routeIs('backend.categories.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Ads --}}
                <li class="nav-item {{ request()->routeIs('backend.ads*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('backend.ads*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-badge-ad"></i>
                        <p>
                            Ads
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.ads.index') }}"
                                class="nav-link {{ request()->routeIs('backend.ads.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-ul"></i>
                                <p>All Ads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.ads.create') }}"
                                class="nav-link {{ request()->routeIs('backend.ads.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add Ad</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Media --}}
                <li class="nav-item {{ request()->routeIs('backend.media*') ? 'menu-open' : '' }}">
                    <a href="{{ route('backend.media.index') }}"
                        class="nav-link {{ request()->routeIs('backend.media*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-images"></i>
                        <p>Media Library</p>
                    </a>
                </li>

                {{-- Menu --}}
                <li class="nav-item {{ request()->routeIs('backend.menus*') ? 'menu-open' : '' }}">
                    <a href="{{ route('backend.menus.index') }}"
                        class="nav-link {{ request()->routeIs('backend.menus*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-list-nested"></i>
                        <p>Menu</p>
                    </a>
                </li>

                {{-- Page Builder --}}
                <li class="nav-item {{ request()->routeIs('backend.pages*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('backend.pages*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>
                            Pages
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.pages.index') }}"
                                class="nav-link {{ request()->routeIs('backend.pages.index') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-list-ul"></i>
                                <p>All Pages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('backend.pages.create') }}"
                                class="nav-link {{ request()->routeIs('backend.pages.create') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- ── ACCOUNT ──────────────────────────────────── --}}
                <li class="nav-header">ACCOUNT</li>

                {{-- Profile --}}
                <li class="nav-item {{ request()->routeIs('backend.profile*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('backend.profile*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            Profile
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('backend.profile.edit') }}"
                                class="nav-link {{ request()->routeIs('backend.profile.edit') ? 'active' : '' }}">
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
