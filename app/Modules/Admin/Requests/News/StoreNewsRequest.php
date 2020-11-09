<?php
namespace App\Modules\Admin\Requests\News;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

/**
 * Class StoreNewRequest
 * @package App\Modules\Admin\Requests\New
 */
class StoreNewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $request = $this->all();
        $rules = [
            'content' =>'required|string|max:100',
            'direction' =>'required',
            'order' =>'required',
        ];
        if (!is_null(Arr::get($request, 'end_time'))) {
            $rules['end_time'] = 'after:start_time';
        }

        return $rules;
    }

    public function messages()
    {
        return [
           'content.required' =>  trans('validation.required'),
           'direction.required' =>  trans('validation.required'),
           'order.required' =>  trans('validation.required'),
           'end_time.after' =>  trans('validation.after'),
        ];
    }
}
