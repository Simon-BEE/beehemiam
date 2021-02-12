<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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

            'categories' => [
                'required', 'array',
            ],
            'categories.*' => [
                'exists:categories,id',
            ],

            'options' => [
                'nullable', 'array', 'min:1'
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
                'file', 'max:5000'
            ],
            'options.*.quantity' => [
                'required_if:is_preorder,1', 'numeric', 'min:1',
            ],
            'options.*.sizes' => [
                Rule::requiredIf($this->is_preorder !== 1), 'array'
            ],
            'options.*.sizes.*.id' => [
                'nullable', 'exists:sizes,id',
            ],
            'options.*.sizes.*.quantity' => [
                'nullable', 'numeric', 'min:1',
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $failedRules = $validator->failed();
            // dd($failedRules, $this->all());
            if (!empty($failedRules)) {
                session()->flash('type', 'Erreur');
                session()->flash('message', 'Le formulaire est rempli incorrectement.');
            }
        });
    }
}
