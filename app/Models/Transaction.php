<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected static function booted()
    {
        static::created(function ($transaction) {
            if($transaction->type == 'loan') {
                $transaction->debt->increment('amount', $transaction->amount);
            }elseif($transaction->type == 'return') {
                $transaction->debt->decrement('amount', $transaction->amount);
            }
        });
    }
    public function debt(): BelongsTo
    {
        return $this->belongsTo(Debt::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
