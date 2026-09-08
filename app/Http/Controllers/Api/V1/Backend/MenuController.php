<?php
// app/Http/Controllers/Api/V1/Backend/MenuController.php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    /** GET /api/v1/menus/{location} — header|footer|mobile */
    public function byLocation(string $location): JsonResponse
    {
        $menu = Menu::active()->location($location)->first();

        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $items = MenuItem::where('menu_id', $menu->id)
            ->active()
            ->orderBy('order')
            ->get();

        $menu->setRelation('items', $this->nest($items));

        return response()->json(['data' => new MenuResource($menu)]);
    }

    private function nest($items, $parentId = null)
    {
        return $items
            ->where('parent_id', $parentId)
            ->map(function ($item) use ($items) {
                $item->setRelation('children', $this->nest($items, $item->id));
                return $item;
            })
            ->values();
    }
}
