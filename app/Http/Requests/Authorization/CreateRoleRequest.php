<?php

namespace App\Http\Requests\Authorization;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:roles',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'You must provide a name.',
            'slug.required' => 'You must provide a slug.',
            'slug.unique' => 'The provided slug must be unique.'
        ];
    }
}
