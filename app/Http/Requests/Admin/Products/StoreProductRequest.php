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
            'options' => [
                'required', 'array', 'min:1'
            ],
            'options.*.name' => [
                'required', 'between:2,255',
            ],
            'options.*.sku' => [
                'required', 'between:2,255',
            ],
            'options.*.price' => [
                'required', 'numeric', 'between:1,1000',
            ],
            'options.*.description' => [
                'required', 'min:2',
            ],
            'options.*.images' => [
                'required', 'array',
            ],
            'options.*.images.*' => [
                'file', 'max:50000'
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $failedRules = $validator->failed();
            dd($failedRules, $this->all(), $this->files);
            // if (!empty($failedRules)) {
            //     session()->flash('type', 'error');
            //     session()->flash('message', 'Please fill correctly the form.');
            // }
        });
    }
}
