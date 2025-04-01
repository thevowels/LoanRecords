<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Baht extends Model
{
    /** @use HasFactory<\Database\Factories\BahtFactory> */
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function consumer(): BelongsTo
    {
        return $this->belongsTo(Consumer::class);
    }
}
