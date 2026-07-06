<?php
// app/Http/Requests/Menu/ReorderMenuItemsRequest.php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class ReorderMenuItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items'               => ['required', 'array'],
            'items.*.id'          => ['required', 'exists:menu_items,id'],
            'items.*.parent_id'   => ['nullable', 'exists:menu_items,id'],
            'items.*.order'       => ['required', 'integer', 'min:0'],
        ];
    }
}
