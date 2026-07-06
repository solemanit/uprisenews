{{-- resources/views/backend/categories/_form.blade.php --}}

<div class="row g-3">

    {{-- Name --}}
    <div class="col-md-6">
        <label for="name" class="form-label fw-semibold">
            Name <span class="text-danger">*</span>
        </label>
        <input type="text"
               id="name"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $category?->name) }}"
               placeholder="e.g. Technology"
               autofocus>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Slug --}}
    <div class="col-md-6">
        <label for="slug" class="form-label fw-semibold">Slug</label>
        <input type="text"
               id="slug"
               name="slug"
               class="form-control @error('slug') is-invalid @enderror"
               value="{{ old('slug', $category?->slug) }}"
               placeholder="auto-generated if empty">
        @error('slug')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="form-text">Leave empty to auto-generate from name.</div>
    </div>

    {{-- Parent Category --}}
    <div class="col-md-6">
        <label for="parent_id" class="form-label fw-semibold">Parent Category</label>
        <select id="parent_id"
                name="parent_id"
                class="form-select @error('parent_id') is-invalid @enderror">
            <option value="">— None (Top Level) —</option>
            @foreach($parents as $parent)
                <option value="{{ $parent->id }}"
                    {{ old('parent_id', $category?->parent_id) == $parent->id ? 'selected' : '' }}>
                    {{ $parent->name }}
                </option>
            @endforeach
        </select>
        @error('parent_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Sort Order --}}
    <div class="col-md-3">
        <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
        <input type="number"
               id="sort_order"
               name="sort_order"
               class="form-control @error('sort_order') is-invalid @enderror"
               value="{{ old('sort_order', $category?->sort_order ?? 0) }}"
               min="0">
        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Status --}}
    <div class="col-md-3 d-flex align-items-end pb-1">
        <div class="form-check form-switch">
            <input type="hidden" name="status" value="0">
            <input class="form-check-input"
                   type="checkbox"
                   id="status"
                   name="status"
                   value="1"
                   {{ old('status', $category?->status ?? true) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="status">Active</label>
        </div>
    </div>

    {{-- Description --}}
    <div class="col-12">
        <label for="description" class="form-label fw-semibold">Description</label>
        <textarea id="description"
                  name="description"
                  rows="3"
                  class="form-control @error('description') is-invalid @enderror"
                  placeholder="Short description (optional)">{{ old('description', $category?->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
<script>
// Auto-generate slug from name
const nameInput = document.getElementById('name');
const slugInput = document.getElementById('slug');

nameInput?.addEventListener('input', function () {
    if (slugInput.dataset.manual) return;
    slugInput.value = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
});

slugInput?.addEventListener('input', function () {
    this.dataset.manual = this.value ? '1' : '';
});
</script>
@endpush
