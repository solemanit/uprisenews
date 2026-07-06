@extends('frontend.layouts.app')

@section('title', __('News Details') . ' — ' . config('app.name'))

@section('content')
<style>
    .post-content p {
    margin-bottom: 0;
    color: #000 !important;
}
</style>
    <article class="post type-post single-post py-4 lg:py-6 xl:py-9">
        <div class="container max-w-xl">
            <div class="post-header">
                <div class="panel vstack gap-4 md:gap-6 xl:gap-9 text-center">
                    <div class="panel vstack items-center max-w-400px sm:max-w-500px xl:max-w-md mx-auto gap-2 md:gap-3">
                        <h1 class="h4 sm:h3 xl:h1">The Shibganj model of development</h1>
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
                                src="https://netra.news/content/images/size/w2000/2026/06/Mir-Shah-1.webp"
                                data-src="https://netra.news/content/images/size/w2000/2026/06/Mir-Shah-1.webp"
                                alt="The Rise of Gourmet Street Food: Trends and Top Picks" data-uc-img="loading: lazy">
                        </figure>
                    </figure>
                </div>
            </div>
        </div>
        <div class="panel mt-4 lg:mt-6 xl:mt-9">
            <div class="container max-w-lg">
                <div class="post-content panel fs-6 md:fs-5" data-uc-lightbox="animation: scale">
                    <p>Enter Shibganj, in Bogura, and one thing becomes clear almost at once: the local member of parliament, Mir Shahe Alam, is everywhere. At street corners and in the bazaars, on lamp-posts and walls, he gazes down, smiling, from banners, festoons and posters.</p>

                    <p>Every so often a gleaming foundation stone comes into view. On nearly every plaque, the name of the State Minister for Local Government and Rural Development shines out as the project’s inaugurator. On several of the stones, the name of his son’s firm is engraved as the contractor. Most involve the paving of roads.</p>

                    <p>In Garibpur, Ward No. 3 of the municipality, a narrow road catches the eye. At its mouth, houses stand in rows on either side. A little further in come paddy fields and slim earthen ridges. The road is so narrow that simply driving a car into it is a struggle — never mind a vehicle coming the other way; even a motorcycle would have to fight its way through. At one point the road grows so constricted that there is no taking a car any further. A dirt track begins. There, too, stood two more foundation stones — road-building work is to start soon.</p>
                </div>

                <div class="post-navigation panel vstack sm:hstack justify-between gap-2 mt-8 xl:mt-9 md:wrap">
                    <div class="new-post panel hstack w-100 lg:w-1/2">
                        <div class="panel hstack justify-center w-100px h-100px">
                            <figure
                                class="featured-image m-0 ratio ratio-1x1 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                    src="../assets/images/common/img-fallback.png"
                                    data-src="../assets/images/demo-seven/posts/img-02.jpg"
                                    alt="Tech Innovations Reshaping the Retail Landscape: AI Payments"
                                    data-uc-img="loading: lazy">
                                <a href="blog-details.html" class="position-cover"
                                    data-caption="Tech Innovations Reshaping the Retail Landscape: AI Payments"></a>
                            </figure>
                        </div>
                        <div class="panel vstack justify-center px-2 gap-1 w-1/3">
                            <span class="fs-7 opacity-60">Prev Article</span>
                            <h6 class="h6 lg:h5 m-0">Tech Innovations Reshaping the Retail Landscape: AI Payments</h6>
                        </div>
                        <a href="blog-details.html" class="position-cover"></a>
                    </div>
                    <div class="new-post panel hstack w-100 lg:w-1/2">
                        <div class="panel vstack justify-center px-2 gap-1 w-1/3 text-end">
                            <span class="fs-7 opacity-60">Next Article</span>
                            <h6 class="h6 lg:h5 m-0">The Rise of AI-Powered Personal Assistants: How They Manage</h6>
                        </div>
                        <div class="panel hstack justify-center w-100px h-100px">
                            <figure
                                class="featured-image m-0 ratio ratio-1x1 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                    src="../assets/images/common/img-fallback.png"
                                    data-src="../assets/images/demo-seven/posts/img-01.jpg"
                                    alt="The Rise of AI-Powered Personal Assistants: How They Manage"
                                    data-uc-img="loading: lazy">
                                <a href="blog-details.html" class="position-cover"
                                    data-caption="The Rise of AI-Powered Personal Assistants: How They Manage"></a>
                            </figure>
                        </div>
                        <a href="blog-details.html" class="position-cover"></a>
                    </div>
                </div>
                <div class="post-related panel border-top pt-2 mt-8 xl:mt-9">
                    <h4 class="h5 xl:h4 mb-5 xl:mb-6">Related to this topic:</h4>
                    <div class="row child-cols-6 md:child-cols-3 gx-2 gy-4 sm:gx-3 sm:gy-6">
                        <div>
                            <article class="post type-post panel vstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                        src="../assets/images/common/img-fallback.png"
                                        data-src="../assets/images/demo-seven/posts/img-07.jpg"
                                        alt="The Art of Baking: From Classic Bread to Artisan Pastries"
                                        data-uc-img="loading: lazy">
                                    <a href="blog-details.html" class="position-cover"
                                        data-caption="The Art of Baking: From Classic Bread to Artisan Pastries"></a>
                                </figure>
                                <div class="post-header panel vstack gap-1">
                                    <h5 class="h6 md:h5 m-0">
                                        <a class="text-none" href="blog-details.html">The Art of Baking: From Classic
                                            Bread to Artisan Pastries</a>
                                    </h5>
                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                        <span>Feb 28, 2024</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div>
                            <article class="post type-post panel vstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                        src="../assets/images/common/img-fallback.png"
                                        data-src="../assets/images/demo-seven/posts/img-08.jpg"
                                        alt="AI and Marketing: Unlocking Customer Insights" data-uc-img="loading: lazy">
                                    <a href="blog-details.html" class="position-cover"
                                        data-caption="AI and Marketing: Unlocking Customer Insights"></a>
                                </figure>
                                <div class="post-header panel vstack gap-1">
                                    <h5 class="h6 md:h5 m-0">
                                        <a class="text-none" href="blog-details.html">AI and Marketing: Unlocking Customer
                                            Insights</a>
                                    </h5>
                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                        <span>Feb 22, 2024</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div>
                            <article class="post type-post panel vstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                        src="../assets/images/common/img-fallback.png"
                                        data-src="../assets/images/demo-seven/posts/img-09.jpg"
                                        alt="Hidden Gems: Underrated Travel Destinations Around the World"
                                        data-uc-img="loading: lazy">
                                    <a href="blog-details.html" class="position-cover"
                                        data-caption="Hidden Gems: Underrated Travel Destinations Around the World"></a>
                                </figure>
                                <div class="post-header panel vstack gap-1">
                                    <h5 class="h6 md:h5 m-0">
                                        <a class="text-none" href="blog-details.html">Hidden Gems: Underrated Travel
                                            Destinations Around the World</a>
                                    </h5>
                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                        <span>Feb 14, 2024</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                        <div>
                            <article class="post type-post panel vstack gap-2">
                                <figure
                                    class="featured-image m-0 ratio ratio-4x3 rounded uc-transition-toggle overflow-hidden bg-gray-25 dark:bg-gray-800">
                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque"
                                        src="../assets/images/common/img-fallback.png"
                                        data-src="../assets/images/demo-seven/posts/img-10.jpg"
                                        alt="Eco-Tourism: Traveling Responsibly and Sustainably"
                                        data-uc-img="loading: lazy">
                                    <a href="blog-details.html" class="position-cover"
                                        data-caption="Eco-Tourism: Traveling Responsibly and Sustainably"></a>
                                </figure>
                                <div class="post-header panel vstack gap-1">
                                    <h5 class="h6 md:h5 m-0">
                                        <a class="text-none" href="blog-details.html">Eco-Tourism: Traveling Responsibly
                                            and Sustainably</a>
                                    </h5>
                                    <div class="post-date hstack gap-narrow fs-7 opacity-60">
                                        <span>Feb 8, 2024</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <a href="#commont"
                    class="btn h-56px w-100 mt-8 xl:mt-9 text-black dark:text-white bg-gray-25 dark:bg-opacity-10 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <span>Be the first to write a comment.</span>
                </a>

                <div id="blog-comment" class="panel border-top pt-2 mt-8 xl:mt-9">
                    <h4 class="h5 xl:h4 mb-5 xl:mb-6">Comments (5)</h4>

                    <div class="spacer-half"></div>

                    <ol>
                        <li>
                            <div class="avatar">
                                <img src="../assets/images/avatars/01.png" alt="">
                            </div>
                            <div class="comment-info">
                                <span class="c_name">Merrill Rayos</span>
                                <span class="c_date id-color">2 days ago</span>
                                <span class="c_reply"><a href="#">Reply</a></span>
                                <div class="clearfix"></div>
                            </div>

                            <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem
                                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab
                                illo
                                inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo.</div>
                            <ol>
                                <li>
                                    <div class="avatar">
                                        <img src="../assets/images/avatars/02.png" alt="">
                                    </div>
                                    <div class="comment-info">
                                        <span class="c_name">Jackqueline Sprang</span>
                                        <span class="c_date id-color">2 days ago</span>
                                        <span class="c_reply"><a href="#">Reply</a></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="comment">Sed ut perspiciatis unde omnis iste natus error
                                        sit
                                        voluptatem accusantium doloremque laudantium, totam rem aperiam,
                                        eaque ipsa
                                        quae ab illo inventore veritatis et quasi architecto beatae
                                        vitae dicta sunt
                                        explicabo.</div>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <div class="avatar">
                                <img src="../assets/images/avatars/03.png" alt="">
                            </div>
                            <div class="comment-info">
                                <span class="c_name">Sanford Crowley</span>
                                <span class="c_date id-color">2 days ago</span>
                                <span class="c_reply"><a href="#">Reply</a></span>
                                <div class="clearfix"></div>
                            </div>
                            <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem
                                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab
                                illo
                                inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo.</div>
                            <ol>
                                <li>
                                    <div class="avatar">
                                        <img src="../assets/images/avatars/04.png" alt="">
                                    </div>
                                    <div class="comment-info">
                                        <span class="c_name">Lyndon Pocekay</span>
                                        <span class="c_date id-color">2 days ago</span>
                                        <span class="c_reply"><a href="#">Reply</a></span>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="comment">Sed ut perspiciatis unde omnis iste natus error
                                        sit
                                        voluptatem accusantium doloremque laudantium, totam rem aperiam,
                                        eaque ipsa
                                        quae ab illo inventore veritatis et quasi architecto beatae
                                        vitae dicta sunt
                                        explicabo.</div>
                                </li>
                            </ol>
                        </li>

                        <li>
                            <div class="avatar">
                                <img src="../assets/images/avatars/05.png" alt="">
                            </div>
                            <div class="comment-info">
                                <span class="c_name">Aleen Crigger</span>
                                <span class="c_date id-color">2 days ago</span>
                                <span class="c_reply"><a href="#">Reply</a></span>

                                <div class="clearfix"></div>
                            </div>
                            <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit
                                voluptatem
                                accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab
                                illo
                                inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo.</div>
                        </li>
                    </ol>

                    <div class="spacer-single"></div>

                    <div id="comment-form-wrapper" class="panel pt-2 mt-8 xl:mt-9">
                        <h4 class="h5 xl:h4 mb-5 xl:mb-6">Leave a Comment</h4>
                        <div class="comment_form_holder">
                            <form class="vstack gap-2">
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                    type="text" placeholder="First name" required>
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                    type="text" placeholder="Last name" required>
                                <input
                                    class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                    type="email" placeholder="Your email" required>
                                <textarea
                                    class="form-control h-250px w-full fs-6 bg-white dark:bg-opacity-0 dark:text-white dark:border-gray-300 dark:border-opacity-30"
                                    type="text" placeholder="Your comment" required></textarea>
                                <button class="btn btn-dark btn-sm mt-1" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

@endsection
