<?php
namespace App\Modules\Admin\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreBannerRequest
 * @package App\Modules\Admin\Requests\Prefecture
 */
class StoreBannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => trans('validation.required'),
            'image.image' => trans('validation.image'),
            'image.max' => trans('validation.max.file'),
        ];
    }
}
