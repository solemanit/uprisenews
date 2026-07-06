<?php
// app/Http/Requests/Media/StoreFolderRequest.php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreFolderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent' => ['nullable', 'string', 'max:255'],
            'name'   => ['required', 'string', 'max:100', 'regex:/^[A-Za-z0-9 _-]+$/'],
        ];
    }
}
