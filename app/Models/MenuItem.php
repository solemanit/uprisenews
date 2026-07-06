<?php
// app/Models/MenuItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id', 'parent_id', 'label', 'type', 'url',
        'route_name', 'route_params', 'linkable_id',
        'icon', 'target', 'order', 'is_active',
    ];

    protected $casts = [
        'route_params' => 'array',
        'is_active'    => 'boolean',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function linkable()
    {
        return match ($this->type) {
            'category' => Category::find($this->linkable_id),
            'article'  => Article::find($this->linkable_id),
            default    => null,
        };
    }

    public function scopeRoots(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /** Resolve the final href for this item. */
    public function getResolvedUrlAttribute(): string
    {
        return match ($this->type) {
            'route'    => $this->route_name && \Illuminate\Support\Facades\Route::has($this->route_name)
                ? route($this->route_name, $this->route_params ?? [])
                : '#',
            'category' => $this->linkable()?->url ?? '#',
            'article'  => $this->linkable()?->url ?? '#',
            default    => $this->url ?? '#',
        };
    }
}
