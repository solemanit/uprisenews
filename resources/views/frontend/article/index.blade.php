{{-- src: views/frontend/article/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', __('Article Details') . ' — ' . config('app.name'))

@section('content')
<style>
    .post-content p {
        margin-bottom: 0;
        color: #000 !important;
    }
</style>
    <article class="post type-post single-post py-4 lg:py-6 xl:py-9"
    data-page="article-details" data-slug="{{ $slug }}">
        <div class="container max-w-xl">
            <div class="post-header">
                <div class="panel vstack gap-4 md:gap-6 xl:gap-9 text-center">
                    <div class="panel vstack items-center max-w-400px sm:max-w-500px xl:max-w-md mx-auto gap-2 md:gap-3">

                        {{-- Category + meta row --}}
                        <div class="post-meta hstack justify-center gap-2 fs-7 opacity-70">
                            <a href="#" data-field="category" class="text-uppercase fw-medium"></a>
                            <span>•</span>
                            <span data-field="date"></span>
                            <span>•</span>
                            <span>By <span data-field="author-name"></span></span>
                        </div>

                        <h1 class="h4 sm:h3 xl:h1" data-field="title"></h1>

                        {{-- Excerpt --}}
                        <p class="fs-5 opacity-70" data-field="excerpt"></p>

                        <ul class="post-share-icons nav-x mt-2 gap-1 dark:text-white">
                            <li>
                                <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    href="#"><i class="unicon-logo-facebook icon-1"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    href="#"><i class="unicon-logo-x-filled icon-1"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    href="#"><i class="unicon-logo-linkedin icon-1"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    href="#"><i class="unicon-logo-pinterest icon-1"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    href="#"><i class="unicon-email icon-1"></i></a>
                            </li>
                            <li>
                                <a class="btn btn-md p-0 border-gray-900 border-opacity-15 w-32px lg:w-48px h-32px lg:h-48px text-dark dark:text-white dark:border-white hover:bg-primary hover:border-primary hover:text-white rounded-circle"
                                    href="#"><i class="unicon-link icon-1"></i></a>
                            </li>
                        </ul>
                    </div>
                    <figure class="featured-image m-0">
                        <figure
                            class="featured-image m-0 ratio ratio-2x1 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                data-field="image"
                                src="/assets/frontend/images/placeholder-hero.jpg"
                                alt="" data-uc-img="loading: lazy">
                        </figure>
                    </figure>
                </div>
            </div>
        </div>
        <div class="panel mt-4 lg:mt-6 xl:mt-9">
            <div class="container max-w-lg">
                <div class="post-content panel fs-6 md:fs-5" data-field="body" data-uc-lightbox="animation: scale">
                    <!-- static fallback paragraphs stay as-is; JS replaces innerHTML on load -->
                </div>

                {{-- prev/next block: JS eta abhi render kore na, tai static thakle bhalo dekhabe na. --}}
                {{-- comments section same as before --}}

                <div class="post-related panel border-top pt-2 mt-8 xl:mt-9">
                    <h4 class="h5 xl:h4 mb-5 xl:mb-6">Related to this topic:</h4>
                    <div class="row child-cols-6 md:child-cols-3 gx-2 gy-4 sm:gx-3 sm:gy-6" data-field="related-list">
                        <!-- static fallback cards stay; JS replaces on load -->
                    </div>
                </div>
            </div>
        </div>
    </article>
@endsection
