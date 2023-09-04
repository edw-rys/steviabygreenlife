<?php

namespace App\Http\Requests\Cart;

use App\Models\CartShop;
use App\Models\CartShopProducts;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class ChangeItemsToCartRequest extends FormRequest
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
            'cart_product'          => ['required', 'array'],
            'cart_product.*.item_id'  => ['required', new Exists((new CartShopProducts)->getTable(), 'id')],
            'cart_product.*.qty'      => ['required', 'min:1', 'integer'],
            'tokenCart'               => ['required', 'string', new Exists((new CartShop())->getTable(), 'uuid')]
        ];
    }
}
