{{-- Live Now Section --}}
<div id="live_now" class="live_now section panel uc-dark swiper-parent">
    <div class="section-outer panel py-4 lg:py-6 bg-gray-900 text-white">
        <div class="container max-w-xl">
            <div class="block-layout slider-thumbs-layout slider-thumbs panel vstack gap-2 lg:gap-3 panel overflow-hidden">
                <div class="block-header panel">
                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase hstack gap-narrow m-0 text-black dark:text-white">
                        <i class="icon-1 fw-bold unicon-dot-mark text-red" data-uc-animate="flash"></i>
                        <span>Live now</span>
                    </h2>
                </div>
                <div class="block-content">
                    <div class="row child-cols-12 g-2" data-uc-grid>

                        {{-- Main Swiper --}}
                        <div class="md:col-8 lg:col-9">
                            <div class="panel overflow-hidden rounded">
                                <div class="swiper swiper-main"
                                     data-uc-swiper="connect: .swiper-thumbs; items: 1; gap: 8; autoplay: 7000; parallax: true; fade: true; effect: fade; dots: .swiper-pagination; disable-class: last-slide;">
                                    <div class="swiper-wrapper" id="live-now-main"></div>
                                    <div class="swiper-pagination top-auto start-auto bottom-0 end-0 m-2 md:m-4 xl:m-6 text-white d-none md:d-inline-flex justify-end w-auto"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Thumbs Swiper --}}
                        <div class="md:col-4 lg:col-3">
                            <div class="panel md:vstack gap-1 h-100">
                                <div class="swiper swiper-thumbs swiper-thumbs-progress rounded order-2"
                                     data-uc-swiper="items: 2; gap: 4; disable-class: last-slide;"
                                     data-uc-swiper-s="items: auto; direction: vertical; autoHeight: true; mousewheel: true; freeMode: false; watchSlidesVisibility: true; watchSlidesProgress: true; watchOverflow: true">
                                    <div class="swiper-wrapper md:flex-1" id="live-now-thumbs"></div>
                                </div>
                                <div class="swiper-prev btn btn-2xs lg:btn-xs btn-dark w-100 d-none md:d-flex order-1">Prev</div>
                                <div class="swiper-next btn btn-2xs lg:btn-xs btn-dark w-100 d-none md:d-flex order-3">Next</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const FALLBACK_IMG4 = "{{ asset('assets/frontend/images/common/img-fallback.png') }}";

    // ─── DATA ────────────────────────────────────────────────────────────────
    const liveNowPosts = [
        {
            title: 'Balancing Work and Wellness: Tech Solutions for Healthy',
            slug: '{{ route("article") }}',
            video: "{{ asset('assets/frontend/videos/vid-01.webm') }}",
            date: '1h ago',
            comments: 0,
            author: {
                name: 'Sarah Eddrissi',
                slug: 'page-author.html',
                avatar: "{{ asset('assets/frontend/images/avatars/03.png') }}"
            }
        },
        {
            title: 'Business Agility the Digital Age: Leveraging AI and Automation',
            slug: '{{ route("article") }}',
            video: "{{ asset('assets/frontend/videos/vid-03.webm') }}",
            date: '7d ago',
            comments: 23,
            author: {
                name: 'Nisi Nyung',
                slug: 'page-author.html',
                avatar: "{{ asset('assets/frontend/images/avatars/08.png') }}"
            }
        },
        {
            title: 'The Art of Baking: From Classic Bread to Artisan Pastries',
            slug: '{{ route("article") }}',
            video: "{{ asset('assets/frontend/videos/vid-04.webm') }}",
            date: '9d ago',
            comments: 112,
            author: {
                name: 'Nisi Nyung',
                slug: 'page-author.html',
                avatar: "{{ asset('assets/frontend/images/avatars/08.png') }}"
            }
        },
        {
            title: 'AI-Powered Financial Planning: How Algorithms Revolutionizing',
            slug: '{{ route("article") }}',
            video: "{{ asset('assets/frontend/videos/vid-05.webm') }}",
            date: '2mo ago',
            comments: 2,
            author: {
                name: 'Sarah Eddrissi',
                slug: 'page-author.html',
                avatar: "{{ asset('assets/frontend/images/avatars/03.png') }}"
            }
        },
    ];

    // ─── TEMPLATES ───────────────────────────────────────────────────────────

    function mainSlideHTML(post) {
        return `
        <div class="swiper-slide">
            <article class="post type-post h-250px md:h-350px lg:h-500px bg-black uc-dark">
                <div class="post-media panel overflow-hidden position-cover">
                    <div class="featured-video bg-gray-700 ratio ratio-3x2">
                        <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                            <source src="${FALLBACK_IMG4}" data-src="${post.video}" type="video/webm">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="position-cover bg-gradient-to-t from-black to-transparent z-1 opacity-80"></div>
                <div class="post-header panel position-absolute bottom-0 vstack justify-between gap-2 xl:gap-4 max-300px lg:max-w-600px p-2 md:p-4 xl:p-6 z-1">
                    <h3 class="post-title h4 lg:h3 xl:h2 m-0 text-truncate-2" data-swiper-parallax-x="-8">
                        <a class="text-none" href="${post.slug}">${post.title}</a>
                    </h3>
                    <div data-swiper-parallax-x="8">
                        <div class="post-meta panel hstack justify-between fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                            <div class="meta">
                                <div class="hstack gap-2">
                                    <div class="post-author hstack gap-1">
                                        <a href="${post.author.slug}" data-uc-tooltip="${post.author.name}">
                                            <img src="${post.author.avatar}" alt="${post.author.name}" class="w-24px h-24px rounded-circle">
                                        </a>
                                        <a href="${post.author.slug}" class="text-black dark:text-white text-none fw-bold">${post.author.name}</a>
                                    </div>
                                    <div>
                                        <div class="post-date hstack gap-narrow">
                                            <span>${post.date}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route("article") }}post_comment" class="post-comments text-none hstack gap-narrow">
                                            <i class="icon-narrow unicon-chat"></i>
                                            <span>${post.comments}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="actions"><div class="hstack gap-1"></div></div>
                        </div>
                    </div>
                </div>
            </article>
        </div>`;
    }

    function thumbSlideHTML(post) {
        return `
        <div class="swiper-slide overflow-hidden rounded min-h-64px lg:min-h-100px">
            <div class="swiper-slide-progress position-cover z-0"><span></span></div>
            <article class="post type-post panel uc-transition-toggle p-1 z-1">
                <div class="row gx-1">
                    <div class="col-auto post-media-wrap">
                        <div class="post-media panel overflow-hidden w-40px lg:w-64px rounded">
                            <div class="featured-video bg-gray-700 ratio ratio-3x4">
                                <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                    <source src="${FALLBACK_IMG4}" data-src="${post.video}" type="video/webm">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="has-video-overlay position-absolute top-0 end-0 w-40px h-40px lg:w-64px lg:h-64px bg-gradient-45 from-transparent via-transparent to-black opacity-50"></div>
                            <span class="cstack has-video-icon position-absolute top-50 start-50 translate-middle fs-6 w-40px h-40px text-white">
                                <i class="icon-narrow unicon-play-filled-alt"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col">
                        <p class="fs-6 m-0 text-truncate-2 text-gray-900 dark:text-white">${post.title}</p>
                    </div>
                </div>
            </article>
        </div>`;
    }

    // ─── RENDER ──────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('live-now-main').innerHTML   = liveNowPosts.map(mainSlideHTML).join('');
        document.getElementById('live-now-thumbs').innerHTML = liveNowPosts.map(thumbSlideHTML).join('');
    });
</script>
