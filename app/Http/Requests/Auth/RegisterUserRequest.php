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
