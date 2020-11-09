<?php

namespace App\Modules\Admin\Requests\User;

use App\Helpers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendPointRequest extends FormRequest
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
            'amount' => 'required|numeric',
            'content' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => trans('validation.required'),
            'content.required' => trans('validation.required'),
        ];
    }
}
