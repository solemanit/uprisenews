{{-- resources/views/backend/articles/create.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Add Article')
@section('page_title', 'Add Article')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('backend.articles.index') }}">Articles</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-outline card-primary">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-1"></i> New Article
                </h3>
            </div>

            <form action="{{ route('backend.articles.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf

                <div class="card-body">
                    @include('backend.articles._form', ['article' => null])
                </div>

                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="{{ route('backend.articles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-check-lg me-1"></i> Save Article
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
