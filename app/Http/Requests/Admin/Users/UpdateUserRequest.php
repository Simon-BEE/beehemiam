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
            'firstname' => [
                'required', 'between:2,255',
            ],
            'lastname' => [
                'required', 'between:2,255',
            ],
            'email' => [
                'required', 'email', Rule::unique('users', 'email')->ignore(
                    $this->route('user') ? $this->route('user')->id : auth()->id()
                ),
            ],
            'newsletter' => [
                'nullable', 'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => "Cette adresse email est déjà utilisée.",
        ];
    }
}
