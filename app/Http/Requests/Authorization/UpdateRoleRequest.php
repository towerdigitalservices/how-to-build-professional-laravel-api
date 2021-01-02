<?php

namespace App\Http\Requests\Authorization;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Role;

class UpdateRoleRequest extends FormRequest
{
    protected $role;

    protected function prepareForValidation()
    {
        $this->role = Role::find($this->route('id'));
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:roles,slug,'.$this->role->id,
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
