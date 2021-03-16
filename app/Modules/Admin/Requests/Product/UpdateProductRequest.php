<?php

namespace App\Modules\Admin\Requests\User;

use App\Entities\User;
use App\Helpers\Constants;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $rules['age'] = 'required|numeric';
        $rules['height'] = 'required|numeric';
        $rules['weight'] = 'required|numeric';
        $rules['blood_type'] = 'required';
        $rules['smoking'] = 'required';
        $rules['underwear_type'] = 'required';

        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.min' => trans('validation.min'),
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
