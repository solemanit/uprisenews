{{-- resources/views/backend/categories/index.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Categories')
@section('page_title', 'Categories')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Categories</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-outline card-primary">

            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title mb-0">
                    <i class="bi bi-tags me-1"></i> All Categories
                </h3>
                <a href="{{ route('backend.categories.create') }}" class="btn btn-dark btn-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add Category
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:60px">#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Sub-cats</th>
                                <th>Order</th>
                                <th style="width:100px">Status</th>
                                <th style="width:130px" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <td class="text-muted small">{{ $category->id }}</td>
                                <td class="fw-semibold">{{ $category->name }}</td>
                                <td><code class="small">{{ $category->slug }}</code></td>
                                <td>
                                    @if($category->parent)
                                        <span class="badge bg-light text-dark border">
                                            {{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $category->children_count }}</span>
                                </td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    @if($category->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('backend.categories.edit', $category) }}"
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger btn-delete"
                                            title="Delete"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $category->id }}"
                                          action="{{ route('backend.categories.destroy', $category) }}"
                                          method="POST" class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    No categories found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($categories->hasPages())
            <div class="card-footer bg-white border-top">
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted small">
                        Showing {{ $categories->firstItem() }}–{{ $categories->lastItem() }}
                        of {{ $categories->total() }} categories
                    </span>
                    {{ $categories->links() }}
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
        const name = this.dataset.name;
        const id   = this.dataset.id;
        if (confirm(`Delete "${name}"? This action cannot be undone.`)) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
});
</script>
@endpush
