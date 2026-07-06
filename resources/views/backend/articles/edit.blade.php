{{-- resources/views/backend/articles/edit.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Edit: ' . $article->title)
@section('page_title', 'Edit Article')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('backend.articles.index') }}">Articles</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card card-outline card-warning">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil me-1"></i> Edit: <strong>{{ Str::limit($article->title, 50) }}</strong>
                </h3>
            </div>

            <form action="{{ route('backend.articles.update', $article) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    @include('backend.articles._form', compact('article'))
                </div>

                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="{{ route('backend.articles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i> Update Article
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
