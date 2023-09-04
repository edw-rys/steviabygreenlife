<?php

namespace App\Http\Requests\Cart;

use App\Models\CartShop;
use App\Models\CartShopProducts;
use App\Models\Location\City;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class ChangeCityBillingToCartRequest extends FormRequest
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
        return [
            'city_id'    => ['required', new Exists((new City())->getTable(), 'id')],
            'tokenCart'     => ['required', 'string', new Exists((new CartShop())->getTable(), 'uuid')]
        ];
    }
}
