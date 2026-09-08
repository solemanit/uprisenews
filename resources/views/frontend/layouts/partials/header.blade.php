{{-- src: resources/views/frontend/layouts/partials/header.blade.php --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    {{-- Preload Styles --}}
    <link rel="preload" href="{{ asset('assets/frontend/css/unicons.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('assets/frontend/css/swiper-bundle.min.css') }}" as="style">

    {{-- Preload Scripts --}}
    <link rel="preload" href="{{ asset('assets/frontend/js/libs/jquery.min.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/libs/scrollmagic.min.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/libs/swiper-bundle.min.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/libs/anime.min.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/helpers/data-attr-helper.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/helpers/swiper-helper.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/helpers/anime-helper.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/helpers/anime-helper-defined-timelines.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/uikit-components-bs.js') }}" as="script">
    <link rel="preload" href="{{ asset('assets/frontend/js/app.js') }}" as="script">

    {{-- Bootstrap Core (head) --}}
    <script src="{{ asset('assets/frontend/js/app-head-bs.js') }}"></script>

    {{-- Uni-Core --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/js/uni-core/css/uni-core.min.css') }}">
    <script src="{{ asset('assets/frontend/js/uni-core/js/uni-core-bundle.min.js') }}"></script>

    {{-- Vendor Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/unicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/prettify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/swiper-bundle.min.css') }}">

    {{-- Theme --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/theme/demo-seven.min.css') }}">

    {{-- Page-level extra styles --}}
    @stack('styles')
</head>
