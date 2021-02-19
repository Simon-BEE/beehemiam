<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
                'required', 'boolean',
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
}
