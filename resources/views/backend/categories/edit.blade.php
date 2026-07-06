{{-- resources/views/backend/categories/edit.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Edit: ' . $category->name)
@section('page_title', 'Edit Category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('backend.categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-outline card-warning">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil me-1"></i> Edit: <strong>{{ $category->name }}</strong>
                </h3>
            </div>

            <form action="{{ route('backend.categories.update', $category) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf
                @method('PUT')

                <div class="card-body">
                    @include('backend.categories._form', compact('category'))
                </div>

                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="{{ route('backend.categories.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i> Update Category
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
