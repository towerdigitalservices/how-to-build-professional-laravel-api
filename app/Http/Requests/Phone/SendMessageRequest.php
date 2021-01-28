<?php

namespace App\Http\Requests\Phone;

use App\Models\Phone;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $id = $this->route('id');
        $this->phone = Phone::findOrFail($id);

    }

    public function authorize()
    {
        $user = $this->user();
        if($user->hasRole('admin') || $user->hasRole('manager')) {
            return true;
        }
        if($this->phone->user->id === $user->id) {
            return true;
        }

        return false;
    }

    public function rules()
    {
        return [
            'to_number' => 'required',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'to_number.required' => 'You must provide a phone number to send a message to',
            'message.required' => 'You must provide a message',
        ];
    }
}
