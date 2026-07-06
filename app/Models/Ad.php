<?php
// app/Models/Ad.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'slot',
        'type',
        'image_path',
        'target_url',
        'script_code',
        'html_code',
        'sort_order',
        'open_new_tab',
        'status',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'open_new_tab' => 'boolean',
        'starts_at'    => 'datetime',
        'ends_at'      => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Ad $ad) {
            if (empty($ad->slug)) {
                $ad->slug = Str::slug($ad->title) . '-' . Str::random(6);
            }
        });
    }

    // ── Scopes ───────────────────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeInSlot($query, string $slot)
    {
        return $query->where('slot', $slot);
    }

    public function scopeCurrentlyRunning($query)
    {
        $now = Carbon::now();

        return $query->active()
            ->where(function ($q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }

    // ── Accessors ────────────────────────────────────────────────────────────
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->ends_at && $this->ends_at->isPast();
    }

    public function getIsScheduledAttribute(): bool
    {
        return $this->starts_at && $this->starts_at->isFuture();
    }

    // ── Helpers ──────────────────────────────────────────────────────────────
    public function registerImpression(): void
    {
        $this->increment('impressions_count');
    }

    public function registerClick(): void
    {
        $this->increment('clicks_count');
    }
}
