{{-- resources/views/backend/dashboard.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@push('styles')
<style>
    .stat-card { border: 0; border-radius: .75rem; overflow: hidden; }
    .stat-card .stat-icon {
        width: 52px; height: 52px; border-radius: .75rem;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; color: #fff;
    }
    .stat-card .stat-value { font-size: 1.6rem; font-weight: 700; line-height: 1; }
    .stat-card .stat-label { font-size: .8rem; color: #6c757d; }
    .bg-icon-primary { background: #0d6efd; }
    .bg-icon-success { background: #198754; }
    .bg-icon-warning { background: #ffc107; }
    .bg-icon-info    { background: #0dcaf0; }
    .bg-icon-danger  { background: #dc3545; }
    .bg-icon-secondary { background: #6c757d; }
    .table-sm-tight td, .table-sm-tight th { padding: .5rem .75rem; vertical-align: middle; }
</style>
@endpush

@section('content')

{{-- ── Summary Cards ─────────────────────────────────────────────────────── --}}
<div class="row g-3 mb-3">

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-icon-primary"><i class="bi bi-newspaper"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($stats['articles_total']) }}</div>
                    <div class="stat-label">Total Articles</div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 small text-muted">
                {{ $stats['articles_published'] }} published &middot; {{ $stats['articles_draft'] }} draft
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-icon-success"><i class="bi bi-folder2-open"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($stats['categories_total']) }}</div>
                    <div class="stat-label">Categories</div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 small text-muted">
                {{ $stats['categories_active'] }} active
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-icon-warning"><i class="bi bi-megaphone"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($stats['ads_running']) }}</div>
                    <div class="stat-label">Ads Running Now</div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 small text-muted">
                {{ number_format($stats['ads_clicks']) }} clicks total
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-icon-info"><i class="bi bi-eye"></i></div>
                <div>
                    <div class="stat-value">{{ number_format($stats['ads_impressions']) }}</div>
                    <div class="stat-label">Ad Impressions</div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 pt-0 small text-muted">
                {{ $stats['articles_today'] }} new articles today
            </div>
        </div>
    </div>

</div>

<div class="row g-3">

    {{-- ── Articles Trend Chart ──────────────────────────────────────────── --}}
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Articles Published — Last 14 Days</h6>
            </div>
            <div class="card-body">
                <canvas id="articlesChart" height="110"></canvas>
            </div>
        </div>

        {{-- ── Recent Articles ──────────────────────────────────────────────── --}}
        <div class="card shadow-sm mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Recent Articles</h6>
                <a href="{{ route('backend.articles.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
            </div>
            <div class="table-responsive">
                <table class="table table-sm-tight table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentArticles as $article)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ Str::limit($article->title, 45) }}</span>
                                </td>
                                <td>{{ $article->category?->name ?? '—' }}</td>
                                <td>{{ $article->author?->name ?? '—' }}</td>
                                <td>
                                    <span class="badge text-bg-{{ $article->status_badge }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    {{ ($article->published_at ?? $article->created_at)->format('M d, Y') }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('backend.articles.edit', $article) }}"
                                       class="btn btn-sm btn-light">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No articles yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── Side Column ───────────────────────────────────────────────────── --}}
    <div class="col-lg-4">

        {{-- Top Categories --}}
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0">Top Categories</h6>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($topCategories as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->name }}
                        <span class="badge text-bg-primary rounded-pill">{{ $category->articles_count }}</span>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center">No categories yet.</li>
                @endforelse
            </ul>
        </div>

        {{-- Running Ads --}}
        <div class="card shadow-sm mt-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Live Ads</h6>
                <a href="{{ route('backend.ads.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($runningAds as $ad)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span class="fw-semibold">{{ Str::limit($ad->title, 25) }}</span>
                            <span class="badge text-bg-secondary">{{ $ad->slot }}</span>
                        </div>
                        <div class="small text-muted mt-1">
                            {{ number_format($ad->clicks_count) }} clicks &middot;
                            {{ number_format($ad->impressions_count) }} views
                            @if($ad->ends_at)
                                &middot; ends {{ $ad->ends_at->diffForHumans() }}
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center">No ads running right now.</li>
                @endforelse
            </ul>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js" crossorigin="anonymous"></script>
<script>
    const ctx = document.getElementById('articlesChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chart['labels']),
            datasets: [{
                label: 'Articles',
                data: @json($chart['data']),
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.1)',
                fill: true,
                tension: 0.35,
                pointRadius: 3,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { precision: 0 } }
            }
        }
    });
</script>
@endpush
