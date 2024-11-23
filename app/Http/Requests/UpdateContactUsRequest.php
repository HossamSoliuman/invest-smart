<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactUsRequest extends FormRequest
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
			'name' => ['string', 'max:255', 'nullable'],
			'email' => ['string', 'max:255', 'nullable'],
			'phone' => ['string', 'max:255', 'nullable'],
			'country' => ['string', 'max:255', 'nullable'],
			'amount_of_invest' => ['integer', 'nullable'],
        ];
    }
}
