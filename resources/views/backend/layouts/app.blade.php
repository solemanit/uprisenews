{{-- App Layout
src: resources/views/backend/layouts/app.blade.php
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield('title', config('app.name')) | {{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous">

    {{-- OverlayScrollbars --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">

    {{-- AdminLTE CSS (from public/assets/css/) --}}
    <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.css') }}">

    {{-- Page-specific styles --}}
    @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    {{-- App Wrapper --}}
    <div class="app-wrapper">

        {{-- Header --}}
        @include('backend.layouts.partials.header')

        {{-- Sidebar --}}
        @include('backend.layouts.partials.sidebar')

        {{-- Main Content --}}
        <main class="app-main" id="main" tabindex="-1">

            {{-- Page Content Header / Breadcrumb --}}
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('page_title', 'Dashboard')</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}">Home</a>
                                </li>
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Page Content --}}
            <div class="app-content">
                <div class="container-fluid">

                    {{-- Flash Messages --}}
                    @include('backend.layouts.partials.alerts')

                    {{-- Main Slot --}}
                    @yield('content')

                </div>
            </div>

        </main>

        {{-- Footer --}}
        @include('backend.layouts.partials.footer')

        <div class="sidebar-overlay"></div>
    </div>
    {{-- End App Wrapper --}}

    {{-- Scripts --}}
    {{-- OverlayScrollbars --}}
    <script
        src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    {{-- Popper.js --}}
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

    {{-- Bootstrap 5 --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- AdminLTE JS (from public/assets/js/) --}}
    <script src="{{ asset('assets/backend/js/adminlte.js') }}"></script>

    {{-- Page-specific scripts --}}
    @stack('scripts')
</body>

</html>
