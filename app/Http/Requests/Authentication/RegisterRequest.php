<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please provide your name',
            'email.required' => 'Please enter your email.',
            'password.required' => 'Please enter a password.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }
}
