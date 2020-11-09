<?php
namespace App\Modules\Admin\Requests\Bank;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCategoryRequest
 * @package App\Modules\Admin\Requests\Category
 */
class StoreBankRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'branch_name' => 'required|max:255',
            'account_number' => 'required|max:20',
            'account_name' => 'required|max:255',
            'receipt_name' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.max' =>  trans('validation.max'),
            'name.required' => trans('validation.required'),
            'branch_name.max' => trans('validation.max'),
            'branch_name.required' => trans('validation.required'),
            'account_number.max' => trans('validation.max'),
            'account_number.required' => trans('validation.required'),
            'account_name.max' => trans('validation.max'),
            'account_name.required' => trans('validation.required'),
            'receipt_name.max' => trans('validation.max'),
            'receipt_name.required' => trans('validation.required'),
        ];
    }
}
