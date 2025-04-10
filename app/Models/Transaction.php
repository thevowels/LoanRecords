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
        static::creating(function ($transaction) {
            $debt = $transaction->debt;

            if (! $debt) {
                throw new \Exception('Debt not found');
            }
            if ($transaction->type === 'loan') {
                $newamount = $transaction->amount + $debt->amount;
                if ($newamount > $debt->limit) {
                    throw new \Exception("Loan exceeds debt limit of {$debt->limit} .");
                }
            } elseif ($transaction->type === 'return') {
                if ($transaction->amount > $debt->amount) {
                    throw new \Exception("Cannot return more than current debt of {$debt->amount} .");
                }
            }

        });
        static::created(function ($transaction) {
            if ($transaction->type == 'loan') {
                $transaction->debt->increment('amount', $transaction->amount);
            } elseif ($transaction->type == 'return') {
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
