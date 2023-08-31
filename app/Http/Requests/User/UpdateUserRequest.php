<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class UpdateUserRequest extends FormRequest
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
            'name'    => 'required|string',
            'last_name'     => 'required|string',
            'identification_number'     => ['nullable', 'min:10' , 'max:10'],
            'state_id'  => ['nullable', new Exists('state', 'id')],
            'city_id'  => ['nullable', new Exists('city', 'id')],
        ];
    }
}
