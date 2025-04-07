<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model
{
    /** @use HasFactory<\Database\Factories\DebtFactory> */
    use HasFactory;

    public function consumer(): BelongsTo
    {
        return $this->belongsTo(Consumer::class);
    }
}
