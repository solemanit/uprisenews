{{-- resources/views/backend/articles/show.blade.php --}}
@extends('backend.layouts.app')

@section('title', $article->title)
@section('page_title', 'Article Preview')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('backend.articles.index') }}">Articles</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Preview</li>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card card-outline card-info">

            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">
                    <i class="bi bi-eye me-1"></i> Preview
                </h3>
                <a href="{{ route('backend.articles.edit', $article) }}" class="btn btn-warning btn-sm">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
            </div>

            <div class="card-body">

                {{-- Badges --}}
                <div class="mb-3 d-flex gap-2 flex-wrap">
                    <span class="badge bg-{{ $article->status_badge }} fs-6">
                        {{ ucfirst($article->status) }}
                    </span>
                    @if($article->is_breaking)
                        <span class="badge bg-danger">
                            <i class="bi bi-lightning-fill me-1"></i> Breaking
                        </span>
                    @endif
                    @if($article->is_featured)
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-star-fill me-1"></i> Featured
                        </span>
                    @endif
                </div>

                {{-- Featured image --}}
                @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}"
                         class="img-fluid rounded mb-3 w-100"
                         style="max-height:320px;object-fit:cover;"
                         alt="{{ $article->title }}">
                @endif

                <h2 class="mb-1">{{ $article->title }}</h2>
                <p class="text-muted small mb-3">
                    By <strong>{{ $article->author->name }}</strong>
                    &bull; {{ $article->category?->name ?? 'Uncategorized' }}
                    &bull; {{ $article->published_at?->format('d M Y, H:i') ?? 'Not published' }}
                    &bull; <i class="bi bi-eye"></i> {{ number_format($article->views_count) }} views
                </p>

                @if($article->excerpt)
                    <blockquote class="blockquote border-start border-4 border-primary ps-3 text-muted fst-italic mb-3">
                        {{ $article->excerpt }}
                    </blockquote>
                @endif

                <hr>

                <div class="article-body lh-lg">
                    {!! nl2br(e($article->body)) !!}
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
