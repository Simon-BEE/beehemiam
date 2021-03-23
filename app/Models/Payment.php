<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount' => 'integer',
    ];

    const CARD_TYPE = 'card';
    const PAYPAL_TYPE = 'paypal';

    /**
     * ? ATTRIBUTES
     */

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount / 100, 2);
    }

    public function getPathAttribute(): string
    {
        return route('admin.transactions.payments.show', $this);
    }

    public function getStripePageAttribute(): string
    {
        return config('services.stripe.dashboard_url') . $this->reference;
    }

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
