{{-- resources/views/backend/ads/_form.blade.php --}}
@csrf

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $ad->title) }}"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slot <span class="text-danger">*</span></label>
                        <select name="slot" class="form-select @error('slot') is-invalid @enderror">
                            @foreach(['header_banner','sidebar_top','sidebar_bottom','in_article','footer_banner','popup'] as $slot)
                                <option value="{{ $slot }}" @selected(old('slot', $ad->slot) === $slot)>
                                    {{ ucwords(str_replace('_',' ',$slot)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('slot') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select name="type" id="ad-type" class="form-select @error('type') is-invalid @enderror">
                            @foreach(['image' => 'Image + Link', 'script' => 'Ad Network Script', 'html' => 'Raw HTML'] as $val => $label)
                                <option value="{{ $val }}" @selected(old('type', $ad->type) === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Image type fields --}}
                <div class="ad-type-fields" data-type="image">
                    <div class="mb-3">
                        <label class="form-label">Image {{ $ad->exists ? '' : '*' }}</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if($ad->image_url)
                            <img src="{{ $ad->image_url }}" class="mt-2 rounded" style="max-height:80px">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Target URL</label>
                        <input type="url" name="target_url" value="{{ old('target_url', $ad->target_url) }}"
                            class="form-control @error('target_url') is-invalid @enderror" placeholder="https://...">
                        @error('target_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" name="open_new_tab" value="1" class="form-check-input" id="open_new_tab"
                            @checked(old('open_new_tab', $ad->open_new_tab ?? true))>
                        <label class="form-check-label" for="open_new_tab">Open link in new tab</label>
                    </div>
                </div>

                {{-- Script type fields --}}
                <div class="ad-type-fields" data-type="script">
                    <div class="mb-3">
                        <label class="form-label">Script Code</label>
                        <textarea name="script_code" rows="6" class="form-control font-monospace @error('script_code') is-invalid @enderror"
                            placeholder="<script>...</script> / AdSense unit code">{{ old('script_code', $ad->script_code) }}</textarea>
                        @error('script_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- HTML type fields --}}
                <div class="ad-type-fields" data-type="html">
                    <div class="mb-3">
                        <label class="form-label">HTML Code</label>
                        <textarea name="html_code" rows="6" class="form-control font-monospace @error('html_code') is-invalid @enderror">{{ old('html_code', $ad->html_code) }}</textarea>
                        @error('html_code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select @error('status') is-invalid @enderror">
                        <option value="active" @selected(old('status', $ad->status ?? 'active') === 'active')>Active</option>
                        <option value="inactive" @selected(old('status', $ad->status) === 'inactive')>Inactive</option>
                    </select>
                    @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" min="0" value="{{ old('sort_order', $ad->sort_order ?? 0) }}"
                        class="form-control @error('sort_order') is-invalid @enderror">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Starts At</label>
                    <input type="datetime-local" name="starts_at"
                        value="{{ old('starts_at', optional($ad->starts_at)->format('Y-m-d\TH:i')) }}"
                        class="form-control @error('starts_at') is-invalid @enderror">
                    @error('starts_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Ends At</label>
                    <input type="datetime-local" name="ends_at"
                        value="{{ old('ends_at', optional($ad->ends_at)->format('Y-m-d\TH:i')) }}"
                        class="form-control @error('ends_at') is-invalid @enderror">
                    @error('ends_at') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-dark w-100">
                    {{ $ad->exists ? 'Update Ad' : 'Create Ad' }}
                </button>
                <a href="{{ route('backend.ads.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancel</a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        const typeSelect = document.getElementById('ad-type');
        const fieldGroups = document.querySelectorAll('.ad-type-fields');

        function syncFields() {
            fieldGroups.forEach(el => {
                el.style.display = el.dataset.type === typeSelect.value ? 'block' : 'none';
            });
        }

        typeSelect.addEventListener('change', syncFields);
        syncFields();
    })();
</script>
@endpush
