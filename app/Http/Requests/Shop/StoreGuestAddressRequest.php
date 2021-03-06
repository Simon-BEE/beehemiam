<?php

namespace App\Http\Requests\Shop;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreGuestAddressRequest extends FormRequest
{
    private array $requiredAddressFields = [
        'firstname', 'lastname', 'city', 'street', 'zipcode',
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $requiredOrNullable = $this->requiredOrNullable();

        return [
            'country_id' => [
                $requiredOrNullable,
                'exists:countries,id',
            ],
            'firstname' => [
                $requiredOrNullable,
                'string', 'between:2,255',
            ],
            'lastname' => [
                $requiredOrNullable,
                'string', 'between:2,255',
            ],
            'street' => [
                $requiredOrNullable,
                'string', 'between:2,255',
            ],
            'additionnal' => [
                'nullable', 'string', 'between:2,255',
            ],
            'zipcode' => [
                $requiredOrNullable,
                'string', 'between:2,255',
            ],
            'city' => [
                $requiredOrNullable,
                'string', 'between:2,255',
            ],
            'phone' => [
                $requiredOrNullable,
                'string', 'between:6,25',
            ],
            'email' => [
                $requiredOrNullable,
                'email', 'between:2,255',
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
                'required_with:billing', 'email', 'between:2,255',
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

    private function requiredOrNullable(): string
    {
        $required = false;

        foreach ($this->requiredAddressFields as $field) {
            if (isset($this->all()[$field])) {
                $required = true;
                break;
            }
        }

        if ($required === false) {
             $required = $this->user()
                ? ($this->user()->address ? false : true)
                : true;
        }

        return $required ? 'required' : 'nullable';
    }
}
