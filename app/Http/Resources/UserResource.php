<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'balance' => $this->balance,
            'account_id ' => $this->account_id,
            'phone' => $this->phone,
            'country' => $this->country,
            'gender' => $this->gender,
            'age' => $this->age,
            'role' => $this->role,
            'email_verified' => $this->email_verified
        ];
    }
}
