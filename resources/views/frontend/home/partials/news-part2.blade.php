{{-- Swiper Section --}}
<div class="section panel overflow-hidden swiper-parent">
    <div class="section-outer panel py-4 lg:py-6 dark:text-white">
        <div class="container max-w-xl">
            <div class="section-inner panel vstack gap-2">
                <div class="block-layout carousel-layout vstack gap-2 lg:gap-3 panel">
                    <div class="block-header panel pt-1 border-top">
                        <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">Hot now</h2>
                    </div>
                    <div class="block-content panel">
                        <div class="swiper" data-uc-swiper="items: 2; gap: 16; dots: .dot-nav; next: .nav-next; prev: .nav-prev; disable-class: d-none;" data-uc-swiper-s="items: 3; gap: 24;" data-uc-swiper-l="items: 5; gap: 24;">
                            <div class="swiper-wrapper" id="hot-now-swiper"></div>
                        </div>
                        <div class="swiper-nav nav-prev position-absolute top-50 start-0 translate-middle btn btn-alt-primary text-black rounded-circle p-0 border shadow-xs w-32px lg:w-40px h-32px lg:h-40px z-1">
                            <i class="icon-1 unicon-chevron-left"></i>
                        </div>
                        <div class="swiper-nav nav-next position-absolute top-50 start-100 translate-middle btn btn-alt-primary text-black rounded-circle p-0 border shadow-xs w-32px lg:w-40px h-32px lg:h-40px z-1">
                            <i class="icon-1 unicon-chevron-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const FALLBACK_IMG2 = "{{ asset('assets/frontend/images/common/img-fallback.png') }}";

    // ─── DATA ────────────────────────────────────────────────────────────────
    const hotNowPosts = [
        {
            title: 'Hidden Gems: Underrated Travel Destinations Around the World',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-09.jpg') }}",
            date: '23d',
            comments: 15
        },
        {
            title: 'Eco-Tourism: Traveling Responsibly and Sustainably',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-10.jpg') }}",
            date: '29d',
            comments: 20
        },
        {
            title: 'Solo Travel: Some Tips and Destinations for the Adventurous Explorer',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-11.jpg') }}",
            date: '2mo',
            comments: 5
        },
        {
            title: 'AI-Powered Financial Planning: How Algorithms Revolutionizing',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-12.jpg') }}",
            date: '2mo',
            comments: 2
        },
        {
            title: 'Tech Tools for your Time Management: Enhancing Productivity',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-13.jpg') }}",
            date: '3mo',
            comments: 19
        },
        {
            title: 'A Guide to The Rise of Gourmet Street Food: Trends and Top Picks',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-14.jpg') }}",
            date: '6mo',
            comments: 2
        },
        {
            title: 'Gaming in the Age of AI: Strategies for Startups',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-15.jpg') }}",
            date: '9mo',
            comments: 19
        },
        {
            title: 'Top Independent Contractors to Invest in Best of Startups',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-16.jpg') }}",
            date: '1yr',
            comments: 12
        },
    ];

    // ─── TEMPLATE ────────────────────────────────────────────────────────────
    function swiperSlideHTML(post) {
        return `
        <div class="swiper-slide">
            <div>
                <article class="post type-post panel uc-transition-toggle vstack gap-2">
                    <div class="post-media panel overflow-hidden">
                        <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                 src="${FALLBACK_IMG2}"
                                 data-src="${post.image}"
                                 alt="${post.title}"
                                 data-uc-img="loading: lazy">
                        </div>
                        <a href="${post.slug}" class="position-cover"></a>
                    </div>
                    <div class="post-header panel vstack gap-1">
                        <h3 class="post-title h6 m-0 text-truncate-2">
                            <a class="text-none hover:text-primary duration-150" href="${post.slug}">${post.title}</a>
                        </h3>
                        <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                            <div>
                                <div class="post-date hstack gap-narrow">
                                    <span>${post.date}</span>
                                </div>
                            </div>
                            <div>·</div>
                            <div>
                                <a href="{{ route("article") }}post_comment" class="post-comments text-none hstack gap-narrow">
                                    <i class="icon-narrow unicon-chat"></i>
                                    <span>${post.comments}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>`;
    }

    // ─── RENDER ──────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('hot-now-swiper').innerHTML = hotNowPosts.map(swiperSlideHTML).join('');
    });
</script>
