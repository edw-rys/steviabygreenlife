<?php

namespace App\Http\Requests\Discount;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'code'                  => ['required', 'string', 'min:5', 'max:20'],
            'percentage_discount'   => ['required', 'integer', 'min:1'],
        ];
        if($this->input('expires') == 'on'){
            $rules['expired_at'] = ['required', 'date', 'date_format:Y-m-d', 'after:now'];
            $this->merge(['expires'=>'1']);
        }else{
            $this->merge(['expires'=>'0']);
        }
        if($this->input('attemps-enable') == 'on'){
            $rules['attemps'] = ['required', 'integer', 'min:1'];
        }else{
            $this->merge(['attemps'=>'-1']);
        }
        return $rules;
    }
}
