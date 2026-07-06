<?php
// app/Http/Resources/MenuItemResource.php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'       => $this->id,
            'label'    => $this->label,
            'url'      => $this->resolved_url,
            'icon'     => $this->icon,
            'target'   => $this->target,
            'children' => MenuItemResource::collection($this->whenLoaded('children')),
        ];
    }
}
