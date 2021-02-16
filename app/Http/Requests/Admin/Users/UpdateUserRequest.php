<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'firstname' => [
                'required', 'between:2,255',
            ],
            'lastname' => [
                'required', 'between:2,255',
            ],
            'email' => [
                'required', 'email', Rule::unique('users', 'email')->ignore($this->route('user')->id),
            ],
            'newsletter' => [
                'nullable', 'boolean',
            ],
        ];
    }
}
