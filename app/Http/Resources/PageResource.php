<?php
// app/Http/Resources/Page/PageResource.php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'slug'              => $this->slug,
            'key'               => $this->key,
            'template'          => $this->template,
            'content'           => $this->content,
            'excerpt'           => $this->excerpt,
            'featured_image'    => $this->featured_image_url,
            'meta' => [
                'title'         => $this->meta_title ?? $this->title,
                'description'   => $this->meta_description,
                'keywords'      => $this->meta_keywords,
            ],
            'is_system'         => $this->is_system,
            'published_at'      => $this->published_at?->toIso8601String(),
            'updated_at'        => $this->updated_at?->toIso8601String(),
        ];
    }
}
