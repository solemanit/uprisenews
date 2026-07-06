{{-- resources/views/backend/ads/index.blade.php --}}
@extends('backend.layouts.app')

@section('title', 'Ads')
@section('page_title', 'Ads Management')

@section('breadcrumb')
    <li class="breadcrumb-item active">Ads</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="form-control form-control-sm" placeholder="Search ads...">

                    <select name="slot" class="form-select form-select-sm">
                        <option value="">All Slots</option>
                        @foreach(['header_banner','sidebar_top','sidebar_bottom','in_article','footer_banner','popup'] as $slot)
                            <option value="{{ $slot }}" @selected(request('slot') === $slot)>
                                {{ ucwords(str_replace('_', ' ', $slot)) }}
                            </option>
                        @endforeach
                    </select>

                    <select name="status" class="form-select form-select-sm">
                        <option value="">All Status</option>
                        <option value="active" @selected(request('status') === 'active')>Active</option>
                        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                    </select>

                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('backend.ads.create') }}" class="btn btn-dark btn-sm">
                    <i class="bi bi-plus-circle"></i> Add Ad
                </a>
            </div>
        </div>
    </div>

    <form id="bulk-form" method="POST" action="{{ route('backend.ads.bulk-destroy') }}">
        @csrf
        @method('DELETE')

        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width:30px"><input type="checkbox" id="check-all"></th>
                        <th>Preview</th>
                        <th>Title</th>
                        <th>Slot</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Schedule</th>
                        <th>Impressions / Clicks</th>
                        <th style="width:120px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ads as $ad)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $ad->id }}" class="row-check"></td>
                            <td>
                                @if($ad->type === 'image' && $ad->image_url)
                                    <img src="{{ $ad->image_url }}" alt="{{ $ad->title }}" style="height:36px" class="rounded">
                                @else
                                    <span class="badge text-bg-secondary">{{ strtoupper($ad->type) }}</span>
                                @endif
                            </td>
                            <td>{{ $ad->title }}</td>
                            <td><span class="badge text-bg-light">{{ ucwords(str_replace('_',' ',$ad->slot)) }}</span></td>
                            <td>{{ ucfirst($ad->type) }}</td>
                            <td>
                                <form method="POST" action="{{ route('backend.ads.toggle-status', $ad) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-{{ $ad->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($ad->status) }}
                                    </button>
                                </form>
                            </td>
                            <td class="small">
                                @if($ad->starts_at || $ad->ends_at)
                                    {{ $ad->starts_at?->format('M d, Y') ?? '—' }} → {{ $ad->ends_at?->format('M d, Y') ?? '—' }}
                                @else
                                    <span class="text-muted">Always on</span>
                                @endif
                            </td>
                            <td class="small">{{ number_format($ad->impressions_count) }} / {{ number_format($ad->clicks_count) }}</td>
                            <td>
                                <a href="{{ route('backend.ads.edit', $ad) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="if(confirm('Delete this ad?')) { document.getElementById('delete-{{ $ad->id }}').submit(); }">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <form id="delete-{{ $ad->id }}" method="POST" action="{{ route('backend.ads.destroy', $ad) }}" class="d-none">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center py-4 text-muted">No ads found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($ads->isNotEmpty())
        <div class="card-footer d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-sm btn-outline-danger"
                onclick="return confirm('Delete selected ads?')">
                <i class="bi bi-trash"></i> Delete Selected
            </button>
            {{ $ads->links() }}
        </div>
        @endif
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('check-all')?.addEventListener('change', function () {
        document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
    });
</script>
@endpush
