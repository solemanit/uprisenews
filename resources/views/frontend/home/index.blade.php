{{-- src: resources/views/frontend/home/index.blade.php --}}
@extends('frontend.layouts.app')

@section('title', __('Home') . ' — ' . config('app.name'))

@section('content')

@include('frontend.home.partials.hero-news')
@include('frontend.home.partials.letest-news')
{{-- Ads Header 1 --}}
<img src="{{ asset('assets/frontend/images/ads/ads-1.gif') }}" alt="Advertisement" class="img-fluid d-block m-auto" loading="lazy">

@include('frontend.home.partials.politics-news')

{{-- Ads Header 2 --}}
<img src="{{ asset('assets/frontend/images/ads/ads-2.gif') }}" alt="Advertisement" class="img-fluid d-block m-auto" loading="lazy">
@include('frontend.home.partials.news-national-economy')
{{-- @include('frontend.home.partials.news-part1') --}}
{{-- @include('frontend.home.partials.news-part2') --}}
{{-- @include('frontend.home.partials.news-part3')
@include('frontend.home.partials.news-part4')
@include('frontend.home.partials.news-part5') --}}

@endsection
