{{-- resources/views/frontend/home/partials/letest-news.blade.php --}}
<div id="latest-news" class="latest-news section panel overflow-hidden">
    <div class="section-outer panel py-5 lg:py-8">
        <div class="container max-w-xl">
            <div class="section-inner panel vstack gap-4">
                {{-- Main row: news column (left) + ads sidebar (right) --}}
                <div class="row g-4 xl:g-5">
                    {{-- ── News column ─────────────────────────────────── --}}
                    <div class="col-12 lg:col-9">
                        <div class="section-content">
                            <div data-home-section="latest-news" class="row child-cols-12 sm:child-cols-4 lg:child-cols-4 g-2 gy-4 md:g-3 md:gy-5 xl:g-4 xl:gy-6">
                                {{-- JS-rendered cards get injected here --}}
                            </div>

                            <template id="latest-news-card-template">
                                <div>
                                    <article class="post type-post panel vstack gap-1 lg:gap-2">
                                        <div class="post-media panel uc-transition-toggle overflow-hidden">
                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9">
                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                                    data-field="image"
                                                    src=""
                                                    alt=""
                                                    data-uc-img="loading: lazy">
                                            </div>
                                            <a data-field="link" href="#" class="position-cover"></a>
                                        </div>
                                        <div class="post-header panel vstack gap-1">
                                            <div
                                                class="post-meta panel hstack justify-start gap-1 fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1">
                                                <div>
                                                    <div class="post-category hstack gap-narrow fw-medium">
                                                        <a data-field="category" class="text-none text-primary dark:text-white" href="#"></a>
                                                    </div>
                                                </div>
                                                <div class="sep d-none md:d-block">❘</div>
                                                <div class="d-none md:d-block">
                                                    <div class="post-date hstack gap-narrow">
                                                        <span data-field="date"></span>
                                                    </div>
                                                </div>
                                                <div
                                                    class="cstack w-16px h-16px ms-narrow d-none md:d-inline-flex position-absolute top-0 end-0">
                                                    <a href="#" class="uc-bookmark-toggle w-16px h-16px text-none"
                                                        data-uc-tooltip="Add to bookmark"><i
                                                            class="icon-narrow unicon-bookmark-add"></i></a>
                                                </div>
                                            </div>
                                            <h3 class="post-title h6 lg:h5 m-0 text-truncate-2 mb-1">
                                                <a data-field="title" class="text-none hover:text-primary duration-150" href="#"></a>
                                            </h3>
                                        </div>
                                    </article>
                                </div>
                            </template>
                        </div>

                        <div class="section-footer cstack lg:mt-4">
                            <a href="{{ route('article') }}" class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent dark:text-white border w-100 md:w-auto">
                                <span>See all latest news</span>
                                <i class="icon icon-1 unicon-chevron-right"></i>
                            </a>
                        </div>
                    </div>

                    {{-- ── Ads sidebar (right) ─────────────────────────── --}}
                    <div class="col-12 lg:col-3">
                        @include('frontend.home.partials.ads-sidebar')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
