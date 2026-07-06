<?php
// app/Services/MediaService.php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class MediaService
{
    protected string $disk = 'public';

    protected int $maxWidth = 1920;
    protected int $quality = 80;
    protected int $thumbSize = 300;

    public function upload(UploadedFile $file, string $directory = '/', ?string $altText = null): Media
    {
        $directory = trim($directory, '/') ?: '/';
        $extension = strtolower($file->getClientOriginalExtension());
        $fileName  = Str::uuid() . '.' . $extension;
        $isImage   = str_starts_with($file->getMimeType(), 'image/');

        $storedPath = trim($directory, '/') . '/' . $fileName;
        $width = $height = null;
        $finalSize = $file->getSize();

        if ($isImage && in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
            $image = Image::read($file->getRealPath());

            // Resize down only if larger than max width
            if ($image->width() > $this->maxWidth) {
                $image->scaleDown(width: $this->maxWidth);
            }

            $encoded = match ($extension) {
                'png'   => $image->toPng(),
                'webp'  => $image->toWebp(quality: $this->quality),
                default => $image->toJpeg(quality: $this->quality),
            };

            Storage::disk($this->disk)->put($storedPath, (string) $encoded);
            $finalSize = strlen((string) $encoded);
            $width  = $image->width();
            $height = $image->height();

            // Thumbnail
            $thumb = Image::read($file->getRealPath())
                ->cover($this->thumbSize, $this->thumbSize);
            $thumbEncoded = match ($extension) {
                'png'   => $thumb->toPng(),
                'webp'  => $thumb->toWebp(quality: $this->quality),
                default => $thumb->toJpeg(quality: $this->quality),
            };
            Storage::disk($this->disk)->put(
                trim($directory, '/') . '/thumbs/' . $fileName,
                (string) $thumbEncoded
            );
        } else {
            Storage::disk($this->disk)->putFileAs($directory, $file, $fileName);
        }

        return Media::create([
            'disk'          => $this->disk,
            'directory'     => $directory,
            'file_name'     => $fileName,
            'original_name' => $file->getClientOriginalName(),
            'mime_type'     => $file->getMimeType(),
            'extension'     => $extension,
            'size'          => $finalSize,
            'width'         => $width,
            'height'        => $height,
            'alt_text'      => $altText,
            'uploaded_by'   => Auth::id(),
        ]);
    }

    public function createFolder(string $parent, string $name): string
    {
        $parent = trim($parent, '/');
        $name   = Str::slug($name, '-');
        $path   = ($parent && $parent !== '/') ? "{$parent}/{$name}" : $name;

        Storage::disk($this->disk)->makeDirectory($path);

        return $path;
    }

    public function listFolders(string $directory = ''): array
    {
        return collect(Storage::disk($this->disk)->directories($directory))
            ->reject(fn ($dir) => str_ends_with($dir, '/thumbs') || $dir === 'thumbs')
            ->values()
            ->all();
    }
}
