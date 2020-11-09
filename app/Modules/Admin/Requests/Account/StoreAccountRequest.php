<?php
namespace App\Modules\Admin\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreAccountRequest
 * @package App\Modules\Admin\Requests\New
 */
class StoreAccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' =>'required|max:255',
            'email' =>'required|max:255|unique:admins',
            'password' =>'required|max:255',
            'role' => 'required'
        ];
    }

    public function messages()
    {
        return [
           'name.required' =>  trans('validation.required'),
           'email.required' =>  trans('validation.required'),
           'role.required' =>  trans('validation.required'),
           'password.required' =>  trans('validation.required'),
        ];
    }
}
