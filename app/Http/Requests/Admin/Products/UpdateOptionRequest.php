<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOptionRequest extends FormRequest
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
                'required', 'between:2,255',
            ],
            'sku' => [
                'required',
                Rule::unique('product_options', 'sku')->ignore($this->route('productOption')->id),
                'between:2,255',
            ],
            'price' => [
                'required', 'numeric', 'between:1,1000',
            ],
            'description' => [
                'required', 'min:2',
            ],
            'images' => [
                Rule::requiredIf(function () {
                    /** @var \App\Models\ProductOption $productOption */
                    $productOption = $this->route('productOption');

                    return $productOption->images->isEmpty();
                }), 'array',
            ],
            'images.*' => [
                'file', 'max:5000'
            ],
            'quantity' => [
                Rule::requiredIf(function () {
                    /** @var \App\Models\Product $product */
                    $product = $this->route('product');

                    return $product->is_preorder;
                }), 'numeric', 'min:1',
            ],
            'sizes' => [
                Rule::requiredIf(function () {
                    /** @var \App\Models\Product $product */
                    $product = $this->route('product');

                    return !$product->is_preorder;
                }), 'array', 'min:1'
            ],
            'sizes.*.id' => [
                'nullable', 'exists:sizes,id',
            ],
            'sizes.*.quantity' => [
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
