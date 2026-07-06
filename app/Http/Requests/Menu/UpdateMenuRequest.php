<?php
// app/Http/Requests/Menu/UpdateMenuRequest.php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $menu = $this->route('menu');

        return [
            'name'      => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255', Rule::unique('menus', 'slug')->ignore($menu)],
            'location'  => ['required', Rule::in(['header', 'footer', 'mobile']), Rule::unique('menus', 'location')->ignore($menu)],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
