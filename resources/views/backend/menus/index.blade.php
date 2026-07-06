@extends('backend.layouts.app')

@section('title', 'Menus')

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">All Menus</h3>
        <a href="{{ route('backend.menus.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Menu
        </a>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Location</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($menus as $menu)
                    <tr>
                        <td>{{ $menu->name }}</td>
                        <td><code>{{ $menu->slug }}</code></td>
                        <td>
                            <span class="badge text-bg-secondary text-capitalize">{{ $menu->location }}</span>
                        </td>
                        <td>{{ $menu->all_items_count }}</td>
                        <td>
                            @if ($menu->is_active)
                                <span class="badge text-bg-success">Active</span>
                            @else
                                <span class="badge text-bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('backend.menus.builder', $menu) }}"
                                class="btn btn-sm btn-outline-primary" title="Build Menu">
                                <i class="bi bi-diagram-3"></i> Builder
                            </a>
                            <form action="{{ route('backend.menus.destroy', $menu) }}" method="POST"
                                class="d-inline js-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            No menus found. <a href="{{ route('backend.menus.create') }}">Create one</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($menus->hasPages())
        <div class="card-footer">
            {{ $menus->links() }}
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.js-delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!confirm('Delete this menu and all its items? This cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush
