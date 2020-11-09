<?php

namespace App\Modules\Admin\Requests\User;

use App\Helpers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $rules = [];
        $request = $this->all();

        $rules['email'] = 'required|email:rfc,dns|unique:users';
        $rules['password'] = 'bail|required|min:8';
        $rules['password_confirmation'] = 'bail|required|same:password';
        $rules['name'] = 'required';
        $rules['rank'] = 'required';
        $rules['tel'] = 'required|numeric';

        if ($request['type'] == Constants::USER_FEMALE) {
            $rules['underwear_type'] = 'required';
            $rules['blood_type'] = 'required';
            $rules['smoking'] = 'required';
            $rules['age'] = 'required|numeric';
            $rules['weight'] = 'required|numeric';
            $rules['height'] = 'required|numeric';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password_confirm.required' => trans('validation.required'),
            'password_confirm.same' => trans('validation.same'),
            'name.required' => trans('validation.required'),
            'rank_id.required' => trans('validation.required'),
            'tel.required' => trans('validation.required'),
            'tel.numeric' => trans('validation.numeric'),
            'age.required' => trans('validation.required'),
            'age.numeric' => trans('validation.numeric'),
            'height.required' => trans('validation.required'),
            'height.numeric' => trans('validation.numeric'),
            'weight.required' => trans('validation.required'),
            'weight.numeric' => trans('validation.numeric'),
            'blood_type.required' => trans('validation.required'),
            'smoking.required' => trans('validation.required'),
            'underwear_type.required' => trans('validation.required'),
        ];
    }
}
