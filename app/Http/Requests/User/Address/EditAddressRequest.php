<?php

namespace App\Http\Requests\User\Address;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EditAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('address')->user->id === auth()->id();
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
            'name' => [
                'nullable', 'string', 'between:2,255',
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
                auth()->check() ? 'nullable' : 'required', 'between:6,25',
            ],
            'email' => [
                auth()->check() ? 'nullable' : 'required', 'between:2,255',
            ],
            'is_main' => [
                'nullable', 'boolean',
            ],
            'is_billing' => [
                'nullable', 'boolean',
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
