<?php
// app/Http/Controllers/Api/V1/Backend/AdController.php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AdController extends Controller
{
    // GET /api/v1/ads/slot/{slot} — used by frontend to render a slot's active ads
    public function bySlot(string $slot): AnonymousResourceCollection
    {
        $ads = Ad::inSlot($slot)
            ->currentlyRunning()
            ->orderBy('sort_order')
            ->get();

        return AdResource::collection($ads);
    }

    public function registerClick(Ad $ad): \Illuminate\Http\JsonResponse
    {
        $ad->registerClick();

        return response()->json(['message' => 'Click registered.']);
    }

    public function registerImpression(Ad $ad): \Illuminate\Http\JsonResponse
    {
        $ad->registerImpression();

        return response()->json(['message' => 'Impression registered.']);
    }
}
