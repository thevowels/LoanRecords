<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Debt extends Model
{
    /** @use HasFactory<\Database\Factories\DebtFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;
    protected static function booted()
    {
        static::creating(function ($debt) {
            if(empty($debt->id)) {
                $debt->id = (string) Str::uuid();
            }
        });
    }

    public function consumer(): BelongsTo
    {
        return $this->belongsTo(Consumer::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function currencyCode(){
        $currencyMapping = [
            'kyat' => 'MMK',
            'baht' => 'THB',
        ];
        return $currencyMapping[$this->currency];
    }
}
