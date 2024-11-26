<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'nullable|string|min:8',
            'email' => 'nullable|string|email|unique:users,email,' . $this->user()->id,
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:25',
            'country' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0|max:120',
        ];
    }
}
