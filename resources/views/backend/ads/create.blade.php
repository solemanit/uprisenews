{{-- resources/views/backend/ads/create.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Add Ad')
@section('page_title', 'Add Ad')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('backend.ads.index') }}">Ads</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
<form method="POST" action="{{ route('backend.ads.store') }}" enctype="multipart/form-data">
    @include('backend.ads._form')
</form>
@endsection
