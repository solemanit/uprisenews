{{-- resources/views/backend/page/index.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Pages')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Pages</h3>
        <a href="{{ route('backend.pages.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Page
        </a>
    </div>

    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control form-control-sm" placeholder="Search pages...">
            </div>
            <div class="col-auto">
                <select name="type" class="form-select form-select-sm">
                    <option value="">All Types</option>
                    <option value="system" @selected(request('type') === 'system')>System Pages</option>
                    <option value="custom" @selected(request('type') === 'custom')>Custom Pages</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-outline-secondary">Filter</button>
            </div>
        </form>

        <form id="bulk-form" method="POST" action="{{ route('backend.pages.bulk-destroy') }}">
            @csrf
            @method('DELETE')

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th style="width:30px"><input type="checkbox" id="check-all"></th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Template</th>
                        <th>Status</th>
                        <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pages as $page)
                        <tr>
                            <td>
                                @unless ($page->is_system)
                                    <input type="checkbox" name="ids[]" value="{{ $page->id }}" class="row-check">
                                @endunless
                            </td>
                            <td>
                                {{ $page->title }}
                                @if ($page->is_system)
                                    <span class="badge text-bg-secondary ms-1">System</span>
                                @endif
                            </td>
                            <td><code>/{{ $page->slug }}</code></td>
                            <td>{{ ucfirst($page->template) }}</td>
                            <td>
                                @if ($page->is_published)
                                    <span class="badge text-bg-success">Published</span>
                                @else
                                    <span class="badge text-bg-warning">Draft</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('backend.pages.edit', $page) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                @unless ($page->is_system)
                                    <form action="{{ route('backend.pages.destroy', $page) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Delete this page?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endunless
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No pages found.</td></tr>
                    @endforelse
                </tbody>
            </table>

            <button type="submit" class="btn btn-sm btn-outline-danger"
                onclick="return confirm('Delete selected pages?')">
                <i class="bi bi-trash"></i> Delete Selected
            </button>
        </form>

        {{ $pages->links() }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('check-all')?.addEventListener('change', function (e) {
        document.querySelectorAll('.row-check').forEach(cb => cb.checked = e.target.checked);
    });
</script>
@endpush
