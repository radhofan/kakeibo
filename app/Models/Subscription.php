<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'price',
        'billing_cycle',
        'next_renewal_date',
        'payment_method',
        'status',
        'notes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'next_renewal_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function monthlyCost(): float
    {
        return match ($this->billing_cycle) {
            'weekly' => (float) $this->price * 4.33,
            'monthly' => (float) $this->price,
            'quarterly' => (float) $this->price / 3,
            'yearly' => (float) $this->price / 12,
            default => (float) $this->price,
        };
    }
}
