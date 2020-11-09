<?php
namespace App\Modules\Admin\Requests\Rank;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreCategoryRequest
 * @package App\Modules\Admin\Requests\Category
 */
class StoreRankRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_jp' => 'required|max:255',
            'name_en' => 'required|max:255',
            'amount' => 'max:10',
            'priority' => 'required|max:4',
        ];
    }

    public function messages()
    {
        return [
            'name_jp.max' =>  trans('validation.max'),
            'name_en.max' => trans('validation.max'),
            'priority.max' => trans('validation.max'),
            'name_jp.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'priority.required' => trans('validation.required'),
        ];
    }
}
