@extends('frontend.layouts.app')

@section('title', __('Home') . ' — ' . config('app.name'))

@section('content')

@include('frontend.home.partials.hero-news')
@include('frontend.home.partials.news-part1')
@include('frontend.home.partials.news-part2')
@include('frontend.home.partials.news-part3')
@include('frontend.home.partials.news-part4')
@include('frontend.home.partials.news-part5')

@endsection
