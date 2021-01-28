<?php

namespace App\Http\Requests\Phone;

use Illuminate\Foundation\Http\FormRequest;

class ProvisionPhoneRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone_number' => 'required',
            'user_id' => 'required|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'phone_number.required' => 'You must provide a phone number',
            'user_id.required' => 'You must provide a User ID',
            'user_id.exists' => 'The provided User ID does not exist'
        ];
    }
}
