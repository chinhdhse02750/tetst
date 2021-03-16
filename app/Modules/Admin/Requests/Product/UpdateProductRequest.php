<?php

namespace App\Modules\Admin\Requests\Product;

use App\Entities\User;
use App\Helpers\Constants;
use http\Env\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        return [
            'alias' =>'required|unique:products,alias'
        ];

    }

    public function messages()
    {
        return [
            'alias.required' => 'URL tùy chỉnh không được để trống',
            'alias.unique' => 'URL tùy chỉnh đã tồn tại',
        ];
    }
}
