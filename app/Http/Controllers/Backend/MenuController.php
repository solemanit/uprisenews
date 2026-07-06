<?php
// app/Http/Controllers/Backend/MenuController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuItemRequest;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuItemRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Requests\Menu\ReorderMenuItemsRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::withCount('allItems')->latest()->paginate(20);

        return view('backend.menus.index', compact('menus'));
    }

    public function create(): View
    {
        return view('backend.menus.create');
    }

    public function store(StoreMenuRequest $request): RedirectResponse
    {
        $menu = Menu::create($request->validated());

        return redirect()
            ->route('backend.menus.builder', $menu)
            ->with('success', 'Menu created. Now add some items.');
    }

    public function edit(Menu $menu): RedirectResponse
    {
        return redirect()->route('backend.menus.builder', $menu);
    }

    public function update(UpdateMenuRequest $request, Menu $menu): RedirectResponse
    {
        $menu->update($request->validated());

        return back()->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->delete();

        return redirect()->route('backend.menus.index')->with('success', 'Menu deleted successfully.');
    }

    /** The drag-and-drop item builder screen for a single menu. */
    public function builder(Menu $menu): View
    {
        $menu->load(['allItems' => fn ($q) => $q->orderBy('order')]);

        $tree = $this->buildTree($menu->allItems);

        return view('backend.menus.builder', compact('menu', 'tree'));
    }

    public function storeItem(StoreMenuItemRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['order'] = $data['order']
            ?? (MenuItem::where('menu_id', $data['menu_id'])
                ->where('parent_id', $data['parent_id'] ?? null)
                ->max('order') + 1);

        $item = MenuItem::create($data);

        return response()->json(['success' => true, 'item' => $item], 201);
    }

    public function updateItem(UpdateMenuItemRequest $request, MenuItem $item): JsonResponse
    {
        $item->update($request->validated());

        return response()->json(['success' => true, 'item' => $item]);
    }

    public function destroyItem(MenuItem $item): JsonResponse
    {
        $item->delete(); // children cascade via FK

        return response()->json(['success' => true]);
    }

    public function reorderItems(ReorderMenuItemsRequest $request): JsonResponse
    {
        $items = $request->validated()['items'];

        foreach ($items as $row) {
            if (!empty($row['parent_id'])) {
                $parent = MenuItem::find($row['parent_id']);
                if ($parent && $parent->parent_id) {
                    return response()->json([
                        'success' => false,
                        'message' => "Cannot nest under \"{$parent->label}\" — maximum menu depth reached.",
                    ], 422);
                }
            }
        }

        foreach ($items as $row) {
            MenuItem::whereKey($row['id'])->update([
                'parent_id' => $row['parent_id'] ?? null,
                'order'     => $row['order'],
            ]);
        }

        return response()->json(['success' => true]);
    }

    private function buildTree($items, $parentId = null)
    {
        return $items
            ->where('parent_id', $parentId)
            ->map(function ($item) use ($items) {
                $item->setRelation('children', $this->buildTree($items, $item->id));
                return $item;
            })
            ->values();
    }
}
