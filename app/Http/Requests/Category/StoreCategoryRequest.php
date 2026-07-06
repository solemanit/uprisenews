<?php
// app/Http/Requests/Category/StoreCategoryRequest.php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // auth()->user()->can('create categories')
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:150'],
            'slug'        => ['nullable', 'string', 'max:160', 'unique:categories,slug'],
            'parent_id'   => ['nullable', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', 'boolean'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Category name is required.',
            'slug.unique'     => 'This slug is already in use.',
            'parent_id.exists'=> 'Selected parent category does not exist.'
        ];
    }
}
