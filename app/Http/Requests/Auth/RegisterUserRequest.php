<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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

    public function withValidator($validator)
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
