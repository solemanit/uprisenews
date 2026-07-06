@extends('backend.layouts.app')

@section('title', 'Menu Builder — ' . $menu->name)

@section('content')
<div class="row">

    {{-- LEFT: Menu settings + Add item form --}}
    <div class="col-lg-4">

        {{-- Menu Settings --}}
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Menu Settings</h3>
            </div>
            <form action="{{ route('backend.menus.update', $menu) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="{{ $menu->name }}" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" value="{{ $menu->slug }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <select name="location" class="form-select" required>
                            @foreach (['header' => 'Header Menu', 'footer' => 'Footer Menu', 'mobile' => 'Mobile Menu'] as $value => $label)
                                <option value="{{ $value }}" @selected($menu->location === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input"
                            @checked($menu->is_active)>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Save Settings</button>
                </div>
            </form>
        </div>

        {{-- Add / Edit Menu Item --}}
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title">Add Menu Item</h3>
            </div>
            <form id="item-form">
                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                <input type="hidden" name="item_id" value="">
                {{-- ⚠ Single unified hidden field for category/article id — fixes duplicate `name` bug --}}
                <input type="hidden" name="linkable_id" id="linkable-id-input" value="">

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Type <span class="text-danger">*</span></label>
                        <select name="type" id="item-type" class="form-select" required>
                            <option value="custom">Custom Link</option>
                            <option value="route">Internal Route</option>
                            <option value="category">Category</option>
                            <option value="article">Article</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Label <span class="text-danger">*</span></label>
                        <input type="text" name="label" class="form-control" required>
                    </div>

                    {{-- Custom URL --}}
                    <div class="mb-3 field-custom">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" placeholder="https://example.com or /path">
                    </div>

                    {{-- Route --}}
                    <div class="mb-3 field-route d-none">
                        <label class="form-label">Route Name</label>
                        <input type="text" name="route_name" class="form-control" placeholder="e.g. backend.dashboard">
                    </div>

                    {{-- Category picker (no `name` attr — value pushed into #linkable-id-input via JS) --}}
                    <div class="mb-3 field-category d-none">
                        <label class="form-label">Category</label>
                        <select class="form-select field-category-select" data-linkable="category">
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    {{-- Article picker (no `name` attr — same reason) --}}
                    <div class="mb-3 field-article d-none">
                        <label class="form-label">Article</label>
                        <select class="form-select field-article-select" data-linkable="article">
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Parent Item</label>
                        <select name="parent_id" id="parent-select" class="form-select">
                            <option value="">— Top Level —</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Icon (bootstrap-icons class)</label>
                            <input type="text" name="icon" class="form-control" placeholder="bi bi-house">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Target</label>
                            <select name="target" class="form-select">
                                <option value="_self">Same Tab</option>
                                <option value="_blank">New Tab</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-check form-switch">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>

                <div class="card-footer d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-sm flex-fill">
                        <i class="bi bi-plus-circle"></i> <span id="item-form-submit-label">Add Item</span>
                    </button>
                    <button type="button" id="item-form-cancel" class="btn btn-outline-secondary btn-sm d-none">
                        Cancel Edit
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- RIGHT: Sortable tree --}}
    <div class="col-lg-8">
        <div class="card card-outline card-info">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">
                    {{ $menu->name }}
                    <span class="badge text-bg-secondary text-capitalize">{{ $menu->location }}</span>
                </h3>
                <a href="{{ route('backend.menus.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back to Menus
                </a>
            </div>

            <div class="card-body">
                <p class="text-muted small mb-3">
                    <i class="bi bi-info-circle"></i>
                    Drag an item and drop it into the dashed zone below another item to turn it into a dropdown submenu.
                    Drop it back into the top-level area to un-nest it.
                </p>

               <ul id="menu-tree" class="menu-tree submenu-dropzone" data-depth="0">
                    @include('backend.menus.partials.tree-items', ['items' => $tree, 'depth' => 0])
                </ul>

                {{-- ⚠ নতুন: সবসময় দৃশ্যমান top-level drop target, un-nest করার জন্য --}}
                <div id="root-drop-strip" class="root-drop-strip">
                    <i class="bi bi-arrow-bar-up"></i> Drop here to move to Top Level
                </div>

                <div id="tree-empty" class="text-center text-muted py-5 @if ($tree->isNotEmpty()) d-none @endif">
                    No items yet. Use the form on the left to add your first menu item.
                </div>

                <div id="tree-empty" class="text-center text-muted py-5 @if ($tree->isNotEmpty()) d-none @endif">
                    No items yet. Use the form on the left to add your first menu item.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .root-drop-strip {
    margin-top: .75rem;
    padding: .6rem;
    text-align: center;
    font-size: .8rem;
    color: #adb5bd;
    border: 1px dashed #ced4da;
    border-radius: .375rem;
    background: #fafafa;
}

.root-drop-strip.drag-over,
.root-drop-strip.sortable-ghost {
    background-color: #e7f1ff;
    border-color: #86b7fe;
    color: #0d6efd;
}
    .menu-tree,
    .menu-tree .submenu-dropzone {
        list-style: none;
        padding-left: 0;
    }

    .menu-tree .submenu-dropzone {
        margin-top: .5rem;
        padding-left: 1.75rem;
        border-left: 2px dashed #dee2e6;
        min-height: 10px;
    }

    .menu-tree .submenu-dropzone.is-empty {
        min-height: 34px;
        border: 1px dashed #ced4da;
        border-radius: .375rem;
        margin-left: 1.75rem;
        transition: background-color .15s, border-color .15s;
    }

    .menu-tree .submenu-dropzone.is-empty::before {
        content: 'Drop here to nest';
        display: block;
        font-size: .75rem;
        color: #adb5bd;
        padding: .35rem .6rem;
    }

    .menu-tree .submenu-dropzone.drag-over,
    .menu-tree .submenu-dropzone.is-empty.sortable-ghost {
        background-color: #e7f1ff;
        border-color: #86b7fe;
    }

    .menu-tree .menu-node {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: .375rem;
        padding: .5rem .75rem;
        margin-bottom: .25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .menu-tree .menu-node.sortable-ghost {
        opacity: .4;
        background: #e9f5ff;
    }

    .menu-tree .menu-node.inactive {
        opacity: .55;
    }

    .menu-tree .drag-handle {
        cursor: grab;
        color: #adb5bd;
        margin-right: .5rem;
    }

    .menu-tree .node-label {
        flex: 1;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .menu-tree .node-actions button {
        border: none;
        background: none;
        color: #6c757d;
        padding: .15rem .35rem;
    }

    .menu-tree .node-actions button:hover {
        color: #212529;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const csrfToken     = document.querySelector('meta[name="csrf-token"]').content;
    const itemForm      = document.getElementById('item-form');
    const itemIdInput   = itemForm.querySelector('[name="item_id"]');
    const linkableInput = document.getElementById('linkable-id-input');
    const typeSelect    = document.getElementById('item-type');
    const parentSelect  = document.getElementById('parent-select');
    const submitLabel   = document.getElementById('item-form-submit-label');
    const cancelBtn     = document.getElementById('item-form-cancel');
    const treeRoot      = document.getElementById('menu-tree');
    const treeEmpty     = document.getElementById('tree-empty');

    const MAX_DEPTH = 2; // 0 = top level, 1 = one level of dropdown nesting

    const fieldGroups = {
        custom:   document.querySelector('.field-custom'),
        route:    document.querySelector('.field-route'),
        category: document.querySelector('.field-category'),
        article:  document.querySelector('.field-article'),
    };

    // ── Type field toggling ─────────────────────────────────────────────
    function toggleFields() {
        Object.entries(fieldGroups).forEach(([key, el]) => {
            el.classList.toggle('d-none', key !== typeSelect.value);
        });

        if (typeSelect.value === 'category' && !fieldGroups.category.dataset.loaded) loadOptions('category');
        if (typeSelect.value === 'article'  && !fieldGroups.article.dataset.loaded)  loadOptions('article');

        if (!['category', 'article'].includes(typeSelect.value)) {
            linkableInput.value = '';
        }
    }
    typeSelect.addEventListener('change', toggleFields);
    toggleFields();

    function loadOptions(type) {
        const url = type === 'category'
            ? '{{ route('api.v1.categories.list') }}'
            : '{{ route('api.v1.articles.list') }}';
        const select = document.querySelector(`.field-${type}-select`);

        fetch(url)
            .then(r => r.json())
            .then(res => {
                const data = res.data ?? res;
                select.innerHTML = '<option value="">Select...</option>' +
                    data.map(row => `<option value="${row.id}">${row.name ?? row.title}</option>`).join('');
                fieldGroups[type].dataset.loaded = '1';
            })
            .catch(() => {
                select.innerHTML = '<option value="">Failed to load</option>';
            });
    }

    // Push category/article select value into the single unified hidden input
    document.querySelectorAll('[data-linkable]').forEach(select => {
        select.addEventListener('change', function () {
            linkableInput.value = this.value;
        });
    });

    // ── Parent dropdown (manual override, respects MAX_DEPTH) ───────────
    function refreshParentOptions(excludeId = null) {
        const nodes = treeRoot.querySelectorAll('.menu-node');
        parentSelect.innerHTML = '<option value="">— Top Level —</option>';
        nodes.forEach(node => {
            const id = node.dataset.id;
            if (String(id) === String(excludeId)) return;
            const depth = Number(node.dataset.depth || 0);
            if (depth >= MAX_DEPTH - 1) return;
            const label = node.querySelector('.node-text').textContent.trim();
            parentSelect.insertAdjacentHTML('beforeend',
                `<option value="${id}">${'— '.repeat(depth)}${label}</option>`);
        });
    }
    refreshParentOptions();

    // ── Add / Update item ────────────────────────────────────────────────
    itemForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(itemForm);
        const itemId = itemIdInput.value;
        const isEdit = !!itemId;
        const url = isEdit
            ? `{{ url('menus/items') }}/${itemId}`
            : `{{ route('backend.menus.items.store') }}`;

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-HTTP-Method-Override': isEdit ? 'PATCH' : 'POST',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(async (r) => {
            const res = await r.json().catch(() => ({}));
            if (!r.ok) {
                const msg = res.errors
                    ? Object.values(res.errors).flat().join('\n')
                    : (res.message || 'Something went wrong.');
                alert(msg);
                return;
            }
            window.location.reload();
        })
        .catch(() => alert('Request failed. Check your connection.'));
    });

    cancelBtn.addEventListener('click', function () {
        itemForm.reset();
        itemIdInput.value = '';
        linkableInput.value = '';
        submitLabel.textContent = 'Add Item';
        cancelBtn.classList.add('d-none');
        toggleFields();
    });

    // ── Edit / Delete (event delegation) ─────────────────────────────────
    treeRoot.addEventListener('click', function (e) {
        const editBtn = e.target.closest('.js-edit-item');
        const delBtn  = e.target.closest('.js-delete-item');

        if (editBtn) {
            const node = editBtn.closest('.menu-node');

            itemIdInput.value = node.dataset.id;
            typeSelect.value = node.dataset.type;
            itemForm.label.value = node.dataset.label;
            itemForm.url.value = node.dataset.url || '';
            itemForm.route_name.value = node.dataset.routeName || '';
            itemForm.icon.value = node.dataset.icon || '';
            itemForm.target.value = node.dataset.target || '_self';
            itemForm.is_active.checked = node.dataset.active === '1';
            linkableInput.value = node.dataset.linkableId || '';

            toggleFields();

            if (node.dataset.type === 'category') {
                document.querySelector('.field-category-select').value = node.dataset.linkableId || '';
            }
            if (node.dataset.type === 'article') {
                document.querySelector('.field-article-select').value = node.dataset.linkableId || '';
            }

            refreshParentOptions(node.dataset.id);
            parentSelect.value = node.dataset.parentId || '';

            submitLabel.textContent = 'Update Item';
            cancelBtn.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        if (delBtn) {
            if (!confirm('Delete this item and its sub-items?')) return;
            const node = delBtn.closest('.menu-node');

            fetch(`{{ url('menus/items') }}/${node.dataset.id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-HTTP-Method-Override': 'DELETE',
                    'Accept': 'application/json',
                },
            })
            .then(r => r.json())
            .then(res => { if (res.success) window.location.reload(); })
            .catch(() => alert('Delete failed.'));
        }
    });

    // ── Drag & Drop: every dropzone (root + nested) shares one group ─────
    function initAllSortables() {
        document.querySelectorAll('.submenu-dropzone').forEach(initSortable);
    }
    function initRootDropStrip() {
        const strip = document.getElementById('root-drop-strip');
        if (!strip || strip.sortableInstance) return;

        strip.sortableInstance = new Sortable(strip, {
            group: {
                name: 'menu-tree',
                pull: false,
                put: true, // শুধু receive করবে, drag শুরু হবে না এখান থেকে
            },
            onAdd: function (evt) {
                // যে item এখানে ড্রপ হলো, সেটাকে আসলে root ul-এর শেষে সরিয়ে দাও
                const draggedLi = evt.item;
                treeRoot.appendChild(draggedLi);
                strip.innerHTML = '<i class="bi bi-arrow-bar-up"></i> Drop here to move to Top Level';
                updateEmptyState({ from: evt.from, to: treeRoot });
                persistOrder();
            },
        });
    }
    function initSortable(el) {
        if (el.sortableInstance) return;
        el.sortableInstance = new Sortable(el, {
            group: {
                name: 'menu-tree',
                pull: true,   // এই list থেকে বের করে অন্য list-এ নেওয়া যাবে
                put: true,    // এই list-এ অন্য list থেকে item রাখা যাবে
            },
            handle: '.drag-handle',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            emptyInsertThreshold: 30, // আগের 20 থেকে বাড়ালাম, খালি/ছোট zone-এও সহজে ধরবে
            onMove: function (evt) {
                const targetDepth = Number(evt.to.dataset.depth || 0);
                return targetDepth <= MAX_DEPTH - 1;
            },
            onAdd: updateEmptyState,
            onRemove: updateEmptyState,
            onEnd: persistOrder,
        });
    }

    function updateEmptyState(evt) {
        [evt.from, evt.to].forEach(list => {
            if (!list || !list.classList.contains('submenu-dropzone')) return;
            list.classList.toggle('is-empty', list.children.length === 0 && list !== treeRoot);
        });
    }

    initAllSortables();
    initRootDropStrip();

    // ── Persist order + parent after drag ─────────────────────────────────
    function persistOrder() {
        const payload = [];

        function walk(listEl, parentId) {
            [...listEl.children].forEach((li, index) => {
                if (!li.classList.contains('menu-node-wrapper')) return;
                const node = li.querySelector(':scope > .menu-node');
                payload.push({ id: node.dataset.id, parent_id: parentId, order: index });

                const childList = li.querySelector(':scope > .submenu-dropzone');
                if (childList) walk(childList, node.dataset.id);
            });
        }
        walk(treeRoot, null);

        fetch(`{{ route('backend.menus.items.reorder') }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ items: payload }),
        })
        .then(async (r) => {
            const res = await r.json().catch(() => ({}));
            if (!r.ok) {
                alert(res.message || 'Reorder failed — reloading to resync.');
                window.location.reload();
                return;
            }
            refreshParentOptions();
        })
        .catch(() => {
            alert('Reorder failed — reloading to resync.');
            window.location.reload();
        });
    }
});
</script>
@endpush
