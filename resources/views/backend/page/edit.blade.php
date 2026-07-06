{{-- resources/views/backend/page/edit.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Edit Page')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title">Edit Page: {{ $page->title }}</h3></div>
    <form action="{{ route('backend.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('backend.page.partials.form', ['page' => $page])
    </form>
</div>
@endsection
