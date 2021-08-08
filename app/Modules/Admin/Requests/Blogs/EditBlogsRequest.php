<?php

namespace App\Modules\Admin\Requests\Blogs;

use App\Helpers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditBlogsRequest extends FormRequest
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

        $rules['title'] = 'required';
        $rules['content'] = 'required';
//        $rules['image'] = 'required_if|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.required'),
            'content.required' => trans('validation.required'),
            'content.image' => trans('validation.required'),
        ];
    }
}
