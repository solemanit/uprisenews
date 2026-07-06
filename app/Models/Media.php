<?php
// app/Models/Media.php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'disk', 'directory', 'file_name', 'original_name',
        'mime_type', 'extension', 'size', 'width', 'height',
        'alt_text', 'uploaded_by',
    ];

    protected $casts = [
        'size'   => 'integer',
        'width'  => 'integer',
        'height' => 'integer',
    ];

    protected $appends = ['url', 'thumb_url', 'human_size'];

    // ── Relationships ────────────────────────────────────────────────
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // ── Scopes ───────────────────────────────────────────────────────
    public function scopeImages(Builder $query): Builder
    {
        return $query->where('mime_type', 'like', 'image/%');
    }

    public function scopeInDirectory(Builder $query, string $directory): Builder
    {
        return $query->where('directory', trim($directory, '/') ?: '/');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $term
            ? $query->where('original_name', 'like', "%{$term}%")
            : $query;
    }

    // ── Accessors ────────────────────────────────────────────────────
    public function getUrlAttribute(): string
    {
        return Storage::disk($this->disk)->url($this->path());
    }

    public function getThumbUrlAttribute(): ?string
    {
        if (!str_starts_with($this->mime_type, 'image/')) {
            return null;
        }

        $thumbPath = $this->thumbPath();

        return Storage::disk($this->disk)->exists($thumbPath)
            ? Storage::disk($this->disk)->url($thumbPath)
            : $this->url;
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 1) . ' ' . $units[$i];
    }

    // ── Helpers ──────────────────────────────────────────────────────
    public function path(): string
    {
        return trim($this->directory, '/') . '/' . $this->file_name;
    }

    public function thumbPath(): string
    {
        return trim($this->directory, '/') . '/thumbs/' . $this->file_name;
    }

    protected static function booted(): void
    {
        static::deleting(function (Media $media) {
            Storage::disk($media->disk)->delete($media->path());
            Storage::disk($media->disk)->delete($media->thumbPath());
        });
    }
}
