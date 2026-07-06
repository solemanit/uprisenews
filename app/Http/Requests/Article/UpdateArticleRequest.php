<?php
// app/Http/Requests/Article/UpdateArticleRequest.php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('article');
        $id = is_object($id) ? $id->id : $id;

        return [
            // Core
            'title'          => ['required', 'string', 'max:255'],
            'slug'           => ['nullable', 'string', 'max:270', Rule::unique('articles', 'slug')->ignore($id)],
            'excerpt'        => ['nullable', 'string', 'max:500'],
            'body'           => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'category_id'    => ['nullable', 'integer', 'exists:categories,id'],
            'author_id'      => ['required', 'integer', 'exists:users,id'],
            'status'         => ['required', 'in:draft,published,archived'],
            'is_featured'    => ['nullable', 'boolean'],
            'is_breaking'    => ['nullable', 'boolean'],
            'published_at'   => ['nullable', 'date'],

            // SEO
            'seo_title'       => ['nullable', 'string', 'max:70'],
            'seo_description' => ['nullable', 'string', 'max:160'],
            'seo_keywords'    => ['nullable', 'string', 'max:255'],
            'canonical_url'   => ['nullable', 'url', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'      => 'Article title is required.',
            'body.required'       => 'Article body is required.',
            'slug.unique'         => 'This slug is already in use.',
            'seo_title.max'       => 'SEO title should not exceed 70 characters.',
            'seo_description.max' => 'Meta description should not exceed 160 characters.',
            'canonical_url.url'   => 'Canonical URL must be a valid URL.',
        ];
    }
}
