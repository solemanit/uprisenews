{{-- resources/views/backend/articles/index.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Articles')
@section('page_title', 'Articles')

@section('content')

{{-- ── Flash messages ─────────────────────────────────────────── --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">

    {{-- ── Card header ────────────────────────────────────────────── --}}
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title mb-0 text-truncate">
            <i class="bi bi-newspaper me-1"></i> All Articles
        </h3>
        <a href="{{ route('backend.articles.create') }}" class="btn btn-dark btn-sm ms-auto flex-shrink-0">
            <i class="bi bi-plus-lg me-1"></i> Add Article
        </a>
    </div>

    {{-- ── Filters ─────────────────────────────────────────────────── --}}
    <div class="card-body border-bottom pb-3 pt-3">
        <form method="GET" action="{{ route('backend.articles.index') }}" id="filterForm">
            <div class="row g-2 align-items-end">
                <div class="col-sm-5 col-md-4">
                    <input type="text"
                           name="search"
                           class="form-control form-control-sm"
                           placeholder="Search by title…"
                           value="{{ request('search') }}">
                </div>
                <div class="col-sm-3 col-md-2">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Statuses</option>
                        <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived"  {{ request('status') === 'archived'  ? 'selected' : '' }}>Archived</option>
                    </select>
                </div>
                <div class="col-sm-3 col-md-2">
                    <select name="category_id" class="form-select form-select-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto d-flex gap-2">
                    <button type="submit" class="btn btn-sm btn-dark">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('backend.articles.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-x-lg"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- ── Bulk action bar (hidden until rows selected) ───────────── --}}
    <div class="card-body border-bottom py-2 px-3" id="bulkBar" style="display:none; background:#fff3cd;">
        <div class="d-flex align-items-center gap-3">
            <span class="fw-semibold text-warning-emphasis small" id="bulkCount">0 selected</span>

            <form method="POST"
                  action="{{ route('backend.articles.bulk-destroy') }}"
                  id="bulkDeleteForm">
                @csrf
                @method('DELETE')
                <div id="bulkIdsContainer"></div>
                <button type="button"
                        id="bulkDeleteBtn"
                        class="btn btn-sm btn-danger">
                    <i class="bi bi-trash me-1"></i> Delete Selected
                </button>
            </form>

            <button type="button" class="btn btn-sm btn-outline-secondary ms-auto" id="clearSelectionBtn">
                <i class="bi bi-x-lg me-1"></i> Clear Selection
            </button>
        </div>
    </div>

    {{-- ── Table ──────────────────────────────────────────────────── --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0" id="articlesTable">
                <thead class="table-light">
                    <tr>
                        <th style="width:44px; padding-left:1rem;">
                            <input type="checkbox" id="selectAll" title="Select all on this page"
                                   class="form-check-input">
                        </th>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th style="width:110px">Status</th>
                        <th style="width:120px">Published</th>
                        <th style="width:80px" class="text-end">Views</th>
                        <th style="width:120px" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr class="article-row" data-id="{{ $article->id }}">
                        <td style="padding-left:1rem;">
                            <input type="checkbox"
                                   class="form-check-input row-check"
                                   value="{{ $article->id }}"
                                   aria-label="Select {{ $article->title }}">
                        </td>
                        <td class="text-muted small">{{ $article->id }}</td>
                        <td>
                            <div class="fw-semibold">
                                <a href="{{ route('backend.articles.show', $article) }}"
                                   class="text-dark text-decoration-none stretched-link-text">
                                    {{ Str::limit($article->title, 55) }}
                                </a>
                            </div>
                            <div class="small text-muted font-monospace">
                                /article/{{ $article->slug }}
                            </div>
                            @if($article->is_featured || $article->is_breaking)
                                <div class="mt-1 d-flex gap-1">
                                    @if($article->is_breaking)
                                        <span class="badge bg-danger" style="font-size:.65rem;">
                                            <i class="bi bi-lightning-fill"></i> Breaking
                                        </span>
                                    @endif
                                    @if($article->is_featured)
                                        <span class="badge bg-warning text-dark" style="font-size:.65rem;">
                                            <i class="bi bi-star-fill"></i> Featured
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($article->category)
                                <span class="badge bg-light text-dark border">{{ $article->category->name }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="small">{{ $article->author->name }}</td>
                        <td>
                            @php
                                $badgeClass = match($article->status) {
                                    'published' => 'bg-success',
                                    'archived'  => 'bg-secondary',
                                    default     => 'bg-warning text-dark',
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($article->status) }}</span>
                        </td>
                        <td class="small text-muted">
                            {{ $article->published_at?->format('d M Y') ?? '—' }}
                        </td>
                        <td class="text-end small text-muted">
                            {{ number_format($article->views_count) }}
                        </td>
                        <td class="text-center" style="white-space:nowrap;">
                            <div class="btn-group" role="group">
                                <a href="{{ route('backend.articles.edit', $article) }}"
                                class="btn btn-sm btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger btn-delete"
                                        title="Delete"
                                        data-id="{{ $article->id }}"
                                        data-name="{{ $article->title }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-{{ $article->id }}"
                                action="{{ route('backend.articles.destroy', $article) }}"
                                method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No articles found.
                            <div class="mt-2">
                                <a href="{{ route('backend.articles.create') }}" class="btn btn-sm btn-dark">
                                    <i class="bi bi-plus-lg me-1"></i> Add First Article
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── Pagination ──────────────────────────────────────────────── --}}
        @if($articles->hasPages())
        <div class="card-footer clearfix">
            <span class="text-muted small float-start">
                Showing {{ $articles->firstItem() }}–{{ $articles->lastItem() }}
                of {{ $articles->total() }} articles
            </span>

            <ul class="pagination pagination-sm m-0 float-end">

                {{-- Previous --}}
                @if ($articles->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev">&laquo;</a>
                    </li>
                @endif

                {{-- Page numbers (with … if too many) --}}
                @foreach ($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                    @if ($page == $articles->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Next --}}
                @if ($articles->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">&raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link">&raquo;</span>
                    </li>
                @endif

            </ul>
        </div>
        @endif

    </div>
    @endsection

@push('scripts')
    <script>
    (function () {
    'use strict';

    // ── Single delete ─────────────────────────────────────────────────────────────
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function () {
            const name = this.dataset.name;
            const id   = this.dataset.id;
            if (confirm(`Delete "${name}"?\n\nThis action cannot be undone.`)) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    });

    // ── Bulk selection ────────────────────────────────────────────────────────────
    const selectAll       = document.getElementById('selectAll');
    const rowChecks       = document.querySelectorAll('.row-check');
    const bulkBar         = document.getElementById('bulkBar');
    const bulkCount       = document.getElementById('bulkCount');
    const bulkIdsContainer= document.getElementById('bulkIdsContainer');
    const clearSelBtn     = document.getElementById('clearSelectionBtn');
    const bulkDeleteBtn   = document.getElementById('bulkDeleteBtn');
    const bulkDeleteForm  = document.getElementById('bulkDeleteForm');

    function getChecked() {
        return [...rowChecks].filter(c => c.checked);
    }

    function updateBulkBar() {
        const checked = getChecked();
        if (checked.length > 0) {
            bulkBar.style.display = 'block';
            bulkCount.textContent = `${checked.length} article${checked.length > 1 ? 's' : ''} selected`;
        } else {
            bulkBar.style.display = 'none';
        }
        // Keep select-all indeterminate state
        if (checked.length === 0) {
            selectAll.indeterminate = false;
            selectAll.checked = false;
        } else if (checked.length === rowChecks.length) {
            selectAll.indeterminate = false;
            selectAll.checked = true;
        } else {
            selectAll.indeterminate = true;
            selectAll.checked = false;
        }
    }

    // Select all toggle
    selectAll?.addEventListener('change', function () {
        rowChecks.forEach(c => c.checked = this.checked);
        updateBulkBar();
    });

    // Individual row checkboxes
    rowChecks.forEach(c => c.addEventListener('change', updateBulkBar));

    // Clear selection
    clearSelBtn?.addEventListener('click', function () {
        rowChecks.forEach(c => c.checked = false);
        selectAll.checked = false;
        selectAll.indeterminate = false;
        updateBulkBar();
    });

    // Bulk delete submit
    bulkDeleteBtn?.addEventListener('click', function () {
        const checked = getChecked();
        if (checked.length === 0) return;

        const names = checked.map(c => {
            const row = c.closest('tr');
            return row?.querySelector('td:nth-child(3) .fw-semibold')?.textContent?.trim() || `#${c.value}`;
        });

        const confirmMsg = checked.length === 1
            ? `Delete "${names[0]}"?\n\nThis action cannot be undone.`
            : `Delete ${checked.length} articles?\n\n${names.slice(0, 5).join('\n')}${names.length > 5 ? `\n…and ${names.length - 5} more` : ''}\n\nThis action cannot be undone.`;

        if (!confirm(confirmMsg)) return;

        // Build hidden inputs for the selected IDs
        bulkIdsContainer.innerHTML = '';
        checked.forEach(c => {
            const input = document.createElement('input');
            input.type  = 'hidden';
            input.name  = 'ids[]';
            input.value = c.value;
            bulkIdsContainer.appendChild(input);
        });

        bulkDeleteForm.submit();
    });

    // ── Highlight row on checkbox ──────────────────────────────────────────────────
    rowChecks.forEach(c => {
        c.addEventListener('change', function () {
            this.closest('tr')?.classList.toggle('table-warning', this.checked);
        });
    });

    })();
    </script>
@endpush
