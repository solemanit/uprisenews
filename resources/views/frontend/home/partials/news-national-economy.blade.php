{{-- src: resources/views/frontend/home/partials/news-national-economy.blade.php --}}
<div class="national-posts section panel overflow-hidden">
    <div class="section-outer panel pb-4 sm:pb-5">
        <div class="container max-w-xl">
            <div class="section-inner">
                <div class="row child-cols-12 lg:child-cols g-4 uc-grid uc-grid-stack" data-uc-grid="">

                    <!-- National -->
                    <div class="uc-first-column">
                        <div class="block-layout grid-layout vstack gap-2 xl:gap-3 panel overflow-hidden"
                            data-home-section="national">
                            <div class="block-header panel border-bottom pb-1 min-h-40px">
                                <h2 class="h6 lg:h5 m-0 text-inherit dark:text-white hstack gap-1">
                                    <span class="panel d-inline-block bg-primary w-8px h-8px translate-y-px"></span>
                                    <a class="post-title text-none hover:text-primary duration-150"
                                        href="/category/national">National</a>
                                </h2>
                            </div>
                            <div class="block-content panel vstack lg:hstack items-start gap-3">
                                <div class="block-left w-100 lg:w-3/4">
                                    <div data-field="main"></div>
                                </div>
                                <div class="block-right panel vstack gap-3" data-field="list"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Economy -->
                    <div class="lg:col-4">
                        <div class="block-layout grid-layout vstack gap-2 xl:gap-3 panel overflow-hidden"
                            data-home-section="economy">
                            <div class="block-header panel border-bottom pb-1 min-h-40px">
                                <h2 class="h6 lg:h5 m-0 text-inherit dark:text-white hstack gap-1">
                                    <span class="panel d-inline-block bg-primary w-8px h-8px translate-y-px"></span>
                                    <a class="post-title text-none hover:text-primary duration-150"
                                        href="/category/economy">Economy</a>
                                </h2>
                            </div>
                            <div class="block-content panel vstack gap-3">
                                <div data-field="main"></div>
                                <div data-field="list"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
