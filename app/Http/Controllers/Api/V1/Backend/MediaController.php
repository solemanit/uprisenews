<?php
// app/Http/Controllers/Api/V1/Backend/MediaController.php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\StoreMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function __construct(protected MediaService $mediaService) {}

    public function index(Request $request)
    {
        $media = Media::images()
            ->when($request->directory, fn ($q) => $q->inDirectory($request->directory))
            ->search($request->q)
            ->latest()
            ->paginate($request->integer('per_page', 20));

        return MediaResource::collection($media);
    }

    public function store(StoreMediaRequest $request)
    {
        $uploaded = [];
        foreach ($request->file('files') as $file) {
            $uploaded[] = $this->mediaService->upload(
                $file,
                $request->input('directory', '/'),
                $request->input('alt_text')
            );
        }

        return MediaResource::collection($uploaded);
    }

    public function show(Media $medium)
    {
        return new MediaResource($medium);
    }

    public function destroy(Media $medium)
    {
        $medium->delete();

        return response()->noContent();
    }
}
