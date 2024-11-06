<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class ChangeStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $in = 'in:' . Transaction::STATUS_CONFIRMED . ',' . Transaction::STATUS_REFUSED;
        return [
            'status' => ['required', $in],
            'transaction' => ['required', 'exists:transactions,id'],
        ];
    }
}
