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
        \Validator::extend('greater_than', function($attribute, $value, $parameters)
        {
            $other = \Request::get($parameters[0]);
            if($other == null){
                return true;
            }
            return isset($other) and intval($value) > intval($other);
        });




        return [
            'tag_id' =>'required',
            'category_id' =>'required',
            'unit_id' =>'required',
            'stock' => 'required',
            'price' => 'required|greater_than:discount_price'
        ];

    }

    public function messages()
    {
        return [
            'tag_id.required' => 'Từ khóa không được để trống',
            'category_id.required' => 'Danh mục không được để trống',
            'unit_id.required' => 'Đơn vị tính không được để trống',
            'stock.required' => 'Số lượng tồn kho không được để trống',
            'price.greater_than' => 'Giá khuyến mãi không được lớn hơn giá bán',
            'price.required' => 'Giá bán không được để trống',
        ];
    }

}
