<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLimit extends Model
{
    /** @use HasFactory<\Database\Factories\UserLimitFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function usedAmount(): int {
        $usedAmount = Debt::join('consumers', 'debts.consumer_id', '=', 'consumers.id')
            ->where('consumers.user_id', $this->user_id)
            ->where('debts.currency', $this->currency)
            ->sum('debts.amount');

        return $usedAmount;
    }
}
