<?php
// app/Http/Requests/Menu/StoreMenuItemRequest.php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_id'      => ['required', 'exists:menus,id'],
            'parent_id'    => ['nullable', 'exists:menu_items,id'],
            'label'        => ['required', 'string', 'max:255'],
            'type'         => ['required', Rule::in(['custom', 'route', 'category', 'article'])],

            'url'          => ['required_if:type,custom', 'nullable', 'string', 'max:2048'],
            'route_name'   => ['required_if:type,route', 'nullable', 'string', 'max:255'],
            'route_params' => ['nullable', 'array'],
            'linkable_id'  => ['required_if:type,category,article', 'nullable', 'integer'],

            'icon'         => ['nullable', 'string', 'max:100'],
            'target'       => ['required', Rule::in(['_self', '_blank'])],
            'order'        => ['nullable', 'integer', 'min:0'],
            'is_active'    => ['sometimes', 'boolean'],
        ];
    }
}
