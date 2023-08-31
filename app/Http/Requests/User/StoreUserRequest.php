<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'email'         => [
                'required', 'string', 'email',
                Rule::unique('users', 'email')->whereNull('deleted_at'),
            ],
            'password'      => 'required|min:6',

        ];
    }
}
