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
        $rules = [
            'redirect_url' =>'required|string|max:255|active_url',
            'order' =>'required|max:4',
        ];
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
            'redirect_url.max' =>  trans('validation.image'),
            'order.max' => trans('validation.max.numeric'),
            'redirect_url.required' => trans('validation.required'),
            'order.required' => trans('validation.required'),
            'redirect_url.active_url' =>  trans('validation.active_url'),
        ];
    }
}
