<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Refund extends Model
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
    protected $casts = [];

    /**
     * ? ATTRIBUTES
     */

    public function getFilePathAttribute(): string
    {
        return config('beehemiam.credits.storage_folder')
            . config('beehemiam.credits.file_prefix')
            . $this->credit_file_reference
            . ".pdf";
    }

    public function getCreditFileReferenceAttribute(): string
    {
        return 'A' . str_pad(strval($this->id), 7, '0', STR_PAD_LEFT);
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount / 100, 2);
    }

    public function getPathAttribute(): string
    {
        return route('admin.transactions.refunds.show', $this);
    }

    public function getStripePageAttribute(): string
    {
        return config('services.stripe.dashboard_url') . $this->order->payment->reference;
    }

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
