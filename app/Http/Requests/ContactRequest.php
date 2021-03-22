<?php

namespace App\Http\Requests;

use App\Rules\MustBeEmpty;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
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
        return [
            'email' => [
                'required', 'email',
            ],
            'name' => [
                'nullable', new MustBeEmpty,
            ],
            'object' => [
                'required', 'between:2,255',
            ],
            'content' => [
                'required', 'min:10',
            ],
            'terms' => [
                'required', 'accepted',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'object.between' => 'Le sujet doit avoir plus de caractères',
            'content.min' => 'Le sujet doit avoir plus de caractères',
        ];
    }
}
