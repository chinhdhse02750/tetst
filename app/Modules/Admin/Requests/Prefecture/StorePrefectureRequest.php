<?php
namespace App\Modules\Admin\Requests\Prefecture;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StorePrefectureRequest
 * @package App\Modules\Admin\Requests\Prefecture
 */
class StorePrefectureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' =>'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.max' =>  trans('alerts.categories.errors.name-max-255'),
            'name.required' => trans('alerts.categories.errors.name-required'),
        ];
    }
}
