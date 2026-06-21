{{-- Auth Layout
src: resources/views/backend/layouts/auth.blade.php
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>@yield('title', 'Login') — {{ config('app.name') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    {{-- AdminLTE Fonts --}}
    <link rel="preload" href="{{ asset('assets/backend/css/adminlte.css') }}" as="style">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous">

    {{-- AdminLTE Core CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/backend/css/adminlte.css') }}">

    @stack('styles')
</head>

<body class="login-page bg-body-secondary">

    <div class="login-box">

        {{-- Logo --}}
        <div class="login-logo">
            <a href="{{ route('dashboard') }}">
                <b>{{ config('app.name_bold', 'Admin') }}</b>{{ config('app.name_suffix', 'Panel') }}
            </a>
        </div>

        {{-- Card --}}
        <div class="card">
            <div class="card-body login-card-body">
                @yield('content')
            </div>
        </div>

    </div>
    {{-- /.login-box --}}

    {{-- Popper.js --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

    {{-- Bootstrap 5 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    {{-- AdminLTE JS --}}
    <script src="{{ asset('assets/backend/js/adminlte.js') }}"></script>

    @stack('scripts')
</body>
</html>
