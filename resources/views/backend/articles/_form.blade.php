{{--
    resources/views/backend/articles/_form.blade.php
--}}
<div class="row g-4">
    {{-- ───────────────────────── LEFT: Main content ──────────────────────── --}}
    <div class="col-lg-8">

        {{-- Title --}}
        <div class="mb-3">
            <label for="title" class="form-label fw-semibold mb-1">
                Title <span class="text-danger">*</span>
            </label>
            <input type="text"
                   id="title"
                   name="title"
                   class="form-control form-control-lg @error('title') is-invalid @enderror"
                   value="{{ old('title', $article?->title) }}"
                   placeholder="Enter article title…"
                   autofocus>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Slug --}}
        <div class="mb-3">
            <label for="slug" class="form-label fw-semibold mb-1">Permalink (Slug)</label>
            <div class="input-group">
                <span class="input-group-text text-muted" style="font-size:.8rem;">/article/</span>
                <input type="text"
                       id="slug"
                       name="slug"
                       class="form-control @error('slug') is-invalid @enderror"
                       value="{{ old('slug', $article?->slug) }}"
                       placeholder="auto-generated">
                <button type="button"
                        class="btn btn-outline-secondary btn-sm"
                        id="slugRefreshBtn"
                        title="Regenerate from title">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="slug-preview mt-1" id="slugPreview" style="display:none;">
                🔗 /article/<span id="slugPreviewText"></span>
            </div>
        </div>

        {{-- Excerpt --}}
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="excerpt" class="form-label fw-semibold mb-0">Excerpt</label>
                <span class="char-counter ok" id="excerptCounter">0 / 500</span>
            </div>
            <textarea id="excerpt"
                      name="excerpt"
                      rows="2"
                      maxlength="500"
                      class="form-control @error('excerpt') is-invalid @enderror"
                      placeholder="Short summary displayed in listings and used as fallback meta description…">{{ old('excerpt', $article?->excerpt) }}</textarea>
            @error('excerpt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tabs: Body / SEO --}}
        <ul class="nav nav-tabs form-tabs mb-0" id="articleTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-body" type="button">
                    <i class="bi bi-file-text me-1"></i> Content
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-seo" type="button" id="seoTabBtn">
                    <i class="bi bi-search me-1"></i> SEO
                    <span class="badge bg-secondary ms-1" id="seoScoreBadge" style="font-size:.68rem;">—</span>
                </button>
            </li>
        </ul>

        <div class="tab-content border border-top-0 rounded-bottom p-3 bg-white"
             style="border-color:#dee2e6 !important; min-height:380px;">

            {{-- ── Body tab ── --}}
            <div class="tab-pane fade show active" id="tab-body">
                <textarea id="body" name="body" class="@error('body') is-invalid @enderror">{{ old('body', $article?->body) }}</textarea>
                @error('body')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- ── SEO tab ── --}}
            <div class="tab-pane fade" id="tab-seo">

                {{-- SERP preview card --}}
                <div class="serp-preview mb-3">
                    <div class="serp-url">
                        {{ config('app.url') }}/article/<span id="serpSlug">{{ $article?->slug ?? 'article-slug' }}</span>
                    </div>
                    <div class="serp-title" id="serpTitle">
                        {{ old('seo_title', $article?->seo_title ?? $article?->title ?? 'Article Title') }}
                    </div>
                    <div class="serp-desc" id="serpDesc">
                        {{ old('seo_description', $article?->seo_description ?? $article?->excerpt ?? 'Meta description will appear here. Keep it between 120–160 characters for best results.') }}
                    </div>
                </div>

                {{-- SEO score checklist --}}
                <div class="border rounded p-2 mb-3 bg-light" id="seoChecklist">
                    <div class="seo-row neutral" id="chk-title">
                        <span class="seo-dot"></span><span id="chk-title-text">Enter SEO title</span>
                    </div>
                    <div class="seo-row neutral" id="chk-desc">
                        <span class="seo-dot"></span><span id="chk-desc-text">Enter meta description</span>
                    </div>
                    <div class="seo-row neutral" id="chk-kw">
                        <span class="seo-dot"></span><span id="chk-kw-text">Enter focus keywords</span>
                    </div>
                    <div class="seo-row neutral" id="chk-slug">
                        <span class="seo-dot"></span><span id="chk-slug-text">Slug present</span>
                    </div>
                    <div class="seo-row neutral" id="chk-img">
                        <span class="seo-dot"></span><span id="chk-img-text">Featured image</span>
                    </div>
                </div>

                {{-- SEO Title --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="seo_title" class="form-label fw-semibold mb-0">
                            SEO Title
                            <i class="bi bi-info-circle text-muted ms-1"
                               data-bs-toggle="tooltip"
                               title="Auto-generated from article title. Ideally 50–70 characters."></i>
                            <span class="badge bg-light text-secondary border ms-1" style="font-size:.65rem; font-weight:500;">Auto</span>
                        </label>
                        <span class="char-counter ok" id="seoTitleCounter">0 / 70</span>
                    </div>
                    <input type="text"
                           id="seo_title"
                           name="seo_title"
                           maxlength="70"
                           class="form-control @error('seo_title') is-invalid @enderror"
                           value="{{ old('seo_title', $article?->seo_title) }}"
                           placeholder="Auto-generated from article title">
                    @error('seo_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Optimal: 50–70 chars. Auto-syncs with article title.</div>
                </div>

                {{-- Meta Description --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="seo_description" class="form-label fw-semibold mb-0">
                            Meta Description
                            <i class="bi bi-info-circle text-muted ms-1"
                               data-bs-toggle="tooltip"
                               title="The snippet shown under your title in search results. 120–160 chars is ideal."></i>
                        </label>
                        <span class="char-counter ok" id="seoDescCounter">0 / 160</span>
                    </div>
                    <textarea id="seo_description"
                              name="seo_description"
                              rows="3"
                              maxlength="160"
                              class="form-control @error('seo_description') is-invalid @enderror"
                              placeholder="Leave empty to use the excerpt">{{ old('seo_description', $article?->seo_description) }}</textarea>
                    @error('seo_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Optimal: 120–160 chars. Shown below your title in search results.</div>
                </div>

                {{-- Focus Keywords --}}
                <div class="mb-3">
                    <label for="seo_keywords" class="form-label fw-semibold mb-1">
                        Focus Keywords
                        <i class="bi bi-info-circle text-muted ms-1"
                           data-bs-toggle="tooltip"
                           title="Comma-separated keywords."></i>
                    </label>
                    <input type="text"
                           id="seo_keywords"
                           name="seo_keywords"
                           maxlength="255"
                           class="form-control @error('seo_keywords') is-invalid @enderror"
                           value="{{ old('seo_keywords', $article?->seo_keywords) }}"
                           placeholder="e.g. economy, budget 2025, Bangladesh">
                    @error('seo_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Comma-separated. First keyword checked against title.</div>
                </div>

            </div>{{-- /tab-seo --}}

        </div>{{-- /tab-content --}}

    </div>{{-- /col-lg-8 --}}

    {{-- ───────────────────────── RIGHT: Sidebar ───────────────────────────── --}}
    <div class="col-lg-4">

        {{-- ── Publish Box ── --}}
        <div class="sidebar-card">
            <div class="sc-header text-secondary">
                <i class="bi bi-send"></i> Publish
            </div>
            <div class="sc-body">

                {{-- Status radio group --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold mb-2 small text-uppercase text-muted">Status</label>
                    @php
                        $currentStatus = old('status', $article?->status ?? 'draft');
                        $statuses = [
                            'draft'     => ['label' => 'Draft',     'color' => '#f59e0b', 'icon' => 'bi-pencil-square'],
                            'published' => ['label' => 'Published', 'color' => '#22c55e', 'icon' => 'bi-check-circle'],
                            'archived'  => ['label' => 'Archived',  'color' => '#9ca3af', 'icon' => 'bi-archive'],
                        ];
                    @endphp
                    @foreach($statuses as $val => $cfg)
                    <label class="status-opt d-flex align-items-center w-100 mb-1">
                        <input type="radio"
                               name="status"
                               value="{{ $val }}"
                               class="me-2"
                               {{ $currentStatus === $val ? 'checked' : '' }}>
                        <span class="status-dot me-2" style="background:{{ $cfg['color'] }};"></span>
                        <i class="bi {{ $cfg['icon'] }} me-1" style="color:{{ $cfg['color'] }};"></i>
                        <span class="fw-medium">{{ $cfg['label'] }}</span>
                    </label>
                    @endforeach
                    @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                {{-- Publish date --}}
                <div class="mb-3">
                    <label for="published_at" class="form-label fw-semibold mb-1 small text-uppercase text-muted">
                        <i class="bi bi-calendar3 me-1"></i>Publish Date
                    </label>
                    <input type="datetime-local"
                           id="published_at"
                           name="published_at"
                           class="form-control form-control-sm @error('published_at') is-invalid @enderror"
                           value="{{ old('published_at', $article?->published_at?->format('Y-m-d\TH:i')) }}">
                    @error('published_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Auto-set to now when status changes to Published.</div>
                </div>

                {{-- Flags --}}
                <div class="border-top pt-3 mb-1">
                    <label class="form-label fw-semibold mb-2 small text-uppercase text-muted">Flags</label>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_featured" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_featured"
                                   name="is_featured"
                                   value="1"
                                   {{ old('is_featured', $article?->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                <i class="bi bi-star-fill text-warning me-1"></i> Featured Article
                            </label>
                        </div>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_breaking" value="0">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="is_breaking"
                                   name="is_breaking"
                                   value="1"
                                   {{ old('is_breaking', $article?->is_breaking) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_breaking">
                                <i class="bi bi-lightning-fill text-danger me-1"></i> Breaking News
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── Featured Image ── --}}
        <div class="sidebar-card">
            <div class="sc-header text-secondary">
                <i class="bi bi-image"></i> Featured Image
            </div>
            <div class="sc-body">
                <div class="feat-img-container {{ $article?->featured_image ? 'has-image' : '' }}"
                     id="featuredImgContainer">

                    {{-- Placeholder --}}
                    <div class="feat-img-placeholder py-3"
                         id="featuredPlaceholder"
                         style="{{ $article?->featured_image ? 'display:none;' : '' }}">
                        <i class="bi bi-cloud-upload fs-2 d-block mb-1"></i>
                        Click or drag to upload<br>
                        <small>JPG / PNG / WebP — max 2 MB</small>
                    </div>

                    {{-- Preview --}}
                    <img src="{{ $article?->featured_image ? asset('storage/' . $article->featured_image) : '' }}"
                         id="featuredImgPreview"
                         alt="Featured Image"
                         style="{{ $article?->featured_image ? '' : 'display:none;' }}">

                    {{-- Delete overlay (z-index: 10, above file input z-index: 2) --}}
                    <button type="button"
                            class="feat-img-delete"
                            id="clearFeaturedBtn"
                            title="Remove image"
                            style="{{ $article?->featured_image ? '' : 'display:none;' }}">
                        <i class="bi bi-x-lg"></i>
                    </button>

                    {{-- File input — single id only --}}
                    <input type="file"
                           id="featured_image"
                           name="featured_image"
                           accept="image/jpeg,image/png,image/webp"
                           class="feat-file-input @error('featured_image') is-invalid @enderror">
                </div>

                <input type="hidden" name="remove_featured_image" id="removeFeaturedFlag" value="0">

                @error('featured_image')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
                <div class="form-text mt-2">
                    Used as fallback Open Graph image for social sharing.
                </div>
            </div>
        </div>

        {{-- ── WordPress-style Category Panel ── --}}
        <div class="sidebar-card wp-cat-panel">
            <div class="sc-header text-secondary">
                <i class="bi bi-tags"></i> Category
            </div>
            <div class="sc-body p-0">

                <ul class="nav cat-tabs px-2 pt-2 border-bottom" id="catTabNav">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" data-cat-tab="all">All Categories</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-cat-tab="popular">Most Used</button>
                    </li>
                </ul>

                <div class="px-3 pt-2 pb-1">
                    <input type="text"
                           id="catSearch"
                           class="form-control form-control-sm cat-search mb-2"
                           placeholder="Search categories…"
                           autocomplete="off">

                    <div class="cat-list" id="catList">
                        @php
                            $selectedCatId = old('category_id', $article?->category_id);
                        @endphp

                        @forelse($categories->whereNull('parent_id') as $parent)
                            <label data-cat-name="{{ strtolower($parent->name) }}" data-sort-order="{{ $parent->sort_order ?? 0 }}">
                                <input type="radio"
                                       name="category_id"
                                       value="{{ $parent->id }}"
                                       {{ $selectedCatId == $parent->id ? 'checked' : '' }}>
                                {{ $parent->name }}
                            </label>

                            @foreach($categories->where('parent_id', $parent->id) as $child)
                                <label class="cat-child"
                                       data-cat-name="{{ strtolower($child->name) }}"
                                       data-sort-order="{{ $child->sort_order ?? 0 }}">
                                    <input type="radio"
                                           name="category_id"
                                           value="{{ $child->id }}"
                                           {{ $selectedCatId == $child->id ? 'checked' : '' }}>
                                    {{ $child->name }}
                                </label>
                            @endforeach
                        @empty
                            <p class="text-muted small mb-0 py-2">No categories yet.</p>
                        @endforelse

                        <p class="cat-no-results text-muted small mb-0" id="catNoResults">No categories found.</p>
                    </div>

                    @error('category_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    {{-- + Add New Category --}}
                    <div class="add-cat-form">
                        <button type="button"
                                class="btn btn-link btn-sm p-0 text-decoration-none"
                                id="toggleAddCat">
                            <i class="bi bi-plus-circle me-1"></i> Add New Category
                        </button>
                        <div id="addCatForm" style="display:none;" class="mt-2">
                            <input type="text"
                                   id="newCatName"
                                   class="form-control form-control-sm mb-2"
                                   placeholder="New category name">
                            <select id="newCatParent" class="form-select form-select-sm mb-2">
                                <option value="">— Parent Category (optional) —</option>
                                @foreach($categories->whereNull('parent_id') as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                            <button type="button"
                                    id="addCatBtn"
                                    class="btn btn-sm btn-outline-primary w-100">
                                Add
                            </button>
                            <div id="addCatMsg" class="small mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Author ── --}}
        <div class="sidebar-card">
            <div class="sc-header text-secondary">
                <i class="bi bi-person"></i> Author
            </div>
            <div class="sc-body">
                <select id="author_id"
                        name="author_id"
                        class="form-select form-select-sm @error('author_id') is-invalid @enderror">
                    <option value="">— Select Author —</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}"
                            {{ old('author_id', $article?->author_id ?? auth()->id()) == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('author_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

    </div>{{-- /col-lg-4 --}}

</div>{{-- /row --}}

@push('scripts')
<script>
$(document).ready(function () {
    $('#body').summernote({
        height: 400,
        placeholder: 'Write the full article content…',
        toolbar: [
            ['style',  ['style']],
            ['font',   ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
            ['color',  ['color']],
            ['para',   ['ul', 'ol', 'paragraph']],
            ['table',  ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view',   ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
        ],
    });
});
</script>
@endpush

@push('scripts')
<script>
(function () {
'use strict';

// ── Bootstrap tooltips ───────────────────────────────────────────────────────
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
    new bootstrap.Tooltip(el, { trigger: 'hover' });
});

// ── Slug helpers ─────────────────────────────────────────────────────────────
const titleInput   = document.getElementById('title');
const slugInput    = document.getElementById('slug');
const slugPreview  = document.getElementById('slugPreview');
const slugPrevText = document.getElementById('slugPreviewText');
const serpSlug     = document.getElementById('serpSlug');
const refreshBtn   = document.getElementById('slugRefreshBtn');

// ── SEO inputs — MUST be declared before updateSeoChecklist ──────────────────
const seoTitleInput = document.getElementById('seo_title');
const seoDescInput  = document.getElementById('seo_description');
const serpDesc      = document.getElementById('serpDesc');

// ── Featured image state ──────────────────────────────────────────────────────
let hasFeaturedImg    = {{ $article?->featured_image ? 'true' : 'false' }};
let hasFeaturedUpload = false;

// ── SEO checklist ─────────────────────────────────────────────────────────────
function setChk(id, cls, text) {
    const row = document.getElementById('chk-' + id);
    const txt = document.getElementById('chk-' + id + '-text');
    if (!row || !txt) return;
    row.className   = 'seo-row ' + cls;
    txt.textContent = text;
}

function updateSeoChecklist() {
    const titleVal = seoTitleInput?.value.trim() || '';
    const descVal  = seoDescInput?.value.trim()  || '';
    const kwVal    = document.getElementById('seo_keywords')?.value.trim() || '';
    const slugVal  = slugInput?.value.trim() || '';

    // Title
    if (!titleVal) {
        setChk('title', 'warn', 'SEO title empty — will use article title');
    } else if (titleVal.length < 30) {
        setChk('title', 'warn', `SEO title too short (${titleVal.length}/70)`);
    } else if (titleVal.length > 70) {
        setChk('title', 'bad',  `SEO title too long (${titleVal.length}/70)`);
    } else {
        setChk('title', 'good', `SEO title: ${titleVal.length} chars ✓`);
    }

    // Description
    if (!descVal) {
        setChk('desc', 'warn', 'Meta description empty — will use excerpt');
    } else if (descVal.length < 80) {
        setChk('desc', 'warn', `Meta description short (${descVal.length}/160)`);
    } else if (descVal.length > 160) {
        setChk('desc', 'bad',  `Meta description too long (${descVal.length}/160)`);
    } else {
        setChk('desc', 'good', `Meta description: ${descVal.length} chars ✓`);
    }

    // Keywords
    if (!kwVal) {
        setChk('kw', 'neutral', 'No focus keywords set');
    } else {
        const kws  = kwVal.split(',').map(k => k.trim()).filter(Boolean);
        const main = kws[0]?.toLowerCase();
        const inT  = (titleVal || titleInput?.value || '').toLowerCase().includes(main);
        setChk('kw', inT ? 'good' : 'warn',
               inT ? `"${main}" found in title ✓` : `"${main}" not found in title`);
    }

    // Slug
    setChk('slug', slugVal ? 'good' : 'warn',
           slugVal ? `Slug set: /${slugVal} ✓` : 'Slug will be auto-generated');

    // Image
    setChk('img', (hasFeaturedImg || hasFeaturedUpload) ? 'good' : 'warn',
           (hasFeaturedImg || hasFeaturedUpload)
               ? 'Featured image present ✓'
               : 'No image set (recommended for social sharing)');

    // Score badge
    const rows  = document.querySelectorAll('#seoChecklist .seo-row');
    const goods = document.querySelectorAll('#seoChecklist .seo-row.good').length;
    const badge = document.getElementById('seoScoreBadge');
    if (badge) {
        const score       = Math.round((goods / rows.length) * 100);
        badge.textContent = score + '%';
        badge.className   = 'badge ms-1 ' + (score >= 80 ? 'bg-success' : score >= 50 ? 'bg-warning text-dark' : 'bg-danger');
        badge.style.fontSize = '.68rem';
    }
}

// ── Slug functions ────────────────────────────────────────────────────────────
function toSlug(str) {
    return str.toLowerCase().trim()
              .replace(/[^a-z0-9\s-]/g, '')
              .replace(/\s+/g, '-')
              .replace(/-+/g, '-')
              .replace(/^-|-$/g, '');
}

function updateSlugPreview(val) {
    if (val) {
        slugPreview.style.display = 'block';
        slugPrevText.textContent  = val;
        if (serpSlug) serpSlug.textContent = val;
    } else {
        slugPreview.style.display = 'none';
    }
    updateSeoChecklist(); // ✅ এখন safe — updateSeoChecklist আগেই defined
}

// ── Title input — auto slug + auto SEO title ──────────────────────────────────
let seoTitleManual = !!seoTitleInput?.value.trim();

titleInput?.addEventListener('input', function () {
    if (!slugInput.dataset.manual) {
        const slug = toSlug(this.value);
        slugInput.value = slug;
        updateSlugPreview(slug);
    }
    if (!seoTitleManual) {
        const truncated = this.value.slice(0, 70);
        seoTitleInput.value = truncated;
        updateSeoTitleCounter();
        document.getElementById('serpTitle').textContent = truncated || 'Article Title';
        updateSeoChecklist();
    }
});

seoTitleInput?.addEventListener('input', function () {
    seoTitleManual = !!this.value.trim();
    document.getElementById('serpTitle').textContent = this.value || titleInput?.value || 'Article Title';
    updateSeoChecklist();
});

slugInput?.addEventListener('input', function () {
    this.dataset.manual = this.value ? '1' : '';
    updateSlugPreview(this.value);
});

refreshBtn?.addEventListener('click', function () {
    if (!titleInput.value.trim()) return;
    const slug = toSlug(titleInput.value);
    slugInput.value = slug;
    delete slugInput.dataset.manual;
    updateSlugPreview(slug);
});

// ── Initial slug preview ──────────────────────────────────────────────────────
updateSlugPreview(slugInput?.value || '');

// ── Initial SEO title fallback ────────────────────────────────────────────────
if (titleInput?.value && seoTitleInput && !seoTitleInput.value.trim()) {
    seoTitleInput.value = titleInput.value.slice(0, 70);
}

// ── Character counters ────────────────────────────────────────────────────────
function makeCounter(inputId, counterId, max) {
    const el  = document.getElementById(inputId);
    const ctr = document.getElementById(counterId);
    if (!el || !ctr) return () => {};

    function update() {
        const len = el.value.length;
        ctr.textContent = `${len} / ${max}`;
        const pct = len / max;
        ctr.className = 'char-counter ' + (pct < .75 ? 'ok' : pct < 1 ? 'warn' : 'danger');
    }
    el.addEventListener('input', update);
    update();
    return update;
}

const updateSeoTitleCounter = makeCounter('seo_title',       'seoTitleCounter', 70);
makeCounter('excerpt',         'excerptCounter',   500);
makeCounter('seo_description', 'seoDescCounter',   160);

// ── SERP live preview ──────────────────────────────────────────────────────────
seoDescInput?.addEventListener('input', function () {
    serpDesc.textContent = this.value
        || document.getElementById('excerpt')?.value
        || 'Meta description will appear here…';
    updateSeoChecklist();
});

document.getElementById('excerpt')?.addEventListener('input', function () {
    if (!seoDescInput?.value.trim()) {
        serpDesc.textContent = this.value || 'Meta description will appear here…';
    }
});

document.getElementById('seo_keywords')?.addEventListener('input', updateSeoChecklist);

// ── Initial SEO checklist render ──────────────────────────────────────────────
updateSeoChecklist();

// ── Featured Image ────────────────────────────────────────────────────────────
const featuredInput       = document.getElementById('featured_image');
const featuredPreview     = document.getElementById('featuredImgPreview');
const featuredPlaceholder = document.getElementById('featuredPlaceholder');
const featuredContainer   = document.getElementById('featuredImgContainer');
const clearFeaturedBtn    = document.getElementById('clearFeaturedBtn');
const removeFeaturedFlag  = document.getElementById('removeFeaturedFlag');

function showFeaturedImage(src) {
    featuredPreview.src               = src;
    featuredPreview.style.display     = 'block';
    featuredPlaceholder.style.display = 'none';
    clearFeaturedBtn.style.display    = 'flex';
    featuredContainer.classList.add('has-image');
    hasFeaturedUpload = true;
    hasFeaturedImg    = true;
    updateSeoChecklist();
}

function clearFeaturedImage() {
    featuredPreview.src               = '';
    featuredPreview.style.display     = 'none';
    featuredPlaceholder.style.display = 'block';
    clearFeaturedBtn.style.display    = 'none';
    featuredContainer.classList.remove('has-image');
    removeFeaturedFlag.value          = '1';
    featuredInput.value               = '';
    hasFeaturedUpload = false;
    hasFeaturedImg    = false;
    updateSeoChecklist();
}

// ── File input change — validate then preview ─────────────────────────────────
featuredInput?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    // Validate type
    const allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowed.includes(file.type)) {
        alert('Invalid file type. Please select a JPG, PNG, or WebP image.');
        this.value = '';
        return;
    }

    // Validate size (2 MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('File is too large. Maximum allowed size is 2 MB.');
        this.value = '';
        return;
    }

    removeFeaturedFlag.value = '0';

    const reader = new FileReader();
    reader.onload = e => showFeaturedImage(e.target.result);
    reader.onerror = () => alert('Could not read the file. Please try again.');
    reader.readAsDataURL(file);
});

// ── Delete button ─────────────────────────────────────────────────────────────
clearFeaturedBtn?.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    clearFeaturedImage();
});

// ── Click on placeholder opens file picker ────────────────────────────────────
featuredPlaceholder?.addEventListener('click', function () {
    featuredInput?.click();
});

// ── Category search ───────────────────────────────────────────────────────────
const catSearchInput = document.getElementById('catSearch');
const catList        = document.getElementById('catList');
const catNoResults   = document.getElementById('catNoResults');

catSearchInput?.addEventListener('input', function () {
    const q      = this.value.trim().toLowerCase();
    const labels = catList.querySelectorAll('label[data-cat-name]');
    let   visible = 0;

    labels.forEach(label => {
        const name    = label.dataset.catName || '';
        const matches = q === '' || name.includes(q);
        label.style.display = matches ? '' : 'none';
        if (matches) visible++;
    });

    catNoResults.style.display = (visible === 0 && q !== '') ? 'block' : 'none';
});

// ── Category tab switching ────────────────────────────────────────────────────
document.querySelectorAll('[data-cat-tab]').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('[data-cat-tab]').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const labels = [...catList.querySelectorAll('label[data-cat-name]')];

        if (this.dataset.catTab === 'popular') {
            labels.sort((a, b) => {
                const aChecked = a.querySelector('input')?.checked ? 0 : 1;
                const bChecked = b.querySelector('input')?.checked ? 0 : 1;
                if (aChecked !== bChecked) return aChecked - bChecked;
                return (a.dataset.catName || '').localeCompare(b.dataset.catName || '');
            });
        } else {
            labels.sort((a, b) =>
                parseInt(a.dataset.sortOrder || 0) - parseInt(b.dataset.sortOrder || 0)
            );
        }

        labels.forEach(l => catList.appendChild(l));

        if (catSearchInput) catSearchInput.value = '';
        labels.forEach(l => l.style.display = '');
        if (catNoResults) catNoResults.style.display = 'none';
    });
});

// ── Add New Category toggle ───────────────────────────────────────────────────
document.getElementById('toggleAddCat')?.addEventListener('click', function () {
    const form = document.getElementById('addCatForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
});

// ── Add New Category via AJAX ─────────────────────────────────────────────────
document.getElementById('addCatBtn')?.addEventListener('click', async function () {
    const nameInput = document.getElementById('newCatName');
    const name      = nameInput?.value.trim();
    const parent    = document.getElementById('newCatParent')?.value;
    const msg       = document.getElementById('addCatMsg');

    if (!name) {
        msg.innerHTML = '<span class="text-danger">Name is required.</span>';
        return;
    }

    this.disabled = true;
    msg.innerHTML = '<span class="text-muted">Saving…</span>';

    try {
        const res  = await fetch('{{ route("backend.categories.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, parent_id: parent || null, status: true }),
        });
        const json = await res.json();

        if (res.ok && json.id) {
            const label = document.createElement('label');
            label.dataset.catName   = name.toLowerCase();
            label.dataset.sortOrder = '999';
            if (parent) label.classList.add('cat-child');
            label.innerHTML = `<input type="radio" name="category_id" value="${json.id}"> ${json.name}`;
            catList.insertBefore(label, catNoResults);

            msg.innerHTML      = `<span class="text-success"><i class="bi bi-check-circle me-1"></i>"${json.name}" added.</span>`;
            nameInput.value    = '';
            document.getElementById('newCatParent').value = '';
        } else {
            const err = json.message || (json.errors ? Object.values(json.errors).flat().join(' ') : 'Error saving category.');
            msg.innerHTML = `<span class="text-danger">${err}</span>`;
        }
    } catch (e) {
        msg.innerHTML = '<span class="text-danger">Network error. Please try again.</span>';
    } finally {
        this.disabled = false;
    }
});

})();
</script>
@endpush
