<?php
// app/Http/Requests/Ads/StoreAdRequest.php

namespace App\Http\Requests\Ads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:255'],
            'slot'         => ['required', Rule::in([
                'header_banner', 'sidebar_top', 'sidebar_bottom',
                'in_article', 'footer_banner', 'popup',
            ])],
            'type'         => ['required', Rule::in(['image', 'script', 'html'])],

            'image'        => ['nullable', 'image', 'max:2048'],
            'target_url'   => ['nullable', 'required_if:type,image', 'url', 'max:2048'],
            'script_code'  => ['nullable', 'required_if:type,script', 'string'],
            'html_code'    => ['nullable', 'required_if:type,html', 'string'],

            'sort_order'   => ['nullable', 'integer', 'min:0'],
            'open_new_tab' => ['nullable', 'boolean'],
            'status'       => ['required', Rule::in(['active', 'inactive'])],

            'starts_at'    => ['nullable', 'date'],
            'ends_at'      => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }
}
