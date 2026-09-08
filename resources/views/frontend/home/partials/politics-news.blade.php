{{-- resources/views/frontend/home/partials/politics-news.blade.php --}}
<div class="section panel overflow-hidden-x">
    <div class="section-outer panel pt-4 md:pt-6 lg:pt-8 xl:pt-9">
        <div class="container max-w-2xl p-0 sm:px-2 lg:px-4 xl:px-0">
            <div class="section-inner panel vstack gap-0 sm:gap-2 xl:gap-3">
                <div class="section-header panel vstack items-center justify-center text-center gap-1">
                    <h2 class="h4 xl:h3 -ls-1 xl:-ls-2 m-0 text-inherit hstack gap-1">
                        <span class="panel d-inline-block bg-primary w-8px h-8px translate-y-px"></span>
                        <span class="text-black">Politics</span>
                    </h2>
                </div>

                {{-- Two-column row: politics news (left) + trending sidebar (right) --}}
                <div class="row g-4 xl:g-5">
                    {{-- ── Politics news column ─────────────────────────── --}}
                    <div class="col-12 lg:col-9">
                        <div data-home-section="politics-news"
                             class="row child-cols-12 sm:child-cols-6 lg:child-cols-4 xl:child-cols-3 g-0 sm:g-2 xl:g-3 col-match uc-grid" data-uc-grid="">
                            {{-- JS-rendered politics cards get injected here --}}
                        </div>

                        <template id="politics-news-card-template">
                            <div class="order-1 sm:order-1">
                                <article class="post type-post panel hstack sm:vstack items-start gap-2 sm:gap-0 p-2 sm:p-0 overflow-hidden text-gray-900 dark:text-white bg-white dark:bg-gray-900">
                                    <div class="post-media panel overflow-hidden w-200px sm:w-100 order-1 sm:order-0">
                                        <figure class="featured-image m-0 ratio ratio-3x2 sm:ratio-16x9 uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque" data-field="image" src="" alt="" data-uc-img="loading: lazy">
                                            <a data-field="link" href="#" class="position-cover"></a>
                                        </figure>
                                    </div>
                                    <div class="post-header panel vstack justify-between gap-1 sm:gap-2 p-0 sm:p-2 mt-narrow sm:mt-0 w-100">
                                        <div class="post-top panel vstack items-start gap-2">
                                            <div class="post-meta panel fs-7 px-narrow border border-gray-200 dark:border-gray-700 d-none sm:d-block">
                                                <div class="post-category hstack gap-narrow fw-semibold">
                                                    <a data-field="category" class="text-none duration-150 transition-color hover:text-primary dark:text-primary" href="#"></a>
                                                </div>
                                            </div>
                                            <h3 class="post-title h6 sm:h5 m-0 text-truncate-2">
                                                <a data-field="title" class="text-none" href="#"></a>
                                            </h3>
                                        </div>
                                        <div class="post-bottom panel hstack gap-2 fs-7 mt-narrow sm:mt-0 text-black dark:text-white text-opacity-60">
                                            <div>
                                                <div class="post-date hstack gap-narrow">
                                                    <i class="icon-narrow unicon-time"></i>
                                                    <span data-field="date"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </template>
                    </div>

                    {{-- ── Trending sidebar (right) ────────────────────────── --}}
                    <div class="col-12 lg:col-3">
                        @include('frontend.home.partials.trending_now')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
