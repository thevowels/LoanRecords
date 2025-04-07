<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DebtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>(string) $this->id,
            'currency' => $this->currency,
            'consumer_id' => $this->consumer_id,
            'balance' => $this->amount,
            'limit' => $this->limit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
