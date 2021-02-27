<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreGuestAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country_id' => [
                'required', 'exists:countries,id',
            ],
            'firstname' => [
                'required', 'string', 'between:2,255',
            ],
            'lastname' => [
                'required', 'string', 'between:2,255',
            ],
            'street' => [
                'required', 'string', 'between:2,255',
            ],
            'additionnal' => [
                'nullable', 'string', 'between:2,255',
            ],
            'zipcode' => [
                'required', 'string', 'between:3,15',
            ],
            'city' => [
                'required', 'string', 'between:2,255',
            ],
            'phone' => [
                'required', 'between:6,25',
            ],
            'email' => [
                'required', 'between:2,255',
            ],
            'billing' => [
                'nullable', 'array',
            ],
            'billing.country_id' => [
                'required_with:billing', 'exists:countries,id',
            ],
            'billing.firstname' => [
                'required_with:billing', 'string', 'between:2,255',
            ],
            'billing.lastname' => [
                'required_with:billing', 'string', 'between:2,255',
            ],
            'billing.street' => [
                'required_with:billing', 'string', 'between:2,255',
            ],
            'billing.additionnal' => [
                'nullable', 'string', 'between:2,255',
            ],
            'billing.zipcode' => [
                'required_with:billing', 'string', 'between:3,15',
            ],
            'billing.city' => [
                'required_with:billing', 'string', 'between:2,255',
            ],
            'billing.phone' => [
                'required_with:billing', 'between:6,25',
            ],
            'billing.email' => [
                'required_with:billing', 'between:2,255',
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
