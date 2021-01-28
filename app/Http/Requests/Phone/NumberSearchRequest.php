<?php

namespace App\Http\Requests\Phone;

use Illuminate\Foundation\Http\FormRequest;

class NumberSearchRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        if(empty($this->count)) {
            $this->count = 5;
        }
    }

    public function rules()
    {
        return [
            'area_code' => 'required|size:3',
            'count' => 'sometimes|required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'area_code.required' => 'You must provide an area code',
            'area_code.size' => 'The provided area code must be 3 digits',
            'count.numeric' => 'The count must be numeric'
        ];
    }
}
