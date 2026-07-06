<?php
// app/Models/Article.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'category_id',
        'author_id',
        'status',
        'is_featured',
        'is_breaking',
        'published_at',
        // SEO
        'seo_title',
        'seo_description',
        'seo_keywords',
        'canonical_url'
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'is_breaking'  => 'boolean',
        'published_at' => 'datetime',
    ];

    // ─── Auto slug + publish date ─────────────────────────────────────────────

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            $article->slug = $article->slug
                ? Str::slug($article->slug)
                : self::generateUniqueSlug($article->title);

            if ($article->status === 'published' && is_null($article->published_at)) {
                $article->published_at = now();
            }
        });

        static::updating(function (Article $article) {
            if ($article->isDirty('title') && ! $article->isDirty('slug')) {
                $article->slug = self::generateUniqueSlug($article->title, $article->id);
            }

            if ($article->isDirty('status') && $article->status === 'published' && is_null($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug  = Str::slug($title);
        $count = 0;

        while (true) {
            $candidate = $count === 0 ? $slug : "{$slug}-{$count}";
            $query     = static::where('slug', $candidate);

            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            if (! $query->exists()) {
                return $candidate;
            }

            $count++;
        }
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // ─── Scopes ───────────────────────────────────────────────────────────────

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBreaking($query)
    {
        return $query->where('is_breaking', true);
    }

    // ─── Helpers ──────────────────────────────────────────────────────────────

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'published' => 'success',
            'archived'  => 'secondary',
            default     => 'warning',
        };
    }

    /**
     * Resolved SEO title — falls back to article title.
     */
    public function getSeoTitleResolvedAttribute(): string
    {
        return $this->seo_title ?: $this->title;
    }

    /**
     * Resolved SEO description — falls back to excerpt.
     */
    public function getSeoDescriptionResolvedAttribute(): ?string
    {
        return $this->seo_description ?: $this->excerpt;
    }

    /**
     * OG image URL — always uses featured image.
     */
    public function getOgImageUrlAttribute(): ?string
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : null;
    }

    /**
     * Featured image URL.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : null;
    }
}
