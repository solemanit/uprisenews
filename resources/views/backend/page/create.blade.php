{{-- resources/views/backend/page/create.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Add Page')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title">Add New Page</h3></div>
    <form action="{{ route('backend.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.page.partials.form', ['page' => null])
    </form>
</div>
@endsection
