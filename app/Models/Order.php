<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * ! Price include all taxes with shipping fees
 */
class Order extends Model
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
        'shipping_fees' => 'integer',
        'has_preorder' => 'boolean',
    ];

    /**
     * ? ATTRIBUTES
     */

    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price / 100, 2);
    }

    public function getFormattedShippingFeesAttribute(): string
    {
        return number_format($this->shipping_fees / 100, 2);
    }

    public function getPriceWithoutTaxesAttribute(): float
    {
        return $this->price - ($this->price * ($this->tax / 100));
    }

    public function getFormattedPriceWithoutTaxesAttribute(): string
    {
        return number_format($this->price_without_taxes / 100, 2);
    }

    public function getPathAttribute(): string
    {
        return route('user.orders.show', $this);
    }

    public function getVerboseStatusAttribute(): string
    {
        try {
            return match($this->status->id) {
                OrderStatus::CANCELLED => "Votre commande a été annulée le {$this->updated_at->format('d/m/Y à H:i')}.",
                OrderStatus::COMPLETED => "Votre commande est terminée.",
                OrderStatus::FAILED => "Votre commande a échouée.",
                OrderStatus::SHIPPING => "Votre commande est en cours de livraison.",
                OrderStatus::MANUFACTURE => "Votre commande est en cours de confection (précommande).",
                OrderStatus::REFUNDED => "Votre commande a remboursée le {$this->updated_at->format('d/m/Y à H:i')}.",
                OrderStatus::PREPARATION => "Votre commande est en cours de préparation.",
            default => "Impossible d'indiquer le statut de votre commande.",
            };
        } catch (\Exception $e) {
            logger($e->getMessage());

            return "Impossible d'indiquer le statut de votre commande.";
        }
    }

    public function getIsInProgressAttribute(): bool
    {
        try {
            return match($this->status->id) {
                OrderStatus::CANCELLED => false,
                OrderStatus::COMPLETED => false,
                OrderStatus::FAILED => false,
                OrderStatus::SHIPPING => true,
                OrderStatus::MANUFACTURE => true,
                OrderStatus::REFUNDED => false,
                OrderStatus::PREPARATION => true,
            default => false,
            };
        } catch (\Exception $e) {
            logger($e->getMessage());

            return false;
        }
    }

    public function getIsCancelledAttribute(): bool
    {
        return $this->status->id === OrderStatus::CANCELLED;
    }

    /**
     * ? SCOPES
     */

    //

    /**
     * ? RELATIONS
     */

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function refund(): HasOne
    {
        return $this->hasOne(Refund::class);
    }
}
