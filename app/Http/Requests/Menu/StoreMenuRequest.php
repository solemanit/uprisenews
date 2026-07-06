<?php
// app/Http/Requests/Menu/StoreMenuRequest.php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'slug'      => ['nullable', 'string', 'max:255', 'unique:menus,slug'],
            'location'  => ['required', Rule::in(['header', 'footer', 'mobile']), 'unique:menus,location'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if (!$this->slug && $this->name) {
            $this->merge(['slug' => \Illuminate\Support\Str::slug($this->name)]);
        }
    }
}
