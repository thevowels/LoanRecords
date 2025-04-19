<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLimitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        $currentUserActiveLoans = Debt::join('consumers', 'debts.consumer_id', '=', 'consumers.id')
//            ->where('consumers.user_id', $request->user()->id)
//            ->where('debts.currency', $debt->currency)
//            ->sum('debts.amount');

        return [
          'id' => $this->id,
          'user_id' => $this->user_id,
          'currency' => $this->currency,
          'limit' => $this->limit,
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
            'usedAmount' => $this->usedAmount(),
        ];
    }
}
