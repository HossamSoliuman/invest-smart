<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
			'user' => UserResource::make($this->whenLoaded('user')),
			'amount' => $this->amount,
			'address' => $this->address,
			'status' => $this->status,
            'created_at' => $this->created_at,
            'last_update' => $this->updated_at,
        ];
    }
}
