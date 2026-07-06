<?php
// app/Http/Requests/Category/UpdateCategoryRequest.php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('category'); // works for both web (model) and api (id)
        $id = is_object($id) ? $id->id : $id;

        return [
            'name'        => ['required', 'string', 'max:150'],
            'slug'        => ['nullable', 'string', 'max:160', Rule::unique('categories', 'slug')->ignore($id)],
            'parent_id'   => ['nullable', 'integer', 'exists:categories,id', Rule::notIn([$id])],
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', 'boolean'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Category name is required.',
            'slug.unique'      => 'This slug is already in use.',
            'parent_id.not_in' => 'A category cannot be its own parent.'
        ];
    }
}
