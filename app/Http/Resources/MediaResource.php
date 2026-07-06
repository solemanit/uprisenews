<?php
// app/Http/Resources/MediaResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'directory'     => $this->directory,
            'file_name'     => $this->file_name,
            'original_name' => $this->original_name,
            'mime_type'     => $this->mime_type,
            'extension'     => $this->extension,
            'size'          => $this->size,
            'human_size'    => $this->human_size,
            'width'         => $this->width,
            'height'        => $this->height,
            'alt_text'      => $this->alt_text,
            'url'           => $this->url,
            'thumb_url'     => $this->thumb_url,
            'created_at'    => $this->created_at?->toDateTimeString(),
        ];
    }
}
