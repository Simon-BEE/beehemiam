<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
            'code' => [
                'required', 'between:3,255',
                Rule::unique('coupons', 'code')->ignore($this->route('coupon')?->id)
            ],
            'amount' => [
                'required', 'numeric', 'between:1,100',
            ],
            'expired_at' => [
                'nullable', 'date', 'after_or_equal:now',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'expired_at.after_or_equal' => "Ce champ doit être une date postérieure ou égale à aujourdh'hui",
        ];
    }
}
