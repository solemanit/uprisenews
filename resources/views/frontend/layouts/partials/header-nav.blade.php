{{-- src: resources/views/frontend/layouts/partials/header-nav.blade.php --}}
<header class="uc-header header-seven uc-navbar-sticky-wrap z-999">
    <nav class="uc-navbar-container text-gray-900 dark:text-white fs-6 z-1">
        <div class="uc-bottom-navbar panel z-1">
            <div class="container max-w-xl">
                <div class="uc-navbar min-h-72px lg:min-h-100px" data-uc-navbar="animation: uc-animation-slide-top-small; duration: 150;">
                    <div class="uc-navbar-left">
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="btn btn-xs gap-narrow ps-1 border rounded-pill fw-bold dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900" href="#live_now" data-uc-scroll="offset: 128">
                                <i class="icon icon-narrow unicon-dot-mark text-red" data-uc-animate="flash"></i>
                                <span>Live</span>
                            </a>
                        </div>
                        <div class="uc-logo d-block md:d-none">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/frontend/images/logo-b.svg') }}" style="width: 140px;height: 50px;display: block;margin: 0 auto;"/>
                            </a>
                        </div>
                    </div>

                    {{-- ✅ Header main navigation menu (was missing) --}}
                    <nav class="uc-navbar-nav d-none lg:d-inline-flex">
                        <div data-menu-location="header"
                             data-menu-class="nav-x gap-3 lg:gap-4 fw-medium"></div>
                    </nav>

                    <div class="uc-navbar-center">
                        <div class="uc-logo d-none md:d-block">
                            <a href="{{ route('home') }}">
                                <img style="width: 140px;height: 50px;display: block;margin: 0 auto;" src="{{ asset('assets/frontend/images/logo-b.svg') }}">
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-right gap-2 lg:gap-3">
                        <div class="uc-navbar-item d-inline-flex lg:d-none">
                            <a class="btn btn-xs gap-narrow ps-1 border rounded-pill fw-bold dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900" href="#live_now" data-uc-scroll="offset: 128">
                                <i class="icon icon-narrow unicon-dot-mark text-red" data-uc-animate="flash"></i>
                                <span>Live</span>
                            </a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="uc-account-trigger position-relative btn btn-sm border-0 p-0 gap-narrow duration-0 dark:text-white" href="#uc-account-modal" data-uc-toggle>
                                <i class="icon icon-2 fw-medium unicon-user-avatar"></i>
                            </a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="uc-search-trigger cstack text-none text-dark dark:text-white" href="#uc-search-modal" data-uc-toggle>
                                <i class="icon icon-2 fw-medium unicon-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
