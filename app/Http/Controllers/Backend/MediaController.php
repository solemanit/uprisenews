<?php
// app/Http/Controllers/Backend/MediaController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StoreFolderRequest;
use App\Http\Requests\Backend\StoreMediaRequest;
use App\Http\Requests\Backend\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function __construct(protected MediaService $mediaService) {}

    public function index(Request $request)
    {
        $directory = trim($request->get('directory', '/'), '/') ?: '/';

        // Auto-register any files that exist on disk but aren't tracked in DB yet
        $this->syncUntrackedFiles($directory);

        $media = Media::inDirectory($directory)
            ->search($request->get('q'))
            ->latest()
            ->paginate(24)
            ->withQueryString();

        $folders = $this->mediaService->listFolders($directory === '/' ? '' : $directory);

        return view('backend.media.index', [
            'media'     => $media,
            'folders'   => $folders,
            'directory' => $directory,
        ]);
    }

    public function store(StoreMediaRequest $request)
    {
        $directory = $request->input('directory', '/');
        $uploaded  = [];

        foreach ($request->file('files') as $file) {
            $uploaded[] = $this->mediaService->upload(
                $file,
                $directory,
                $request->input('alt_text')
            );
        }

        return response()->json([
            'message' => count($uploaded) . ' file(s) uploaded successfully.',
            'media'   => MediaResource::collection($uploaded),
        ]);
    }

    public function update(UpdateMediaRequest $request, Media $medium)
    {
        $medium->update($request->validated());

        return response()->json([
            'message' => 'Media updated successfully.',
            'media'   => new MediaResource($medium),
        ]);
    }

    public function destroy(Media $medium)
    {
        $medium->delete();

        return response()->json(['message' => 'File deleted successfully.']);
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        Media::whereIn('id', $ids)->get()->each->delete();

        return response()->json(['message' => count($ids) . ' file(s) deleted.']);
    }

    public function storeFolder(StoreFolderRequest $request)
    {
        $path = $this->mediaService->createFolder(
            $request->input('parent', '/'),
            $request->input('name')
        );

        return response()->json([
            'message' => 'Folder created successfully.',
            'path'    => $path,
        ]);
    }

    /**
     * Register any files physically present on the public disk (inside the given
     * directory) that don't yet have a corresponding `media` row. Keeps the file
     * manager showing everything under storage/app/public/, regardless of how
     * the file got there (manual copy, seeder, legacy upload code, etc).
     */
    protected function syncUntrackedFiles(string $directory): void
    {
        $disk    = Storage::disk('public');
        $scanDir = $directory === '/' ? '' : $directory;

        if (!$disk->exists($scanDir)) {
            return;
        }

        $filesOnDisk = collect($disk->files($scanDir))
            ->reject(fn ($path) => str_contains($path, '/thumbs/'));

        if ($filesOnDisk->isEmpty()) {
            return;
        }

        $trackedPaths = Media::inDirectory($directory)
            ->get(['directory', 'file_name'])
            ->map(fn ($m) => trim($m->directory, '/') . '/' . $m->file_name)
            ->flip();

        foreach ($filesOnDisk as $path) {
            if (isset($trackedPaths[$path])) {
                continue;
            }

            $fileName  = basename($path);
            $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $mimeType  = $disk->mimeType($path) ?: 'application/octet-stream';
            $size      = $disk->size($path);

            $width = $height = null;
            if (str_starts_with($mimeType, 'image/')) {
                try {
                    $imageSize = @getimagesize($disk->path($path));
                    if ($imageSize) {
                        [$width, $height] = $imageSize;
                    }
                } catch (\Throwable $e) {
                    // unreadable/corrupt image — skip dimensions, still track the file
                }
            }

            Media::create([
                'disk'          => 'public',
                'directory'     => $directory,
                'file_name'     => $fileName,
                'original_name' => $fileName,
                'mime_type'     => $mimeType,
                'extension'     => $extension,
                'size'          => $size,
                'width'         => $width,
                'height'        => $height,
            ]);
        }
    }
}
