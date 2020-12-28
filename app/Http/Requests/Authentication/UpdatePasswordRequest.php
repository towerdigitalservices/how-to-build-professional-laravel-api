<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{

    public function authorize()
    {
        $user = auth()->user();
        return $this->user_id === $user->id;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Please provide a User ID.',
            'user_id.exists' => 'The user ID provided is not valid.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'Your new password must be at least 6 characters.',
        ];
    }
}
