{{-- src: views/frontend/category/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', __('Category') . ' — ' . config('app.name'))

@section('content')
<div class="section py-3 sm:py-6 lg:py-9">
    <div class="container max-w-xl">
        <div class="panel vstack gap-3 sm:gap-6 lg:gap-9">
            <header class="page-header vstack justify-center items-center text-center max-w-500px mx-auto">
                <h1 class="h4 lg:h1" id="category-title">{{ __('Category') }}</h1>
            </header>
            <div class="row g-4 xl:g-8">
                <div class="col">
                    <div class="panel text-center">
                        <div id="category-articles-root" data-category-slug="{{ $slug }}">
                            <div class="row child-cols-12 sm:child-cols-6 lg:child-cols-4 xl:child-cols-3 col-match gy-4 xl:gy-6 gx-2 sm:gx-4"
                                 id="category-articles-list">
                                {{-- category-articles-loader.js injects article cards here --}}
                            </div>

                            <div id="category-articles-empty" class="py-6 text-center d-none">
                                <p>{{ __('No articles found in this category.') }}</p>
                            </div>

                            <div class="nav-pagination pt-3 mt-6 lg:mt-9 border-top border-gray-100 dark:border-gray-800"
                                 id="category-articles-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
