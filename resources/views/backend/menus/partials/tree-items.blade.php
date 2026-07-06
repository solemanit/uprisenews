@foreach ($items as $item)
    <li class="menu-node-wrapper" style="list-style:none;">
        <div class="menu-node {{ !$item->is_active ? 'inactive' : '' }}"
            data-id="{{ $item->id }}"
            data-parent-id="{{ $item->parent_id }}"
            data-depth="{{ $depth ?? 0 }}"
            data-type="{{ $item->type }}"
            data-label="{{ $item->label }}"
            data-url="{{ $item->url }}"
            data-route-name="{{ $item->route_name }}"
            data-linkable-id="{{ $item->linkable_id }}"
            data-icon="{{ $item->icon }}"
            data-target="{{ $item->target }}"
            data-active="{{ $item->is_active ? 1 : 0 }}">

            <div class="node-label">
                <i class="bi bi-grip-vertical drag-handle"></i>
                @if ($item->icon)
                    <i class="{{ $item->icon }}"></i>
                @endif
                <span class="node-text">{{ $item->label }}</span>
                <span class="badge text-bg-light text-capitalize">{{ $item->type }}</span>
                @if ($item->children->isNotEmpty())
                    <span class="badge text-bg-info"><i class="bi bi-caret-down-fill"></i> Dropdown</span>
                @endif
                @if (!$item->is_active)
                    <span class="badge text-bg-secondary">Inactive</span>
                @endif
            </div>

            <div class="node-actions">
                <button type="button" class="js-edit-item" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <button type="button" class="js-delete-item" title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>

        <ul class="submenu-dropzone {{ $item->children->isEmpty() ? 'is-empty' : '' }}"
            data-depth="{{ ($depth ?? 0) + 1 }}">
            @include('backend.menus.partials.tree-items', ['items' => $item->children, 'depth' => ($depth ?? 0) + 1])
        </ul>
    </li>
@endforeach
