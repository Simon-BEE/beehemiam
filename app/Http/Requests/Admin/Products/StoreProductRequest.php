<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
                'nullable', 'boolean',
            ],
            'is_active' => [
                'nullable', 'boolean',
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $failedRules = $validator->failed();
            // dd($failedRules, $this->all());
            // if (!empty($failedRules)) {
            //     session()->flash('type', 'error');
            //     session()->flash('message', 'Please fill correctly the form.');
            // }
        });
    }
}
