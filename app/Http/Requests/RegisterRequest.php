<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'user_name' => 'nullable|string|max:255|unique:users',
            'phone' => 'nullable|string|max:15|unique:users',
            'country' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'age' => 'nullable|integer|min:0|max:120',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ];
    }
}
