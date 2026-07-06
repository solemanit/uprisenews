<?php
// app/Http/Controllers/Api/V1/PageController.php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Page\PageResource;
use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $pages = Page::query()
            ->published()
            ->when($request->filled('type'), function ($q) use ($request) {
                $request->type === 'system' ? $q->system() : $q->custom();
            })
            ->ordered()
            ->paginate($request->integer('per_page', 15));

        return response()->json([
            'data' => PageResource::collection($pages),
            'meta' => [
                'current_page' => $pages->currentPage(),
                'last_page'    => $pages->lastPage(),
                'total'        => $pages->total(),
            ],
        ]);
    }

    // GET /api/v1/pages/{slug}
    public function show(Page $page): JsonResponse
    {
        abort_unless($page->is_published, 404);

        return response()->json([
            'data' => new PageResource($page),
        ]);
    }

    // GET /api/v1/pages/key/{key}  — fetch system page by its fixed key e.g. "about"
    public function byKey(string $key): JsonResponse
    {
        $page = Page::published()->where('key', $key)->firstOrFail();

        return response()->json([
            'data' => new PageResource($page),
        ]);
    }

    // GET /api/v1/pages/list — lightweight list for nav/dropdowns
    public function list(): JsonResponse
    {
        $pages = Page::published()->ordered()->get(['id', 'title', 'slug']);

        return response()->json(['data' => $pages]);
    }
}
