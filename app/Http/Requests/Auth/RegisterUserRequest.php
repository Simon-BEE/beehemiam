<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !auth()->check();
    }

    public function rules(): array
    {
        return [
            'firstname' => [
                'required', 'between:2,255',
            ],
            'lastname' => [
                'required', 'between:2,255',
            ],
            'email' => [
                'required', 'between:2,255', 'email', 'unique:users,email'
            ],
            'password' => [
                'required', 'between:8,255', 'confirmed',
            ],
            'newsletter' => [
                'nullable', 'boolean',
            ],
            'terms' => [
                'required', 'accepted',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password.between' => "Le mot de passe ne correspond pas aux valeurs attendues",
            'email.unique' => "Cette adresse email est déjà utilisée.",
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
