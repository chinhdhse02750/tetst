<?php
namespace App\Modules\Admin\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateBannerRequest
 * @package App\Modules\Admin\Requests\Prefecture
 */
class UpdateBannerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $request =$this->all();
        if (!empty($request['image'])) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240';
        }

        return $rules;
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
