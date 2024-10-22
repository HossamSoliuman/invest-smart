<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
			'user_id' => ['integer', 'exists:users,id', 'nullable'],
			'amount' => ['integer', 'nullable'],
			'address' => ['string', 'max:255', 'nullable'],
			'status' => ['string', 'max:255', 'nullable'],
        ];
    }
}
