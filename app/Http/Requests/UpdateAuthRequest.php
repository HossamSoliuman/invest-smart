<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'nullable|string|email|unique:users|max:255',
            'password' => 'nullable|string|min:8',
            'name' => 'nullable|string|max:255',
            'user_name' => 'nullable|string|max:255|unique:users',
            'phone' => 'nullable|string|max:15|unique:users',
            'country' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:0|max:120',
        ];
    }
}
