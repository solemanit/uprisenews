<?php
// app/Http/Resources/ArticleResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // ── Core ────────────────────────────────────────────────────────
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'excerpt'        => $this->excerpt,
            'body'           => $this->when(
                                    $request->routeIs('api.v1.articles.show'),
                                    $this->body
                                ),
            'featured_image' => $this->featured_image
                                    ? asset('storage/' . $this->featured_image)
                                    : null,
            'status'         => $this->status,
            'is_featured'    => $this->is_featured,
            'is_breaking'    => $this->is_breaking,
            'views_count'    => $this->views_count,
            'published_at'   => $this->published_at?->toISOString(),
            'created_at'     => $this->created_at->toISOString(),
            'updated_at'     => $this->updated_at->toISOString(),

            // ── Relations ────────────────────────────────────────────────────
            'category' => $this->whenLoaded('category', fn () => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
                'slug' => $this->category->slug,
            ]),
            'author' => $this->whenLoaded('author', fn () => [
                'id'   => $this->author->id,
                'name' => $this->author->name,
            ]),

            // ── SEO ──────────────────────────────────────────────────────────
            // Only exposed on detail endpoint (show) to keep listing payloads lean
            'seo' => $this->when(
                $request->routeIs('api.v1.articles.show'),
                fn () => [
                    'title'        => $this->seo_title_resolved,   // falls back to article title
                    'description'  => $this->seo_description_resolved, // falls back to excerpt
                    'keywords'     => $this->seo_keywords,
                    'canonical_url'=> $this->canonical_url
                                        ?? url("/article/{$this->slug}"),
                    'og'           => [
                        'title'       => $this->seo_title_resolved,
                        'description' => $this->seo_description_resolved,
                        'image'       => $this->og_image_url,       // og_image → featured_image fallback
                        'type'        => 'article',
                        'url'         => $this->canonical_url
                                            ?? url("/article/{$this->slug}"),
                    ],
                ]
            ),
        ];
    }
}
