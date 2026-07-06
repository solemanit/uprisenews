{{-- resources/views/backend/page/partials/form.blade.php --}}
<div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title"
                    value="{{ old('title', $page->title ?? '') }}"
                    class="form-control @error('title') is-invalid @enderror">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug"
                    value="{{ old('slug', $page->slug ?? '') }}"
                    class="form-control @error('slug') is-invalid @enderror"
                    {{ $page?->is_system ? 'readonly' : '' }}>
                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if ($page?->is_system)
                    <small class="text-muted">System page slugs cannot be changed.</small>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="12">{{ old('content', $page->content ?? '') }}</textarea>
                @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>
            <h5>SEO</h5>
            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title ?? '') }}"
                    class="form-control @error('meta_title') is-invalid @enderror">
                @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" rows="3"
                    class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $page->meta_description ?? '') }}</textarea>
                @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords ?? '') }}"
                    class="form-control @error('meta_keywords') is-invalid @enderror">
                @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-outline">
                <div class="card-header"><h3 class="card-title">Publish</h3></div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            class="form-check-input"
                            {{ old('is_active', $page->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', $page?->published_at?->format('Y-m-d\TH:i')) }}"
                            class="form-control @error('published_at') is-invalid @enderror">
                        @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <small class="text-muted">Leave blank to publish immediately.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" min="0"
                            value="{{ old('order', $page->order ?? 0) }}"
                            class="form-control @error('order') is-invalid @enderror">
                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        {{ $page ? 'Update Page' : 'Create Page' }}
                    </button>
                </div>
            </div>

            <div class="card card-outline">
                <div class="card-header"><h3 class="card-title">Template</h3></div>
                <div class="card-body">
                    <select name="template" class="form-select @error('template') is-invalid @enderror">
                        @foreach (['default', 'full-width', 'sidebar', 'landing'] as $tpl)
                            <option value="{{ $tpl }}"
                                {{ old('template', $page->template ?? 'default') === $tpl ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('-', ' ', $tpl)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('template') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="card card-outline">
                <div class="card-header"><h3 class="card-title">Featured Image</h3></div>
                <div class="card-body">
                    @if ($page?->featured_image)
                        <img src="{{ $page->featured_image_url }}" class="img-fluid mb-2 rounded">
                    @endif
                    <input type="file" name="featured_image" accept="image/*"
                        class="form-control @error('featured_image') is-invalid @enderror">
                    @error('featured_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        $('#content').summernote({ height: 350 });
    });
</script>
@endpush
