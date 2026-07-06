{{-- resources/views/backend/categories/create.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Add Category')
@section('page_title', 'Add Category')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('backend.categories.index') }}">Categories</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Add</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card card-outline card-primary">

            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle me-1"></i> New Category
                </h3>
            </div>

            <form action="{{ route('backend.categories.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  novalidate>
                @csrf

                <div class="card-body">
                    @include('backend.categories._form', ['category' => null])
                </div>

                <div class="card-footer bg-white d-flex justify-content-end gap-2">
                    <a href="{{ route('backend.categories.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-lg me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-check-lg me-1"></i> Save Category
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
