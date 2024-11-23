<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactUsRequest extends FormRequest
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
            'name' => ['string', 'max:255', 'required'],
            'email' => ['string', 'max:255', 'required'],
            'phone' => ['string', 'max:255', 'required'],
            'country' => ['string', 'max:255', 'required'],
            'amount_of_invest' => ['integer', 'required'],
            'recaptcha' => ['required']
        ];
    }
}
