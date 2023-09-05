<?php

namespace App\Http\Requests\Cart;

use App\Models\CartShop;
use App\Models\CartShopProducts;
use App\Models\Location\City;
use App\Models\Location\Country;
use App\Models\Location\State;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class StoreBillingToCartRequest extends FormRequest
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
            'billing_identification_number'    => ['nullable', 'min:10' , 'max:10', 'regex:/[0-9]/'],
            'billing_first_name'    => ['required', 'string'],
            'billing_last_name'     => ['required', 'string'],
            'billing_company'       => ['nullable', 'string'],
            'billing_address'       => ['required', 'string'],
            'billing_apartamento'   => ['nullable', 'string'],
            'billing_postal_code'   => ['required', 'string'],
            'billing_phone'         => ['required', 'regex:/[0-9]/', 'min:6' ],
            'billing_email'         => ['required', 'email'],
            'order_comments'        => ['nullable', 'string'],
            'billing_country_id'    => ['required', new Exists((new Country())->getTable(), 'id')],
            'billing_state_id'      => ['required', new Exists((new State())->getTable(), 'id')],
            'billing_city_id'       => ['required', new Exists((new City())->getTable(), 'id')],
            'tokenCart'             => ['required', 'string', new Exists((new CartShop())->getTable(), 'uuid')]
        ];
    }
}
