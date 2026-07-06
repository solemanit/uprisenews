{{-- resources/views/backend/ads/edit.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Edit Ad')
@section('page_title', 'Edit Ad')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('backend.ads.index') }}">Ads</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form method="POST" action="{{ route('backend.ads.update', $ad) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('backend.ads._form')
</form>
@endsection
