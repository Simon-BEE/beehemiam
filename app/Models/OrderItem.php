<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ! Price is without taxes
 */
class OrderItem extends Model
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
        'price' => 'integer',
        'tax' => 'integer',
        'quantity' => 'integer',
        'is_preorder' => 'boolean'
    ];

    /**
     * ? ATTRIBUTES
     */

    public function getFormattedPriceAttribute(): float
    {
        return $this->price / 100;
    }

    public function getPriceWithoutTaxesAttribute(): float
    {
        return $this->price - ($this->price * ($this->tax / 100));
    }

    public function getFormattedPriceWithoutTaxesAttribute(): string
    {
        return number_format($this->price_without_taxes / 100, 2);
    }

    public function getFormattedTotalPriceAttribute(): string
    {
        return number_format($this->formatted_price_without_taxes * $this->quantity, 2);
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

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }
}
