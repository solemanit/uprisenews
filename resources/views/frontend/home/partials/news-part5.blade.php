{{-- Latest News Section --}}
<div id="latest_news" class="latest-news section panel">
    <div class="section-outer panel py-4 lg:py-6">
        <div class="container max-w-xl">
            <div class="section-inner">
                <div class="content-wrap row child-cols-12 g-4 lg:g-6" data-uc-grid>

                    {{-- Main Content col-9 --}}
                    <div class="md:col-9">
                        <div class="main-wrap panel vstack gap-3 lg:gap-6">
                            <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">Latest</h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x" id="latest-news-list"></div>
                                </div>
                                <div class="block-footer cstack lg:mt-2">
                                    <a href="{{ route("article") }}" class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                        <span>Load more posts</span>
                                        <i class="icon icon-1 unicon-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar col-3 --}}
                    <div class="md:col-3">
                        <div class="sidebar-wrap panel vstack gap-2 pb-2" data-uc-sticky="end: .content-wrap; offset: 150; media: @m;">

                            {{-- Ad Widget --}}
                            <div class="widget ad-widget vstack gap-2 text-center p-2 border">
                                <div class="widgt-content">
                                    <a class="cstack max-w-300px mx-auto text-none" href="https://themeforest.net/user/reacthemes/portfolio" target="_blank" rel="nofollow">
                                        <img class="d-block dark:d-none" src="{{ asset('assets/frontend/images/common/ad-slot-aside.jpg') }}" alt="Ad slot">
                                        <img class="d-none dark:d-block" src="{{ asset('assets/frontend/images/common/ad-slot-aside-2.jpg') }}" alt="Ad slot">
                                    </a>
                                </div>
                            </div>

                            {{-- Popular Now Widget --}}
                            <div class="widget popular-widget vstack gap-2 p-2 border">
                                <div class="widget-title text-center">
                                    <h5 class="fs-7 ft-tertiary text-uppercase m-0">Popular now</h5>
                                </div>
                                <div class="widget-content">
                                    <div class="row child-cols-12 gx-4 gy-3 sep-x" data-uc-grid id="popular-now-list"></div>
                                </div>
                            </div>

                            {{-- Social / Newsletter Widget --}}
                            <div class="widget social-widget vstack gap-2 text-center p-2 border">
                                <div class="widgt-title">
                                    <h4 class="fs-7 ft-tertiary text-uppercase m-0">Follow @News5</h4>
                                </div>
                                <div class="widgt-content">
                                    <form class="vstack gap-1">
                                        <input class="form-control form-control-sm fs-6 fw-medium h-40px w-full bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="email" placeholder="Your email" required>
                                        <button class="btn btn-sm btn-primary" type="submit">Sign up</button>
                                    </form>
                                    <ul class="nav-x justify-center gap-1 mt-3">
                                        <li><a href="{{ route("article") }}fb" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-facebook"></i></a></li>
                                        <li><a href="{{ route("article") }}x" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-x-filled"></i></a></li>
                                        <li><a href="{{ route("article") }}in" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-instagram"></i></a></li>
                                        <li><a href="{{ route("article") }}yt" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const FALLBACK_IMG5 = "{{ asset('assets/frontend/images/common/img-fallback.png') }}";

    // ─── DATA ────────────────────────────────────────────────────────────────
    const latestNewsPosts = [
        {
            title: 'The Rise of AI-Powered Personal Assistants: How They Manage',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-01.jpg') }}",
            excerpt: 'Law enforcement officers have been accused of sexually abusing children over the past two decades, a Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut.'
        },
        {
            title: 'Tech Innovations Reshaping the Retail Landscape: AI Payments',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-02.jpg') }}",
            excerpt: 'Officers have been accused of sexually abusing children over the past two decades, a Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut.'
        },
        {
            title: 'Balancing Work and Wellness: Tech Solutions for Healthy',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-03.jpg') }}",
            excerpt: 'Children over the past two decades, a Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.'
        },
        {
            title: 'The Importance of Sleep: Tips for Better Rest and Recovery',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-04.jpg') }}",
            excerpt: 'Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.'
        },
        {
            title: 'The Future of Sustainable Living: Driving Eco-Friendly Lifestyles',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-05.jpg') }}",
            excerpt: 'Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'Business Agility the Digital Age: Leveraging AI and Automation',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-06.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'The Art of Baking: From Classic Bread to Artisan Pastries',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-07.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'AI and Marketing: Unlocking Customer Insights',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-08.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'Hidden Gems: Underrated Travel Destinations Around the World',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-09.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'Eco-Tourism: Traveling Responsibly and Sustainably',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-10.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'Solo Travel: Some Tips and Destinations for the Adventurous Explorer',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-11.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
        {
            title: 'AI-Powered Financial Planning: How Algorithms Revolutionizing',
            slug: '{{ route("article") }}',
            image: "{{ asset('assets/frontend/images/demo-seven/posts/img-12.jpg') }}",
            excerpt: 'To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform\'s key markets.'
        },
    ];

    const popularNowPosts = [
        {
            title: 'Virtual Reality and Mental Health: Exploring the Therapeutic',
            slug: '{{ route("article") }}',
            date: '2mo ago',
            comments: 290
        },
        {
            title: 'The Future of Sustainable Living: Driving Eco-Friendly Lifestyles',
            slug: '{{ route("article") }}',
            date: '2mo ago',
            comments: 1
        },
        {
            title: 'Smart Homes, Smarter Living: Exploring IoT and AI',
            slug: '{{ route("article") }}',
            date: '23d ago',
            comments: 15
        },
        {
            title: 'How Businesses Are Adapting to E-Commerce and AI Integration',
            slug: '{{ route("article") }}',
            date: '29d ago',
            comments: 20
        },
    ];

    // ─── TEMPLATES ───────────────────────────────────────────────────────────
    function latestNewsItemHTML(post) {
        return `
        <div>
            <article class="post type-post panel uc-transition-toggle">
                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                    <div class="col-auto">
                        <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                     src="${FALLBACK_IMG5}"
                                     data-src="${post.image}"
                                     alt="${post.title}"
                                     data-uc-img="loading: lazy">
                            </div>
                            <a href="${post.slug}" class="position-cover"></a>
                        </div>
                    </div>
                    <div>
                        <div class="post-header panel vstack justify-between gap-1">
                            <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                <a class="text-none hover:text-primary duration-150" href="${post.slug}">${post.title}</a>
                            </h3>
                        </div>
                        <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">${post.excerpt}</p>
                        <div class="post-link">
                            <a href="${post.slug}" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                <span>Read more</span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>`;
    }

    function popularNowItemHTML(post, index) {
        return `
        <div>
            <article class="post type-post panel uc-transition-toggle">
                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                    <div>
                        <div class="hstack items-start gap-3">
                            <span class="h3 lg:h2 ft-tertiary fst-italic text-center text-primary m-0 min-w-24px">${index + 1}</span>
                            <div class="post-header panel vstack justify-between gap-1">
                                <h3 class="post-title h6 m-0">
                                    <a class="text-none hover:text-primary duration-150" href="${post.slug}">${post.title}</a>
                                </h3>
                                <div class="post-meta panel hstack justify-between fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                    <div class="meta">
                                        <div class="hstack gap-2">
                                            <div class="post-date hstack gap-narrow">
                                                <span>${post.date}</span>
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
                    </div>
                </div>
            </article>
        </div>`;
    }

    // ─── RENDER ──────────────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('latest-news-list').innerHTML =
            latestNewsPosts.map(latestNewsItemHTML).join('');

        document.getElementById('popular-now-list').innerHTML =
            popularNowPosts.map((post, i) => popularNowItemHTML(post, i)).join('');
    });
</script>
