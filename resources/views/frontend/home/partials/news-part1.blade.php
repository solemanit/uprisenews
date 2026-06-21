<div class="section panel overflow-hidden">
    <div class="section-outer panel">
        <div class="container max-w-xl">
            <div class="section-inner">
                <div class="row child-cols-12 lg:child-cols g-4 lg:g-6 col-match" data-uc-grid>

                    <!-- LEFT: Politics col-8 -->
                    <div class="lg:col-8">
                        <div class="block-layout grid-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                            <div class="block-header panel pt-1 border-top">
                                <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                    <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                        <span>Politics</span>
                                        <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                    </a>
                                </h2>
                            </div>
                            <div class="block-content">
                                <div class="panel row child-cols-12 md:child-cols g-2 lg:g-4 col-match sep-y" data-uc-grid>
                                    <!-- Featured post -->
                                    <div class="col-12 md:col-6 order-0 md:order-1" id="politics-featured"></div>
                                    <!-- List posts -->
                                    <div class="order-1 md:order-0">
                                        <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid id="politics-list"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Media col-4 -->
                    <div class="lg:col-4">
                        <div class="block-layout grid-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                            <div class="block-header panel pt-1 border-top">
                                <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                    <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                        <span>Media</span>
                                        <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                    </a>
                                </h2>
                            </div>
                            <div class="block-content">
                                <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid id="media-list"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const FALLBACK_IMG1 = "{{ asset('assets/frontend/images/common/img-fallback.png') }}";

    // ─── DATA ────────────────────────────────────────────────────────────────
    const politicsPosts = [
        {
            title: 'The Importance of Sleep: Tips for Better Rest and Recovery',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-04.jpg') }}",
            date: '2h',
            author: {
                name: 'Sarah Eddrissi',
                slug: 'page-author.html',
                avatar: "{{ asset('assets/frontend/images/avatars/03.png') }}"
            },
            comments: 0
        },
        {
            title: 'The Future of Sustainable Living: Driving Eco-Friendly Lifestyles',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-05.jpg') }}",
            date: '12h'
        },
        {
            title: 'Eco-Tourism: Traveling Responsibly and Sustainably',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-10.jpg') }}",
            date: '29d'
        },
        {
            title: 'Tech Tools for your Time Management: Enhancing Productivity',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-13.jpg') }}",
            date: '3mo'
        },
        {
            title: 'Potential of Immersive Technologies help your Business Grow',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-17.jpg') }}",
            date: '1yr'
        }
    ];

    const mediaPosts = [
        {
            title: 'Solo Travel: Some Tips and Destinations for the Adventurous Explorer',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-11.jpg') }}",
            date: '2mo'
        },
        {
            title: 'Gaming in the Age of AI: Strategies for Startups',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-15.jpg') }}",
            date: '9mo'
        },
        {
            title: 'Virtual Reality and Mental Health: Exploring the Therapeutic',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-18.jpg') }}",
            date: '2mo'
        },
        {
            title: 'Smart Homes, Smarter Living: Exploring IoT and AI',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-20.jpg') }}",
            date: '23d'
        }
    ];

    // ─── TEMPLATES ───────────────────────────────────────────────────────────

    function featuredPostHTML(post) {
        return `
        <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 h-100 overflow-hidden uc-dark">
            <div class="post-media panel overflow-hidden h-100">
                <div class="featured-image bg-gray-25 dark:bg-gray-800 h-100 d-none md:d-block">
                    <canvas class="h-100 w-100"></canvas>
                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                         src="${FALLBACK_IMG1}"
                         data-src="${post.image}"
                         alt="${post.title}"
                         data-uc-img="loading: lazy">
                </div>
                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9 d-block md:d-none">
                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                         src="${FALLBACK_IMG1}"
                         data-src="${post.image}"
                         alt="${post.title}"
                         data-uc-img="loading: lazy">
                </div>
            </div>
            <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
            <div class="post-header panel vstack justify-end items-start gap-1 p-2 sm:p-4 position-cover text-white">
                <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                    <span>${post.date}</span>
                </div>
                <h3 class="post-title h5 lg:h4 m-0 max-w-600px text-white text-truncate-2">
                    <a class="text-none text-white" href="${post.slug}">${post.title}</a>
                </h3>
                <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                    <div class="hstack gap-2">
                        <div class="post-author hstack gap-1">
                            <a href="${post.author.slug}" data-uc-tooltip="${post.author.name}">
                                <img src="${post.author.avatar}" alt="${post.author.name}" class="w-24px h-24px rounded-circle">
                            </a>
                            <a href="${post.author.slug}" class="text-white text-none fw-bold">${post.author.name}</a>
                        </div>
                        <div>
                            <a href="{{ route("article") }}post_comment" class="post-comments text-none hstack gap-narrow">
                                <i class="icon-narrow unicon-chat"></i>
                                <span>${post.comments}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>`;
    }

    function listPostHTML(post) {
        return `
        <div>
            <article class="post type-post panel uc-transition-toggle">
                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                    <div>
                        <div class="post-header panel vstack justify-between gap-1">
                            <h3 class="post-title h6 m-0 text-truncate-2">
                                <a class="text-none hover:text-primary duration-150" href="${post.slug}">${post.title}</a>
                            </h3>
                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                <span>${post.date}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                     src="${FALLBACK_IMG1}"
                                     data-src="${post.image}"
                                     alt="${post.title}"
                                     data-uc-img="loading: lazy">
                            </div>
                            <a href="${post.slug}" class="position-cover"></a>
                        </div>
                    </div>
                </div>
            </article>
        </div>`;
    }

    // ─── RENDER ──────────────────────────────────────────────────────────────

    function render() {
        // Politics: index 0 = featured, rest = list
        const [featured, ...listPosts] = politicsPosts;

        document.getElementById('politics-featured').innerHTML = featuredPostHTML(featured);
        document.getElementById('politics-list').innerHTML    = listPosts.map(listPostHTML).join('');
        document.getElementById('media-list').innerHTML       = mediaPosts.map(listPostHTML).join('');
    }

    document.addEventListener('DOMContentLoaded', render);
</script>
