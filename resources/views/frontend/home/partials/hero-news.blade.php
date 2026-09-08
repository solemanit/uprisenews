{{-- src: resources/views/frontend/home/partials/hero-news.blade.php
News Limit 1 for Hero Section
--}}
<div class="section panel mt-0" data-home-section="hero">
    <div class="section-outer panel w-100">
        <div class="container-full">
            <div class="section-inner panel vstack gap-4">
                <div class="section-content">
                    <article class="post type-post panel uc-transition-toggle vstack overflow-hidden uc-dark min-h-450px lg:min-h-600px">
                        <!-- Background Image -->
                        <div class="panel overflow-hidden position-cover">
                            <img data-field="image"
                                class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                src="{{ asset('assets/frontend/images/placeholder-hero.jpg') }}"
                                alt="Featured article"
                                loading="lazy">
                        </div>

                        <!-- Gradient Overlay -->
                        <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>

                        <!-- Content -->
                        <div class="post-header panel vstack justify-end items-start gap-2 p-3 sm:p-4 lg:p-6 position-cover text-white">
                            <!-- Category Badge -->
                            <div class="hstack gap-narrow">
                                <a data-field="category" href="#"
                                    class="text-none bg-primary px-2 py-narrow rounded-1 fs-7 fw-bold text-uppercase text-white">
                                </a>
                            </div>
                            <!-- Title -->
                            <h1 class="post-title h4 lg:h3 m-0 max-w-600px text-white text-truncate-2">
                                <a data-field="link" class="text-none text-white" href="#">
                                    <span data-field="title"></span>
                                </a>
                            </h1>
                            <!-- Excerpt -->
                            <p data-field="excerpt" class="fs-6 max-w-600px d-none md:d-block text-white text-opacity-70"></p>
                            <!-- Meta -->
                            <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1 w-100 border-top border-white border-opacity-15 pt-1">
                                <div class="meta">
                                    <div class="hstack gap-2">
                                        <!-- Author -->
                                        <div class="post-author hstack gap-1">
                                            <a href="page-author.html" data-uc-tooltip="Author">
                                                <img src="{{ asset('assets/frontend/images/avatars/03.png') }}" alt="Author" class="w-24px h-24px rounded-circle">
                                            </a>
                                            <a href="page-author.html"
                                                data-field="author-name"
                                                class="text-none text-white fw-bold">
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="post-date hstack gap-narrow fs-7 text-white text-opacity-60">
                                    <span data-field="date"></span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
