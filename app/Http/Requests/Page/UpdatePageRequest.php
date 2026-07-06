<?php
// app/Http/Requests/Page/UpdatePageRequest.php

namespace App\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $page = $this->route('page');

        return [
            'title'             => ['required', 'string', 'max:255'],
            'slug'              => [
                'nullable', 'string', 'max:255', 'alpha_dash',
                Rule::unique('pages', 'slug')->ignore($page->id),
            ],
            'template'          => ['required', Rule::in(['default', 'full-width', 'sidebar', 'landing'])],
            'content'           => ['nullable', 'string'],
            'featured_image'    => ['nullable', 'image', 'max:2048'],
            'meta_title'        => ['nullable', 'string', 'max:255'],
            'meta_description'  => ['nullable', 'string', 'max:500'],
            'meta_keywords'     => ['nullable', 'string', 'max:255'],
            'is_active'         => ['boolean'],
            'order'             => ['nullable', 'integer', 'min:0'],
            'published_at'      => ['nullable', 'date'],

            // System pages can't be deactivated permanently or lose their key — but
            // this request never touches `key`/`is_system`, those are immutable post-creation.
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
