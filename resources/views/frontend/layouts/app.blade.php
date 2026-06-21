<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

    @include('frontend.layouts.partials.header')

    <body class="uni-body panel bg-white text-gray-900 dark:bg-black dark:text-white text-opacity-50 overflow-x-hidden">
        <!--  Search modal -->
        @include('frontend.layouts.partials.search')

        <!--  Menu panel -->
        @include('frontend.layouts.partials.menupanel')

        <!--  Account modal -->
        @include('frontend.layouts.partials.account')


        <!-- Header start -->
        @include('frontend.layouts.partials.header-nav')
        <!-- Header end -->

        <!-- Wrapper start -->
        <div id="wrapper" class="wrap overflow-hidden-x">

        @include('frontend.layouts.partials.navbar')

            {{-- ── Page Content ──────────────────────────────── --}}
            <main>
                @yield('content')
            </main>
        </div>


        {{-- ── Footer ─────────────────────────────────────── --}}
        @include('frontend.layouts.partials.footer')

    </body>
</html>
