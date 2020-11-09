<?php
namespace App\Modules\Admin\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreCategoryRequest
 * @package App\Modules\Admin\Requests\Category
 */
class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' =>'required|string|max:255',
            'description' =>'max:255',
        ];
    }

    public function messages()
    {
        return [
           'name.max' =>  trans('alerts.categories.errors.name-max-255'),
           'description.max' => trans('alerts.categories.errors.description-max-255'),
            'name.required' => trans('alerts.categories.errors.name-required'),
            'description.required' => trans('alerts.categories.errors.description-required'),

        ];
    }
}
