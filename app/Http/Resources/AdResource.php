<?php
// app/Http/Resources/AdResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'slot'          => $this->slot,
            'type'          => $this->type,
            'image_url'     => $this->image_url,
            'target_url'    => $this->target_url,
            'script_code'   => $this->type === 'script' ? $this->script_code : null,
            'html_code'     => $this->type === 'html' ? $this->html_code : null,
            'open_new_tab'  => $this->open_new_tab,
        ];
    }
}
