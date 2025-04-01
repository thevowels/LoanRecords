<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsumerResource extends JsonResource
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
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => UserResource::make($this->whenLoaded('user')),
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'identification_type' => $this->identification_type,
            'identification_number' => $this->identification_number,
        ];
    }
}
