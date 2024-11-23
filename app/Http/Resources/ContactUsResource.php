<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
			'name' => $this->name,
			'email' => $this->email,
			'phone' => $this->phone,
			'country' => $this->country,
			'amount_of_invest' => $this->amount_of_invest,
            'created_at' => $this->created_at,
            'last_update' => $this->updated_at,
        ];
    }
}
