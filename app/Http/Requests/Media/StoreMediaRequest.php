<?php
// app/Http/Requests/Media/StoreMediaRequest.php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'files'      => ['required', 'array', 'min:1'],
            'files.*'    => ['required', 'file', 'max:10240', 'mimes:jpg,jpeg,png,webp,gif,svg,pdf,doc,docx,mp4'],
            'directory'  => ['nullable', 'string', 'max:255'],
            'alt_text'   => ['nullable', 'string', 'max:255'],
        ];
    }
}
