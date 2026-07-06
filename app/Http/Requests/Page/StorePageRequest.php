<?php
// app/Http/Requests/Page/StorePageRequest.php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', 'alpha_dash', 'unique:pages,slug'],
            'template'          => ['required', Rule::in(['default', 'full-width', 'sidebar', 'landing'])],
            'content'           => ['nullable', 'string'],
            'featured_image'    => ['nullable', 'image', 'max:2048'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'meta_keywords'     => ['nullable', 'string', 'max:255'],
            'is_active'         => ['boolean'],
            'order'             => ['nullable', 'integer', 'min:0'],
            'published_at'      => ['nullable', 'date'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
