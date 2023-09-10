<?php

namespace App\Http\Requests\Cart;

use App\Models\CartShop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Exists;

class SaveTransferRequest extends FormRequest
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
            'tokenCart'             => ['required', 'string', new Exists((new CartShop())->getTable(), 'uuid')],
            'clientTransactionId'   => ['required', 'string'],
            'transferencias'        => ['required', 'array'],
            'transferencias.*'      => ['required','file', 'mimes:jpeg,png,pdf,jpg', 'max:5600']
        ];
    }
}
