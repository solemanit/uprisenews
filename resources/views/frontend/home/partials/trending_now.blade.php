{{-- resources/views/frontend/home/partials/trending_now.blade.php --}}
<div class="order-2 sm:order-1 uc-first-column">
    <div class="list-layout panel p-2 pb-3 sm:p-2 mt-2 sm:mt-0 bg-white dark:bg-gray-900">
        <div class="list-header panel mb-2 hstack justify-between ga-2">
            <h2 class="list-title h5 m-0 hstack gap-1">
                <i class="icon icon-narrow unicon-flash-filled text-primary"></i>
                <span>Trending <span class="text-primary">now</span></span>
            </h2>
        </div>
        <div class="list-content panel overflow-auto h-400px sm:h-700px lg:h-600px xl:h-550px">
            <div data-home-section="trending-now" class="row sep-x gy-2 gx-4 me-1 uc-grid uc-grid-stack" data-uc-grid="">
                {{-- JS-rendered trending cards get injected here --}}
            </div>

            <template id="trending-now-card-template">
                <div class="uc-grid-margin uc-first-column">
                    <article class="post type-post panel vstack pb-narrow text-gray-900 dark:text-white">
                        <div>
                            <span data-field="time" class="time fs-7 opacity-60"></span>
                        </div>
                        <h6 class="fs-5 text-truncate-2">
                            <a data-field="link" class="text-none hover:text-primary duration-150" href="#">
                                <span data-field="title"></span>
                            </a>
                        </h6>
                    </article>
                </div>
            </template>
        </div>
    </div>
</div>
