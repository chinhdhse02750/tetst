<?php

namespace App\Modules\Admin\Requests\Blogs;

use App\Helpers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBlogsRequest extends FormRequest
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

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.required'),
            'content.required' => trans('validation.required'),
        ];
    }
}
