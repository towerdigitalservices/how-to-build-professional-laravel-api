<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        if (!auth()->user()) {
            return true;
        }
        return false;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter your email.',
            'password.required' => 'Please enter your password.',
        ];
    }
}
