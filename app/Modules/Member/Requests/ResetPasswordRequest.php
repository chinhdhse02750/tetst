<?php

namespace App\Modules\Member\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'bail|required|min:8',
            'password_confirmation' => 'bail|required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => trans('validation.required'),
            'password.min' => trans('validation.min'),
            'password_confirm.required' => trans('validation.required'),
            'password_confirm.same' => trans('validation.same'),
        ];
    }
}
