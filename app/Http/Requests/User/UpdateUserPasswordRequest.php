<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => [
                'required', 'password',
            ],
            'password' => [
                'required', 'between:8,255', 'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'password.between' => "Le mot de passe ne correspond pas aux valeurs attendues",
        ];
    }
}
