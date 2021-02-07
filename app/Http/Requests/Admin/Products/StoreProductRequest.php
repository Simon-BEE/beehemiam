<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required', 'between:2,255'
            ],
            'is_preorder' => [
                'required', 'boolean',
            ],
            'is_active' => [
                'required', 'boolean',
            ],
        ];
    }
}
