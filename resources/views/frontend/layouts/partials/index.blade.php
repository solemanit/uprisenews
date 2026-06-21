@extends('frontend.layouts.app')

@section('title', __('Home') . ' — ' . config('app.name'))

@section('content')

 <!--  Search modal -->
@include('frontend.home.partials.search')

<!--  Menu panel -->
<div id="uc-menu-panel" data-uc-offcanvas="overlay: true;">
    <div class="uc-offcanvas-bar bg-white text-dark dark:bg-gray-900 dark:text-white">
        <header class="uc-offcanvas-header hstack justify-between items-center pb-4 bg-white dark:bg-gray-900">
            <div class="uc-logo">
                <a href="index.html" class="h5 text-none text-gray-900 dark:text-white">
                    <img class="w-32px" src="https://html.themewant.com/news5/assets/images/common/logo-icon.svg" alt="News5" data-uc-svg>
                </a>
            </div>
            <button class="uc-offcanvas-close p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all" type="button">
                <i class="unicon-close"></i>
            </button>
        </header>

        <div class="panel">
            <form id="search-panel" class="form-icon-group vstack gap-1 mb-3" data-uc-sticky="">
                <input type="email" class="form-control form-control-md fs-6" placeholder="Search..">
                <span class="form-icon text-gray">
                    <i class="unicon-search icon-1"></i>
                </span>
            </form>
            <ul class="nav-y gap-narrow fw-bold fs-5" data-uc-nav>
                <li class="uc-parent"><a href="#">Homepages</a></li>
                <li><a href="#">Latest</a></li>
                <li><a href="#">Trending</a></li>
                <li class="hr opacity-10 my-1"></li>
                <li><a href="#">Sign in</a></li>
            </ul>
            <ul class="social-icons nav-x mt-4">
                <li>
                    <a href="#"><i class="unicon-logo-medium icon-2"></i></a>
                    <a href="#"><i class="unicon-logo-x-filled icon-2"></i></a>
                    <a href="#"><i class="unicon-logo-instagram icon-2"></i></a>
                    <a href="#"><i class="unicon-logo-pinterest icon-2"></i></a>
                </li>
            </ul>
            <div class="py-2 hstack gap-2 mt-4 bg-white dark:bg-gray-900" data-uc-sticky="position: bottom">
                <div class="vstack gap-1">
                    <span class="fs-7 opacity-60">Select theme:</span>
                    <div class="darkmode-trigger" data-darkmode-switch="">
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider fs-5"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Account modal -->
<div id="uc-account-modal" data-uc-modal="overlay: true">
    <div class="uc-modal-dialog lg:max-w-500px bg-white text-dark dark:bg-gray-800 dark:text-white rounded">
        <button class="uc-modal-close-default p-0 icon-3 btn border-0 dark:text-white dark:text-opacity-50 hover:text-primary hover:rotate-90 duration-150 transition-all" type="button">
            <i class="unicon-close"></i>
        </button>
        <div class="panel vstack gap-2 md:gap-4 text-center">
            <ul class="account-tabs-nav nav-x justify-center h6 py-2 border-bottom d-none" data-uc-switcher="animation: uc-animation-slide-bottom-small, uc-animation-slide-top-small">
                <li><a href="#">Sign in</a></li>
                <li><a href="#">Sign up</a></li>
                <li><a href="#">Reset password</a></li>
                <li><a href="#">Terms of use</a></li>
            </ul>
            <div class="account-tabs-content uc-switcher px-3 lg:px-4 py-4 lg:py-8 m-0 lg:mx-auto vstack justify-center items-center">
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4 text-center">
                        <h4 class="h5 lg:h4 m-0">Log in</h4>
                        <div class="panel vstack gap-2 w-100 sm:w-350px mx-auto">
                            <form class="vstack gap-2">
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15" type="email" placeholder="Your email" required>
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15" type="password" placeholder="Password" autocomplete="new-password" required>
                                <div class="hstack justify-between items-start text-start">
                                    <div class="form-check text-start">
                                        <input class="form-check-input rounded-0 dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15" type="checkbox" id="inputCheckRemember">
                                        <label class="hstack justify-between form-check-label fs-7 sm:fs-6" for="inputCheckRemember">Remember me?</label>
                                    </div>
                                    <a href="#" class="uc-link fs-6" data-uc-switcher-item="2">Forgot password</a>
                                </div>
                                <button class="btn btn-primary btn-sm lg:mt-1" type="submit">Log in</button>
                            </form>
                            <div class="panel h-24px">
                                <hr class="position-absolute top-50 start-50 translate-middle hr m-0 w-100">
                                <span class="position-absolute top-50 start-50 translate-middle px-1 fs-7 text-uppercase bg-white dark:bg-gray-800">Or</span>
                            </div>
                            <div class="hstack gap-2">
                                <a href="#google" class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-google"></i>
                                </a>
                                <a href="#facebook" class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-facebook"></i>
                                </a>
                                <a href="#twitter" class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-x-filled"></i>
                                </a>
                            </div>
                        </div>
                        <p class="fs-7 sm:fs-6">Have no account yet? <a class="uc-link" href="#" data-uc-switcher-item="1">Sign up</a></p>
                    </div>
                </div>
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4 text-center">
                        <h4 class="h5 lg:h4 m-0">Create an account</h4>
                        <div class="panel vstack gap-2 w-100 sm:w-350px mx-auto">
                            <form class="vstack gap-2">
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="text" placeholder="Full name" required>
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="email" placeholder="Your email" required>
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="password" placeholder="Password" autocomplete="new-password" required>
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="password" placeholder="Re-enter Password" autocomplete="new-password" required>
                                <div class="hstack text-start">
                                    <div class="form-check text-start">
                                        <input id="input_checkbox_accept_terms" class="form-check-input rounded-0 dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="checkbox" required>
                                        <label for="input_checkbox_accept_terms" class="hstack justify-between form-check-label fs-7 sm:fs-6">I read and accept the <a href="#" class="uc-link ms-narrow" data-uc-switcher-item="3">terms of use</a>. </label>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-sm lg:mt-1" type="submit">Sign up</button>
                            </form>
                            <div class="panel h-24px">
                                <hr class="position-absolute top-50 start-50 translate-middle hr m-0 w-100">
                                <span class="position-absolute top-50 start-50 translate-middle px-1 fs-7 text-uppercase bg-white dark:bg-gray-800">Or</span>
                            </div>
                            <div class="hstack gap-2">
                                <a href="#google" class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-google"></i>
                                </a>
                                <a href="#facebook" class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-facebook"></i>
                                </a>
                                <a href="#twitter" class="hstack items-center justify-center flex-1 gap-1 h-40px text-none rounded border border-gray-900 dark:bg-gray-800 dark:border-white dark:border-opacity-15 border-opacity-10">
                                    <i class="icon icon-1 unicon-logo-x-filled"></i>
                                </a>
                            </div>
                        </div>
                        <p class="fs-7 sm:fs-6">Already have an account? <a class="uc-link" href="#" data-uc-switcher-item="0">Log in</a></p>
                    </div>
                </div>
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4 text-center">
                        <h4 class="h5 lg:h4 m-0">Reset password</h4>
                        <div class="panel w-100 sm:w-350px">
                            <form class="vstack gap-2">
                                <input class="form-control form-control-sm h-40px w-full fs-6 bg-white dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="email" placeholder="Your email" required>
                                <div class="form-check text-start">
                                    <input class="form-check-input rounded-0 dark:bg-gray-800 dark:border-white dark:border-opacity-15" type="checkbox" id="inputCheckVerify" required>
                                    <label class="form-check-label fs-7 sm:fs-6" for="inputCheckVerify"> <span>I'm not a robot</span>. </label>
                                </div>
                                <button class="btn btn-primary btn-sm lg:mt-1" type="submit">Reset a password</button>
                            </form>
                        </div>
                        <p class="fs-7 sm:fs-6 mt-2 sm:m-0">Remember your password? <a class="uc-link" href="#" data-uc-switcher-item="0">Log in</a></p>
                    </div>
                </div>
                <div class="w-100">
                    <div class="panel vstack justify-center items-center gap-2 sm:gap-4">
                        <h4 class="h5 lg:h4 m-0">Terms of use</h4>
                        <div class="page-content panel fs-6 text-start max-h-400px overflow-scroll">
                            <p>Terms of use dolor sit amet consectetur, adipisicing elit. Recusandae provident ullam aperiam quo ad non corrupti sit vel quam repellat ipsa quod sed, repellendus adipisci, ducimus ea modi odio assumenda.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">Disclaimers</h5>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi, cum esse possimus officiis amet ea voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad iusto! Praesentium error nobis tenetur at, quis nostrum facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">Limitation on Liability</h5>
                            <p>Sequi, cum esse possimus officiis amet ea voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad iusto! Praesentium error nobis tenetur at, quis nostrum facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">Copyright Policy</h5>
                            <p>Dolor sit amet consectetur adipisicing elit. Sequi, cum esse possimus officiis amet ea voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad iusto! Praesentium error nobis tenetur at, quis nostrum facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                            <h5 class="h6 md:h5 mt-3 mb-1">General</h5>
                            <p>Sit amet consectetur adipisicing elit. Sequi, cum esse possimus officiis amet ea voluptatibus libero! Dolorum assumenda esse, deserunt ipsum ad iusto! Praesentium error nobis tenetur at, quis nostrum facere excepturi architecto totam.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, soluta alias eaque modi ipsum sint iusto fugiat vero velit rerum.</p>
                        </div>
                        <p class="fs-7 sm:fs-6">Do you agree to our terms? <a class="uc-link" href="#" data-uc-switcher-item="1">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  Bottom Actions Sticky -->
<div class="backtotop-wrap position-fixed bottom-0 end-0 z-99 m-2 vstack">
    <div class="darkmode-trigger cstack w-40px h-40px rounded-circle text-none bg-gray-100 dark:bg-gray-700 dark:text-white" data-darkmode-toggle="">
        <label class="switch">
            <span class="sr-only">Dark mode toggle</span>
            <input type="checkbox">
            <span class="slider fs-5"></span>
        </label>
    </div>
    <a class="btn btn-sm bg-primary text-white w-40px h-40px rounded-circle" href="to_top.html" data-uc-backtotop>
        <i class="icon-2 unicon-chevron-up"></i>
    </a>
</div>

<!-- Header start -->
<header class="uc-header header-seven uc-navbar-sticky-wrap z-999">
    <nav class="uc-navbar-container text-gray-900 dark:text-white fs-6 z-1">
        <div class="uc-bottom-navbar panel z-1">
            <div class="container max-w-xl">
                <div class="uc-navbar min-h-72px lg:min-h-100px" data-uc-navbar=" animation: uc-animation-slide-top-small; duration: 150;">
                    <div class="uc-navbar-left">
                        <div>
                            <a class="uc-menu-trigger icon-2" href="#uc-menu-panel" data-uc-toggle></a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="btn btn-xs gap-narrow ps-1 border rounded-pill fw-bold dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900" href="#live_now" data-uc-scroll="offset: 128">
                                <i class="icon icon-narrow unicon-dot-mark text-red" data-uc-animate="flash"></i>
                                <span>Live</span>
                            </a>
                        </div>
                        <div class="uc-logo d-block md:d-none">
                            <a href="index.html">
                                <img class="w-100px text-dark dark:text-white" src="https://html.themewant.com/news5/assets/images/demo-seven/common/logo.svg" alt="News5" data-uc-svg>
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-center">
                        <div class="uc-logo d-none md:d-block">
                            <a href="index.html">
                                <img class="w-150px text-dark dark:text-white" src="https://html.themewant.com/news5/assets/images/demo-seven/common/logo.svg" alt="News5" data-uc-svg>
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-right gap-2 lg:gap-3">
                        <div class="uc-navbar-item d-inline-flex lg:d-none">
                            <a class="btn btn-xs gap-narrow ps-1 border rounded-pill fw-bold dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900" href="#live_now" data-uc-scroll="offset: 128">
                                <i class="icon icon-narrow unicon-dot-mark text-red" data-uc-animate="flash"></i>
                                <span>Live</span>
                            </a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="uc-account-trigger position-relative btn btn-sm border-0 p-0 gap-narrow duration-0 dark:text-white" href="#uc-account-modal" data-uc-toggle>
                                <i class="icon icon-2 fw-medium unicon-user-avatar"></i>
                            </a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <a class="uc-search-trigger cstack text-none text-dark dark:text-white" href="#uc-search-modal" data-uc-toggle>
                                <i class="icon icon-2 fw-medium unicon-search"></i>
                            </a>
                        </div>
                        <div class="uc-navbar-item d-none lg:d-inline-flex">
                            <div class="uc-modes-trigger btn btn-xs w-32px h-32px p-0 border fw-normal rounded-circle dark:text-white hover:bg-gray-25 dark:hover:bg-gray-900" data-darkmode-toggle="">
                                <label class="switch">
                                    <span class="sr-only">Dark toggle</span>
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Header end -->

<!-- Wrapper start -->
<div id="wrapper" class="wrap overflow-hidden-x">

    <div class="border-top"></div>
<div class="uc-bottom-navbar panel hstack z-1 min-h-48px lg:min-h-56px bg-gray-800 border-top border-bottom uc-navbar" data-uc-navbar=" animation: uc-animation-slide-top-small; duration: 150;">
            <div class="container max-w-xl">
                <div class="hstack">
                    <div class="uc-navbar-left gap-2 lg:gap-3 d-none lg:d-flex">
                        <div class="uc-navbar-item">
                            <a class="uc-search-trigger mb-narrow" href="#uc-search-modal" data-uc-toggle="" role="button">
                                <img class="text-white" src="../assets/images/common/icons/search.svg" alt="Search" data-uc-svg="" style="width: 20px" hidden=""><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-white uc-svg" style="width: 20px;"><g clip-path="url(#clip0_3126_65698)" fill="#15171A"><path d="M32 30.326l-8.939-8.939a13.042 13.042 0 10-1.674 1.674L30.327 32 32 30.326zM2.41 13.062a10.653 10.653 0 1110.652 10.653A10.665 10.665 0 012.409 13.062z"></path><path d="M32 30.326l-8.939-8.939a13.042 13.042 0 10-1.674 1.674L30.327 32 32 30.326zM2.41 13.062a10.653 10.653 0 1110.652 10.653A10.665 10.665 0 012.409 13.062z"></path></g><defs><clipPath id="clip0_3126_65698"><path fill="#fff" d="M0 0h32v32H0z"></path></clipPath></defs></svg>
                            </a>
                        </div>
                    </div>
                    <div class="uc-navbar-center gap-2 lg:gap-3">
                        <div class="uc-navbar-item" style="--uc-nav-height: 48px">
                            <ul class="nav-x fw-semibold flex-nowrap overflow-x-auto hide-scrollbar uc-horizontal-scroll w-screen md:w-auto md:mask-end-0 mx-n2 px-2 text-white">
                                <li class="uc-active"><a href="#">Home</a></li>
                                <li><a href="#">Social</a></li>
                                <li><a href="#">Politics</a></li>
                                <li><a href="#">Economy</a></li>
                                <li><a href="#">Sports</a></li>
                                <li><a href="#">Arts</a></li>
                                <li><a href="#">International</a></li>
                                <li class="nav-divider vr"></li>
                                <li>
                                    <a href="#"><i class="icon icon-1 unicon-microphone"></i> Podcasts</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-1 unicon-play"></i> News TV</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="uc-navbar-right gap-2 lg:gap-3 d-none lg:d-flex">
                        <div class="uc-navbar-item">
                            <div class="uc-modes-trigger icon-1 text-white" data-darkmode-toggle="">
                                <label class="switch">
                                    <span class="sr-only">Dark toggle</span>
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Section start -->

    <div class="section panel mb-4 lg:mb-6 mt-0">
<div class="section-outer panel w-100">
<div class="container-full">
    <div class="section-inner panel vstack gap-4">
        <div class="section-content">

            <article class="post type-post panel uc-transition-toggle vstack overflow-hidden uc-dark min-h-450px lg:min-h-600px">

                <!-- Background Image -->
                <div class="panel overflow-hidden position-cover">
                    <img
                        class="media-cover image uc-transition-scale-up uc-transition-opaque"
                        src="../assets/images/demo-seven/posts/img-11.jpg"
                        alt="A Terrorism Law, and the Children It Swept Up"
                        loading="lazy">
                </div>

                <!-- Gradient Overlay -->
                <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>

                <!-- Content -->
                <div class="post-header panel vstack justify-end items-start gap-2 p-3 sm:p-4 lg:p-6 position-cover text-white">

                    <!-- Category Badge -->
                    <div class="hstack gap-narrow">
                        <a href="category.html"
                            class="text-none bg-primary px-2 py-narrow rounded-1 fs-7 fw-bold text-uppercase text-white">
                            Featured Report
                        </a>
                    </div>

                    <!-- Title -->
                    <h1 class="post-title h4 lg:h3 m-0 max-w-600px text-white text-truncate-2">
                        <a class="text-none text-white" href="#">
                            A Terrorism Law, and the Children It Swept Up
                        </a>
                    </h1>

                    <!-- Excerpt -->
                    <p class="fs-6 max-w-600px d-none md:d-block text-white text-opacity-70">
                        In Chattogram, schoolboys as young as 16 say they were detained under sweeping new powers written for militants — then beaten, made to confess on camera and packed into a detention centre they called the 'ilish file'.
                    </p>

                    <!-- Meta -->
                    <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1 w-100 border-top border-white border-opacity-15 pt-1">
                        <div class="meta">
                            <div class="hstack gap-2">

                                <!-- Author -->
                                <div class="post-author hstack gap-1">
                                    <a href="page-author.html" data-uc-tooltip="Iffat Ara Munia">
                                        <img src="assets/images/avatars/03.png"
                                                alt="Iffat Ara Munia"
                                                class="w-24px h-24px rounded-circle">
                                    </a>
                                    <a href="page-author.html"
                                        class="text-none text-white fw-bold">
                                        Iffat Ara Munia
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Date -->
                        <div class="post-date hstack gap-narrow fs-7 text-white text-opacity-60">
                            <span>June 7th, 2026</span>
                        </div>
                    </div>

                </div>
            </article>

        </div>
    </div>
</div>
</div>
</div>

    <!-- Section end -->

    <!-- Section start -->
    <div class="section panel overflow-hidden">
        <div class="section-outer panel">
            <div class="container max-w-xl">
                <div class="section-inner">
                    <div class="row child-cols-12 lg:child-cols g-4 lg:g-6 col-match" data-uc-grid>
                        <div class="lg:col-8">
                            <div class="block-layout grid-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                            <span>Poltics</span>
                                            <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                        </a>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="panel row child-cols-12 md:child-cols g-2 lg:g-4 col-match sep-y" data-uc-grid>
                                        <div class="col-12 md:col-6 order-0 md:order-1">
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 h-100 overflow-hidden uc-dark">
                                                    <div class="post-media panel overflow-hidden h-100">
                                                        <div class="featured-image bg-gray-25 dark:bg-gray-800 h-100 d-none md:d-block">
                                                            <canvas class="h-100 w-100"></canvas>
                                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-04.jpg" alt="The Importance of Sleep: Tips for Better Rest and Recovery" data-uc-img="loading: lazy">
                                                        </div>
                                                        <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9 d-block md:d-none">
                                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-04.jpg" alt="The Importance of Sleep: Tips for Better Rest and Recovery" data-uc-img="loading: lazy">
                                                        </div>
                                                    </div>
                                                    <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
                                                    <div class="post-header panel vstack justify-end items-start gap-1 p-2 sm:p-4 position-cover text-white">
                                                        <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                            <span>2h</span>
                                                        </div>
                                                        <h3 class="post-title h5 lg:h4 m-0 max-w-600px text-white text-truncate-2">
                                                            <a class="text-none text-white" href="#">The Importance of Sleep: Tips for Better Rest and Recovery</a>
                                                        </h3>
                                                        <div>
                                                            <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                                                                <div class="meta">
                                                                    <div class="hstack gap-2">
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="page-author.html" data-uc-tooltip="Sarah Eddrissi"><img src="../assets/images/avatars/03.png" alt="Sarah Eddrissi" class="w-24px h-24px rounded-circle"></a>
                                                                                <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">Sarah Eddrissi</a>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                <i class="icon-narrow unicon-chat"></i>
                                                                                <span>0</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="hstack gap-1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        <div class="order-1 md:order-0">
                                            <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">The Future of Sustainable Living: Driving Eco-Friendly Lifestyles</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>12h</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-05.jpg" alt="The Future of Sustainable Living: Driving Eco-Friendly Lifestyles" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Eco-Tourism: Traveling Responsibly and Sustainably</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>29d</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-10.jpg" alt="Eco-Tourism: Traveling Responsibly and Sustainably" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Tech Tools for your Time Management: Enhancing Productivity</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>3mo</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-13.jpg" alt="Tech Tools for your Time Management: Enhancing Productivity" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Potential of Immersive Technologies help your Business Grow</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>1yr</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-17.jpg" alt="Potential of Immersive Technologies help your Business Grow" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Solo Travel: Some Tips and Destinations for the Adventurous Explorer</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-11.jpg" alt="Solo Travel: Some Tips and Destinations for the Adventurous Explorer" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Gaming in the Age of AI: Strategies for Startups</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>9mo</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-15.jpg" alt="Gaming in the Age of AI: Strategies for Startups" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Virtual Reality and Mental Health: Exploring the Therapeutic</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-18.jpg" alt="Virtual Reality and Mental Health: Exploring the Therapeutic" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Smart Homes, Smarter Living: Exploring IoT and AI</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>23d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-20.jpg" alt="Smart Homes, Smarter Living: Exploring IoT and AI" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section end -->

    <!-- Section start -->
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
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-09.jpg" alt="Hidden Gems: Underrated Travel Destinations Around the World" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">Hidden Gems: Underrated Travel Destinations Around the World</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>23d</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>15</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-10.jpg" alt="Eco-Tourism: Traveling Responsibly and Sustainably" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">Eco-Tourism: Traveling Responsibly and Sustainably</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>29d</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>20</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-11.jpg" alt="Solo Travel: Some Tips and Destinations for the Adventurous Explorer" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">Solo Travel: Some Tips and Destinations for the Adventurous Explorer</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>5</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-12.jpg" alt="AI-Powered Financial Planning: How Algorithms Revolutionizing" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">AI-Powered Financial Planning: How Algorithms Revolutionizing</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>2</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-13.jpg" alt="Tech Tools for your Time Management: Enhancing Productivity" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">Tech Tools for your Time Management: Enhancing Productivity</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>3mo</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>19</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-14.jpg" alt="A Guide to The Rise of Gourmet Street Food: Trends and Top Picks" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">A Guide to The Rise of Gourmet Street Food: Trends and Top Picks</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>6mo</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>2</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-15.jpg" alt="Gaming in the Age of AI: Strategies for Startups" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">Gaming in the Age of AI: Strategies for Startups</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>9mo</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>19</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-16.jpg" alt="Top Independent Contractors to Invest in Best of Startups" data-uc-img="loading: lazy">
                                                    </div>
                                                    <a href="#" class="position-cover"></a>
                                                </div>
                                                <div class="post-header panel vstack gap-1">
                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                        <a class="text-none hover:text-primary duration-150" href="#">Top Independent Contractors to Invest in Best of Startups</a>
                                                    </h3>
                                                    <div class="post-meta panel hstack justify-start gap-1 fs-7 ft-tertiary fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex z-1 d-none md:d-block">
                                                        <div>
                                                            <div class="post-date hstack gap-narrow">
                                                                <span>1yr</span>
                                                            </div>
                                                        </div>
                                                        <div>·</div>
                                                        <div>
                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                <i class="icon-narrow unicon-chat"></i>
                                                                <span>12</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Section end -->

    <!-- Section start -->
    <div class="section panel overflow-hidden">
        <div class="section-outer panel">
            <div class="container max-w-xl">
                <div class="section-inner">
                    <div class="row child-cols-12 lg:child-cols g-4 lg:g-6 col-match" data-uc-grid>
                        <div class="lg:col-8 order-0 lg:order-2">
                            <div class="block-layout grid-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                            <span>Opinions</span>
                                            <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                        </a>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="panel row child-cols-12 md:child-cols g-2 lg:g-4 col-match sep-y" data-uc-grid>
                                        <div class="col-12 md:col-6 order-0 md:order-1">
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 h-100 overflow-hidden uc-dark">
                                                    <div class="post-media panel overflow-hidden h-100">
                                                        <div class="featured-image bg-gray-25 dark:bg-gray-800 h-100 d-none md:d-block">
                                                            <canvas class="h-100 w-100"></canvas>
                                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-01.jpg" alt="The Rise of AI-Powered Personal Assistants: How They Manage" data-uc-img="loading: lazy">
                                                        </div>
                                                        <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-16x9 d-block md:d-none">
                                                            <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-01.jpg" alt="The Rise of AI-Powered Personal Assistants: How They Manage" data-uc-img="loading: lazy">
                                                        </div>
                                                    </div>
                                                    <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
                                                    <div class="post-header panel vstack justify-end items-start gap-1 p-2 sm:p-4 position-cover text-white">
                                                        <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                            <span>1min</span>
                                                        </div>
                                                        <h3 class="post-title h5 lg:h4 m-0 max-w-600px text-white text-truncate-2">
                                                            <a class="text-none text-white" href="#">The Rise of AI-Powered Personal Assistants: How They Manage</a>
                                                        </h3>
                                                        <div>
                                                            <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                                                                <div class="meta">
                                                                    <div class="hstack gap-2">
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="page-author.html" data-uc-tooltip="David Peterson"><img src="../assets/images/avatars/01.png" alt="David Peterson" class="w-24px h-24px rounded-circle"></a>
                                                                                <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">David Peterson</a>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                <i class="icon-narrow unicon-chat"></i>
                                                                                <span>2</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="hstack gap-1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                        <div class="order-1 md:order-0">
                                            <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Business Agility the Digital Age: Leveraging AI and Automation</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>7d</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-06.jpg" alt="Business Agility the Digital Age: Leveraging AI and Automation" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">A Guide to The Rise of Gourmet Street Food: Trends and Top Picks</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>6mo</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-14.jpg" alt="A Guide to The Rise of Gourmet Street Food: Trends and Top Picks" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Top Independent Contractors to Invest in Best of Startups</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>1yr</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-16.jpg" alt="Top Independent Contractors to Invest in Best of Startups" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                                <div>
                                                    <article class="post type-post panel uc-transition-toggle">
                                                        <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                            <div>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0 text-truncate-2">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">The Future of Sustainable Living: Driving Eco-Friendly Lifestyles</a>
                                                                    </h3>
                                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <span>2mo</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-19.jpg" alt="The Future of Sustainable Living: Driving Eco-Friendly Lifestyles" data-uc-img="loading: lazy">
                                                                    </div>
                                                                    <a href="#" class="position-cover"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-4 order-1">
                            <div class="block-layout grid-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                            <span>World</span>
                                            <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                        </a>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Tech Innovations Reshaping the Retail Landscape: AI Payments</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>55min</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-02.jpg" alt="Tech Innovations Reshaping the Retail Landscape: AI Payments" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">The Art of Baking: From Classic Bread to Artisan Pastries</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>9d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-07.jpg" alt="The Art of Baking: From Classic Bread to Artisan Pastries" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Hidden Gems: Underrated Travel Destinations Around the World</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>23d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-09.jpg" alt="Hidden Gems: Underrated Travel Destinations Around the World" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">AI-Powered Financial Planning: How Algorithms Revolutionizing</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-12.jpg" alt="AI-Powered Financial Planning: How Algorithms Revolutionizing" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section end -->

    <!-- Section start -->
    <div class="section panel overflow-hidden">
        <div class="section-outer panel py-4 lg:py-6 dark:text-white">
            <div class="container max-w-xl">
                <div class="section-inner">
                    <div class="row child-cols-12 lg:child-cols g-4 lg:g-6 col-match" data-uc-grid>
                        <div class="lg:col-4">
                            <div class="block-layout list-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                            <span>Tech</span>
                                            <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                        </a>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 overflow-hidden uc-dark">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-4x3">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-01.jpg" alt="The Rise of AI-Powered Personal Assistants: How They Manage" data-uc-img="loading: lazy">
                                                    </div>
                                                </div>
                                                <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
                                                <div class="post-header panel vstack justify-start items-start flex-column-reverse gap-1 p-2 position-cover text-white">
                                                    <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                                                        <div class="meta">
                                                            <div class="hstack gap-2">
                                                                <div>
                                                                    <div class="post-author hstack gap-1">
                                                                        <a href="page-author.html" data-uc-tooltip="David Peterson"><img src="../assets/images/avatars/01.png" alt="David Peterson" class="w-24px h-24px rounded-circle"></a>
                                                                        <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">David Peterson</a>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                        <span>2</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="hstack gap-1"></div>
                                                        </div>
                                                    </div>
                                                    <h3 class="post-title h6 lg:h5 m-0 m-0 max-w-600px text-white text-truncate-2">
                                                        <a class="text-none text-white" href="#">The Rise of AI-Powered Personal Assistants: How They Manage</a>
                                                    </h3>
                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                        <span>1min</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="position-cover"></a>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Tech Innovations Reshaping the Retail Landscape: AI Payments</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>55min</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-02.jpg" alt="Tech Innovations Reshaping the Retail Landscape: AI Payments" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Balancing Work and Wellness: Tech Solutions for Healthy</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>1h</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-03.jpg" alt="Balancing Work and Wellness: Tech Solutions for Healthy" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">The Importance of Sleep: Tips for Better Rest and Recovery</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>2h</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-04.jpg" alt="The Importance of Sleep: Tips for Better Rest and Recovery" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-4">
                            <div class="block-layout list-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                            <span>Business</span>
                                            <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                        </a>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 overflow-hidden uc-dark">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-4x3">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-05.jpg" alt="The Future of Sustainable Living: Driving Eco-Friendly Lifestyles" data-uc-img="loading: lazy">
                                                    </div>
                                                </div>
                                                <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
                                                <div class="post-header panel vstack justify-start items-start flex-column-reverse gap-1 p-2 position-cover text-white">
                                                    <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                                                        <div class="meta">
                                                            <div class="hstack gap-2">
                                                                <div>
                                                                    <div class="post-author hstack gap-1">
                                                                        <a href="page-author.html" data-uc-tooltip="Anna Luis"><img src="../assets/images/avatars/04.png" alt="Anna Luis" class="w-24px h-24px rounded-circle"></a>
                                                                        <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">Anna Luis</a>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                        <span>1</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="hstack gap-1"></div>
                                                        </div>
                                                    </div>
                                                    <h3 class="post-title h6 lg:h5 m-0 m-0 max-w-600px text-white text-truncate-2">
                                                        <a class="text-none text-white" href="#">The Future of Sustainable Living: Driving Eco-Friendly Lifestyles</a>
                                                    </h3>
                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                        <span>12h</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="position-cover"></a>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Business Agility the Digital Age: Leveraging AI and Automation</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>7d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-06.jpg" alt="Business Agility the Digital Age: Leveraging AI and Automation" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">The Art of Baking: From Classic Bread to Artisan Pastries</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>9d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-07.jpg" alt="The Art of Baking: From Classic Bread to Artisan Pastries" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">AI and Marketing: Unlocking Customer Insights</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>15d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-08.jpg" alt="AI and Marketing: Unlocking Customer Insights" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-4">
                            <div class="block-layout list-layout vstack gap-2 lg:gap-3 panel overflow-hidden">
                                <div class="block-header panel pt-1 border-top">
                                    <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">
                                        <a class="hstack d-inline-flex gap-0 text-none hover:text-primary duration-150" href="blog-category.html">
                                            <span>Arts & Entertainments</span>
                                            <i class="icon-1 fw-bold unicon-chevron-right"></i>
                                        </a>
                                    </h2>
                                </div>
                                <div class="block-content">
                                    <div class="row child-cols-12 g-2 lg:g-4 sep-x" data-uc-grid>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle vstack gap-2 lg:gap-3 overflow-hidden uc-dark">
                                                <div class="post-media panel overflow-hidden">
                                                    <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-4x3">
                                                        <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-09.jpg" alt="Hidden Gems: Underrated Travel Destinations Around the World" data-uc-img="loading: lazy">
                                                    </div>
                                                </div>
                                                <div class="position-cover bg-gradient-to-t from-black to-transparent opacity-90"></div>
                                                <div class="post-header panel vstack justify-start items-start flex-column-reverse gap-1 p-2 position-cover text-white">
                                                    <div class="post-meta panel hstack justify-between fs-7 text-white text-opacity-60 mt-1">
                                                        <div class="meta">
                                                            <div class="hstack gap-2">
                                                                <div>
                                                                    <div class="post-author hstack gap-1">
                                                                        <a href="page-author.html" data-uc-tooltip="David Peterson"><img src="../assets/images/avatars/01.png" alt="David Peterson" class="w-24px h-24px rounded-circle"></a>
                                                                        <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">David Peterson</a>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                        <span>15</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="actions">
                                                            <div class="hstack gap-1"></div>
                                                        </div>
                                                    </div>
                                                    <h3 class="post-title h6 lg:h5 m-0 m-0 max-w-600px text-white text-truncate-2">
                                                        <a class="text-none text-white" href="#">Hidden Gems: Underrated Travel Destinations Around the World</a>
                                                    </h3>
                                                    <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                        <span>23d</span>
                                                    </div>
                                                </div>
                                                <a href="#" class="position-cover"></a>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Eco-Tourism: Traveling Responsibly and Sustainably</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>29d</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-10.jpg" alt="Eco-Tourism: Traveling Responsibly and Sustainably" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">Solo Travel: Some Tips and Destinations for the Adventurous Explorer</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-11.jpg" alt="Solo Travel: Some Tips and Destinations for the Adventurous Explorer" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                        <div>
                                            <article class="post type-post panel uc-transition-toggle">
                                                <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                    <div>
                                                        <div class="post-header panel vstack justify-between gap-1">
                                                            <h3 class="post-title h6 m-0 text-truncate-2">
                                                                <a class="text-none hover:text-primary duration-150" href="#">AI-Powered Financial Planning: How Algorithms Revolutionizing</a>
                                                            </h3>
                                                            <div class="post-date hstack gap-narrow fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <span>2mo</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="post-media panel overflow-hidden max-w-72px min-w-72px">
                                                            <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-1x1">
                                                                <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-12.jpg" alt="AI-Powered Financial Planning: How Algorithms Revolutionizing" data-uc-img="loading: lazy">
                                                            </div>
                                                            <a href="#" class="position-cover"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section end -->

    <!-- Section start -->
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
                            <div class="md:col-8 lg:col-9">
                                <div class="panel overflow-hidden rounded">
                                    <div class="swiper swiper-main" data-uc-swiper="connect: .swiper-thumbs; items: 1; gap: 8; autoplay: 7000; parallax: true; fade: true; effect: fade; dots: .swiper-pagination; disable-class: last-slide;">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <article class="post type-post h-250px md:h-350px lg:h-500px bg-black uc-dark">
                                                    <div class="post-media panel overflow-hidden position-cover">
                                                        <div class="featured-video bg-gray-700 ratio ratio-3x2">
                                                            <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-01.webm" type="video/webm">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    </div>
                                                    <div class="position-cover bg-gradient-to-t from-black to-transparent z-1 opacity-80"></div>
                                                    <div class="post-header panel position-absolute bottom-0 vstack justify-between gap-2 xl:gap-4 max-300px lg:max-w-600px p-2 md:p-4 xl:p-6 z-1">
                                                        <h3 class="post-title h4 lg:h3 xl:h2 m-0 text-truncate-2" data-swiper-parallax-x="-8">
                                                            <a class="text-none" href="#">Balancing Work and Wellness: Tech Solutions for Healthy</a>
                                                        </h3>
                                                        <div data-swiper-parallax-x="8">
                                                            <div class="post-meta panel hstack justify-between fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <div class="meta">
                                                                    <div class="hstack gap-2">
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="page-author.html" data-uc-tooltip="Sarah Eddrissi"><img src="../assets/images/avatars/03.png" alt="Sarah Eddrissi" class="w-24px h-24px rounded-circle"></a>
                                                                                <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">Sarah Eddrissi</a>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="post-date hstack gap-narrow">
                                                                                <span>1h ago</span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                <i class="icon-narrow unicon-chat"></i>
                                                                                <span>0</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="hstack gap-1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="swiper-slide">
                                                <article class="post type-post h-250px md:h-350px lg:h-500px bg-black uc-dark">
                                                    <div class="post-media panel overflow-hidden position-cover">
                                                        <div class="featured-video bg-gray-700 ratio ratio-3x2">
                                                            <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-03.webm" type="video/webm">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    </div>
                                                    <div class="position-cover bg-gradient-to-t from-black to-transparent z-1 opacity-80"></div>
                                                    <div class="post-header panel position-absolute bottom-0 vstack justify-between gap-2 xl:gap-4 max-300px lg:max-w-600px p-2 md:p-4 xl:p-6 z-1">
                                                        <h3 class="post-title h4 lg:h3 xl:h2 m-0 text-truncate-2" data-swiper-parallax-x="-8">
                                                            <a class="text-none" href="#">Business Agility the Digital Age: Leveraging AI and Automation</a>
                                                        </h3>
                                                        <div data-swiper-parallax-x="8">
                                                            <div class="post-meta panel hstack justify-between fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <div class="meta">
                                                                    <div class="hstack gap-2">
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="page-author.html" data-uc-tooltip="Nisi Nyung"><img src="../assets/images/avatars/08.png" alt="Nisi Nyung" class="w-24px h-24px rounded-circle"></a>
                                                                                <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">Nisi Nyung</a>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="post-date hstack gap-narrow">
                                                                                <span>7d ago</span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                <i class="icon-narrow unicon-chat"></i>
                                                                                <span>23</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="hstack gap-1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="swiper-slide">
                                                <article class="post type-post h-250px md:h-350px lg:h-500px bg-black uc-dark">
                                                    <div class="post-media panel overflow-hidden position-cover">
                                                        <div class="featured-video bg-gray-700 ratio ratio-3x2">
                                                            <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-04.webm" type="video/webm">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    </div>
                                                    <div class="position-cover bg-gradient-to-t from-black to-transparent z-1 opacity-80"></div>
                                                    <div class="post-header panel position-absolute bottom-0 vstack justify-between gap-2 xl:gap-4 max-300px lg:max-w-600px p-2 md:p-4 xl:p-6 z-1">
                                                        <h3 class="post-title h4 lg:h3 xl:h2 m-0 text-truncate-2" data-swiper-parallax-x="-8">
                                                            <a class="text-none" href="#">The Art of Baking: From Classic Bread to Artisan Pastries</a>
                                                        </h3>
                                                        <div data-swiper-parallax-x="8">
                                                            <div class="post-meta panel hstack justify-between fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <div class="meta">
                                                                    <div class="hstack gap-2">
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="page-author.html" data-uc-tooltip="Nisi Nyung"><img src="../assets/images/avatars/08.png" alt="Nisi Nyung" class="w-24px h-24px rounded-circle"></a>
                                                                                <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">Nisi Nyung</a>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="post-date hstack gap-narrow">
                                                                                <span>9d ago</span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                <i class="icon-narrow unicon-chat"></i>
                                                                                <span>112</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="hstack gap-1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="swiper-slide">
                                                <article class="post type-post h-250px md:h-350px lg:h-500px bg-black uc-dark">
                                                    <div class="post-media panel overflow-hidden position-cover">
                                                        <div class="featured-video bg-gray-700 ratio ratio-3x2">
                                                            <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-05.webm" type="video/webm">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        </div>
                                                    </div>
                                                    <div class="position-cover bg-gradient-to-t from-black to-transparent z-1 opacity-80"></div>
                                                    <div class="post-header panel position-absolute bottom-0 vstack justify-between gap-2 xl:gap-4 max-300px lg:max-w-600px p-2 md:p-4 xl:p-6 z-1">
                                                        <h3 class="post-title h4 lg:h3 xl:h2 m-0 text-truncate-2" data-swiper-parallax-x="-8">
                                                            <a class="text-none" href="#">AI-Powered Financial Planning: How Algorithms Revolutionizing</a>
                                                        </h3>
                                                        <div data-swiper-parallax-x="8">
                                                            <div class="post-meta panel hstack justify-between fs-7 fw-medium text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                <div class="meta">
                                                                    <div class="hstack gap-2">
                                                                        <div>
                                                                            <div class="post-author hstack gap-1">
                                                                                <a href="page-author.html" data-uc-tooltip="Sarah Eddrissi"><img src="../assets/images/avatars/03.png" alt="Sarah Eddrissi" class="w-24px h-24px rounded-circle"></a>
                                                                                <a href="page-author.html" class="text-black dark:text-white text-none fw-bold">Sarah Eddrissi</a>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <div class="post-date hstack gap-narrow">
                                                                                <span>2mo ago</span>
                                                                            </div>
                                                                        </div>
                                                                        <div>
                                                                            <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                <i class="icon-narrow unicon-chat"></i>
                                                                                <span>2</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="actions">
                                                                    <div class="hstack gap-1"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>

                                        <!-- Add Pagination -->
                                        <div class="swiper-pagination top-auto start-auto bottom-0 end-0 m-2 md:m-4 xl:m-6 text-white d-none md:d-inline-flex justify-end w-auto"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="md:col-4 lg:col-3">
                                <div class="panel md:vstack gap-1 h-100">

                                    <!-- Slides thumbs -->
                                    <div
                                        class="swiper swiper-thumbs swiper-thumbs-progress rounded order-2"
                                        data-uc-swiper="items: 2;
                    gap: 4;
                    disable-class: last-slide;"
                                        data-uc-swiper-s="items: auto;
                    direction: vertical;
                    autoHeight: true;
                    mousewheel: true;
                    freeMode: false;
                    watchSlidesVisibility: true;
                    watchSlidesProgress: true;
                    watchOverflow: true"
                                    >
                                        <div class="swiper-wrapper md:flex-1">
                                            <div class="swiper-slide overflow-hidden rounded min-h-64px lg:min-h-100px">
                                                <div class="swiper-slide-progress position-cover z-0">
                                                    <span></span>
                                                </div>
                                                <article class="post type-post panel uc-transition-toggle p-1 z-1">
                                                    <div class="row gx-1">
                                                        <div class="col-auto post-media-wrap">
                                                            <div class="post-media panel overflow-hidden w-40px lg:w-64px rounded">
                                                                <div class="featured-video bg-gray-700 ratio ratio-3x4">
                                                                    <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                        <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-01.webm" type="video/webm">
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
                                                            <p class="fs-6 m-0 text-truncate-2 text-gray-900 dark:text-white">Balancing Work and Wellness: Tech Solutions for Healthy</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="swiper-slide overflow-hidden rounded min-h-64px lg:min-h-100px">
                                                <div class="swiper-slide-progress position-cover z-0">
                                                    <span></span>
                                                </div>
                                                <article class="post type-post panel uc-transition-toggle p-1 z-1">
                                                    <div class="row gx-1">
                                                        <div class="col-auto post-media-wrap">
                                                            <div class="post-media panel overflow-hidden w-40px lg:w-64px rounded">
                                                                <div class="featured-video bg-gray-700 ratio ratio-3x4">
                                                                    <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                        <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-03.webm" type="video/webm">
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
                                                            <p class="fs-6 m-0 text-truncate-2 text-gray-900 dark:text-white">Business Agility the Digital Age: Leveraging AI and Automation</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="swiper-slide overflow-hidden rounded min-h-64px lg:min-h-100px">
                                                <div class="swiper-slide-progress position-cover z-0">
                                                    <span></span>
                                                </div>
                                                <article class="post type-post panel uc-transition-toggle p-1 z-1">
                                                    <div class="row gx-1">
                                                        <div class="col-auto post-media-wrap">
                                                            <div class="post-media panel overflow-hidden w-40px lg:w-64px rounded">
                                                                <div class="featured-video bg-gray-700 ratio ratio-3x4">
                                                                    <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                        <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-04.webm" type="video/webm">
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
                                                            <p class="fs-6 m-0 text-truncate-2 text-gray-900 dark:text-white">The Art of Baking: From Classic Bread to Artisan Pastries</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div class="swiper-slide overflow-hidden rounded min-h-64px lg:min-h-100px">
                                                <div class="swiper-slide-progress position-cover z-0">
                                                    <span></span>
                                                </div>
                                                <article class="post type-post panel uc-transition-toggle p-1 z-1">
                                                    <div class="row gx-1">
                                                        <div class="col-auto post-media-wrap">
                                                            <div class="post-media panel overflow-hidden w-40px lg:w-64px rounded">
                                                                <div class="featured-video bg-gray-700 ratio ratio-3x4">
                                                                    <video class="video-cover video-lazyload min-h-100px" preload="none" loop playsinline>
                                                                        <source src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-two/videos/vid-05.webm" type="video/webm">
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
                                                            <p class="fs-6 m-0 text-truncate-2 text-gray-900 dark:text-white">AI-Powered Financial Planning: How Algorithms Revolutionizing</p>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tablet, Desktop and big screens nav -->
                                    <div class="swiper-prev btn btn-2xs lg:btn-xs btn-primary w-100 d-none md:d-flex order-1">Prev</div>
                                    <div class="swiper-next btn btn-2xs lg:btn-xs btn-primary w-100 d-none md:d-flex order-3">Next</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section end -->

    <!-- Section start -->
    <div id="latest_news" class="latest-news section panel">
        <div class="section-outer panel py-4 lg:py-6">
            <div class="container max-w-xl">
                <div class="section-inner">
                    <div class="content-wrap row child-cols-12 g-4 lg:g-6" data-uc-grid>
                        <div class="md:col-9">
                            <div class="main-wrap panel vstack gap-3 lg:gap-6">
                                <div class="block-layout grid-layout vstack gap-2 panel overflow-hidden">
                                    <div class="block-header panel pt-1 border-top">
                                        <h2 class="h6 ft-tertiary fw-bold ls-0 text-uppercase m-0 text-black dark:text-white">Latest</h2>
                                    </div>
                                    <div class="block-content">
                                        <div class="row child-cols-12 g-2 lg:g-4 sep-x">
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-01.jpg" alt="The Rise of AI-Powered Personal Assistants: How They Manage" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">The Rise of AI-Powered Personal Assistants: How They Manage</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">Law enforcement officers have been accused of sexually abusing children over the past two decades, a Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-02.jpg" alt="Tech Innovations Reshaping the Retail Landscape: AI Payments" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">Tech Innovations Reshaping the Retail Landscape: AI Payments</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">Officers have been accused of sexually abusing children over the past two decades, a Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-03.jpg" alt="Balancing Work and Wellness: Tech Solutions for Healthy" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">Balancing Work and Wellness: Tech Solutions for Healthy</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">Children over the past two decades, a Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-04.jpg" alt="The Importance of Sleep: Tips for Better Rest and Recovery" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">The Importance of Sleep: Tips for Better Rest and Recovery</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">Post investigation found. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-05.jpg" alt="The Future of Sustainable Living: Driving Eco-Friendly Lifestyles" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">The Future of Sustainable Living: Driving Eco-Friendly Lifestyles</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-06.jpg" alt="Business Agility the Digital Age: Leveraging AI and Automation" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">Business Agility the Digital Age: Leveraging AI and Automation</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-07.jpg" alt="The Art of Baking: From Classic Bread to Artisan Pastries" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">The Art of Baking: From Classic Bread to Artisan Pastries</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-08.jpg" alt="AI and Marketing: Unlocking Customer Insights" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">AI and Marketing: Unlocking Customer Insights</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-09.jpg" alt="Hidden Gems: Underrated Travel Destinations Around the World" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">Hidden Gems: Underrated Travel Destinations Around the World</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-10.jpg" alt="Eco-Tourism: Traveling Responsibly and Sustainably" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">Eco-Tourism: Traveling Responsibly and Sustainably</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-11.jpg" alt="Solo Travel: Some Tips and Destinations for the Adventurous Explorer" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">Solo Travel: Some Tips and Destinations for the Adventurous Explorer</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div class="col-auto">
                                                            <div class="post-media panel overflow-hidden max-w-150px min-w-100px lg:min-w-250px">
                                                                <div class="featured-image bg-gray-25 dark:bg-gray-800 ratio ratio-3x2">
                                                                    <img class="media-cover image uc-transition-scale-up uc-transition-opaque" src="../assets/images/common/img-fallback.png" data-src="../assets/images/demo-seven/posts/img-12.jpg" alt="AI-Powered Financial Planning: How Algorithms Revolutionizing" data-uc-img="loading: lazy">
                                                                </div>
                                                                <a href="#" class="position-cover"></a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="post-header panel vstack justify-between gap-1">
                                                                <h3 class="post-title h5 lg:h4 m-0 text-truncate-2">
                                                                    <a class="text-none hover:text-primary duration-150" href="#">AI-Powered Financial Planning: How Algorithms Revolutionizing</a>
                                                                </h3>
                                                            </div>
                                                            <p class="post-excrept ft-tertiary fs-6 text-gray-900 dark:text-white text-opacity-60 text-truncate-2 my-1">To spread the word, the company embarked on a mass marketing drive. TV campaigns launched in the platform’s key markets. Nisi dignissim tortor sed quam sed ipsum ut. Dolor sit amet, consectetur adipiscing elit.</p>
                                                            <div class="post-link">
                                                                <a href="#" class="link fs-7 fw-bold text-uppercase text-none mt-1 pb-narrow p-0 border-bottom dark:text-white">
                                                                    <span>Read more</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block-footer cstack lg:mt-2">
                                        <a href="#" class="animate-btn gap-0 btn btn-sm btn-alt-primary bg-transparent text-black dark:text-white border w-100">
                                            <span>Load more posts</span>
                                            <i class="icon icon-1 unicon-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-3">
                            <div class="sidebar-wrap panel vstack gap-2 pb-2" data-uc-sticky="end: .content-wrap; offset: 150; media: @m;">
                                <div class="widget ad-widget vstack gap-2 text-center p-2 border">
                                    <div class="widgt-content">
                                        <a class="cstack max-w-300px mx-auto text-none" href="https://themeforest.net/user/reacthemes/portfolio" target="_blank" rel="nofollow">
                                            <img class="d-block dark:d-none" src="../assets/images/common/ad-slot-aside.jpg" alt="Ad slot">
                                            <img class="d-none dark:d-block" src="../assets/images/common/ad-slot-aside-2.jpg" alt="Ad slot">
                                        </a>
                                    </div>
                                </div>
                                <div class="widget popular-widget vstack gap-2 p-2 border">
                                    <div class="widget-title text-center">
                                        <h5 class="fs-7 ft-tertiary text-uppercase m-0">Popular now</h5>
                                    </div>
                                    <div class="widget-content">
                                        <div class="row child-cols-12 gx-4 gy-3 sep-x" data-uc-grid>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div>
                                                            <div class="hstack items-start gap-3">
                                                                <span class="h3 lg:h2 ft-tertiary fst-italic text-center text-primary m-0 min-w-24px">1</span>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Virtual Reality and Mental Health: Exploring the Therapeutic</a>
                                                                    </h3>
                                                                    <div class="post-meta panel hstack justify-between fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <div class="meta">
                                                                            <div class="hstack gap-2">
                                                                                <div>
                                                                                    <div class="post-date hstack gap-narrow">
                                                                                        <span>2mo ago</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                                        <span>290</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="actions">
                                                                            <div class="hstack gap-1"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div>
                                                            <div class="hstack items-start gap-3">
                                                                <span class="h3 lg:h2 ft-tertiary fst-italic text-center text-primary m-0 min-w-24px">2</span>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">The Future of Sustainable Living: Driving Eco-Friendly Lifestyles</a>
                                                                    </h3>
                                                                    <div class="post-meta panel hstack justify-between fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <div class="meta">
                                                                            <div class="hstack gap-2">
                                                                                <div>
                                                                                    <div class="post-date hstack gap-narrow">
                                                                                        <span>2mo ago</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                                        <span>1</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="actions">
                                                                            <div class="hstack gap-1"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div>
                                                            <div class="hstack items-start gap-3">
                                                                <span class="h3 lg:h2 ft-tertiary fst-italic text-center text-primary m-0 min-w-24px">3</span>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">Smart Homes, Smarter Living: Exploring IoT and AI</a>
                                                                    </h3>
                                                                    <div class="post-meta panel hstack justify-between fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <div class="meta">
                                                                            <div class="hstack gap-2">
                                                                                <div>
                                                                                    <div class="post-date hstack gap-narrow">
                                                                                        <span>23d ago</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                                        <span>15</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="actions">
                                                                            <div class="hstack gap-1"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                            <div>
                                                <article class="post type-post panel uc-transition-toggle">
                                                    <div class="row child-cols g-2 lg:g-3" data-uc-grid>
                                                        <div>
                                                            <div class="hstack items-start gap-3">
                                                                <span class="h3 lg:h2 ft-tertiary fst-italic text-center text-primary m-0 min-w-24px">4</span>
                                                                <div class="post-header panel vstack justify-between gap-1">
                                                                    <h3 class="post-title h6 m-0">
                                                                        <a class="text-none hover:text-primary duration-150" href="#">How Businesses Are Adapting to E-Commerce and AI Integration</a>
                                                                    </h3>
                                                                    <div class="post-meta panel hstack justify-between fs-7 text-gray-900 dark:text-white text-opacity-60 d-none md:d-flex">
                                                                        <div class="meta">
                                                                            <div class="hstack gap-2">
                                                                                <div>
                                                                                    <div class="post-date hstack gap-narrow">
                                                                                        <span>29d ago</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="#post_comment" class="post-comments text-none hstack gap-narrow">
                                                                                        <i class="icon-narrow unicon-chat"></i>
                                                                                        <span>20</span>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="actions">
                                                                            <div class="hstack gap-1"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget social-widget vstack gap-2 text-center p-2 border">
                                    <div class="widgt-title">
                                        <h4 class="fs-7 ft-tertiary text-uppercase m-0">Follow @News5</h4>
                                    </div>
                                    <div class="widgt-content">
                                        <form class="vstack gap-1">
                                            <input class="form-control form-control-sm fs-6 fw-medium h-40px w-full bg-white dark:bg-gray-800 dark:bg-gray-800 dark:border-white dark:border-opacity-15 dark:border-opacity-15" type="email" placeholder="Your email" required="">
                                            <button class="btn btn-sm btn-primary" type="submit">Sign up</button>
                                        </form>
                                        <ul class="nav-x justify-center gap-1 mt-3">
                                            <li>
                                                <a href="#fb" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a href="#x" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-x-filled"></i></a>
                                            </li>
                                            <li>
                                                <a href="#in" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-instagram"></i></a>
                                            </li>
                                            <li>
                                                <a href="#yt" class="cstack w-32px h-32px border rounded-circle hover:text-black dark:hover:text-white hover:scale-110 transition-all duration-150"><i class="icon icon-1 unicon-logo-youtube"></i></a>
                                            </li>
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

    <!-- Section end -->
</div>

<!-- Wrapper end -->

<!-- Footer start -->
<footer id="uc-footer" class="uc-footer panel uc-dark">
    <div class="footer-outer py-4 lg:py-6 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-opacity-50">
        <div class="container max-w-xl">
            <div class="footer-inner vstack gap-6 xl:gap-8">
                <div class="uc-footer-bottom panel vstack gap-4 justify-center lg:fs-5">
                    <nav class="footer-nav">
                        <ul class="nav-x gap-2 lg:gap-4 justify-center text-center text-uppercase fw-medium">
                            <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">Politics</a></li>
                            <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">Opinions</a></li>
                            <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">World</a></li>
                            <li><a class="hover:text-gray-900 dark:hover:text-white duration-150" href="blog-category.html">Media</a></li>
                        </ul>
                    </nav>
                    <div class="footer-social hstack justify-center gap-2 lg:gap-3">
                        <ul class="nav-x gap-2">
                            <li>
                                <a class="hover:text-gray-900 dark:hover:text-white duration-150" href="#ln"><i class="icon icon-2 unicon-logo-linkedin"></i></a>
                            </li>
                            <li>
                                <a class="hover:text-gray-900 dark:hover:text-white duration-150" href="#fb"><i class="icon icon-2 unicon-logo-facebook"></i></a>
                            </li>
                            <li>
                                <a class="hover:text-gray-900 dark:hover:text-white duration-150" href="#x"><i class="icon icon-2 unicon-logo-x-filled"></i></a>
                            </li>
                            <li>
                                <a class="hover:text-gray-900 dark:hover:text-white duration-150" href="#in"><i class="icon icon-2 unicon-logo-instagram"></i></a>
                            </li>
                            <li>
                                <a class="hover:text-gray-900 dark:hover:text-white duration-150" href="#yt"><i class="icon icon-2 unicon-logo-youtube"></i></a>
                            </li>
                        </ul>
                        <div class="vr"></div>
                        <div class="d-inline-block">
                            <a href="#" class="hstack gap-1 text-none fw-medium">
                                <i class="icon icon-1 unicon-earth-filled"></i>
                                <span>English</span>
                                <span data-uc-drop-parent-icon=""></span>
                            </a>
                            <div class="p-2 bg-white dark:bg-gray-800 shadow-xs w-150px" data-uc-drop="mode: click; boundary: !.uc-footer-bottom; animation: uc-animation-slide-top-small; duration: 150;">
                                <ul class="nav-y gap-1 fw-medium items-end">
                                    <li><a href="#en">English</a></li>
                                    <li><a href="#ar">العربية</a></li>
                                    <li><a href="#ch">中文</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright vstack sm:hstack justify-center items-center gap-1 lg:gap-2">
                        <p>News5 © 2024, All rights reserved.</p>
                        <ul class="nav-x gap-2 fw-medium">
                            <li><a class="uc-link text-underline hover:text-gray-900 dark:hover:text-white duration-150" href="page-privacy.html">Privacy notice</a></li>
                            <li><a class="uc-link text-underline hover:text-gray-900 dark:hover:text-white duration-150" href="page-terms.html">Terms of condition</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

@endsection
