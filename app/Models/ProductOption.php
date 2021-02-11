<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductOption extends Model
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
    ];

    /**
     * ? ATTRIBUTES
     */

    public function getFormattedPriceAttribute(): float
    {
        return $this->price / 100;
    }

    public function getMainImageAttribute(): ?ImageOption
    {
        return $this->images()
            ->where('is_main', true)
            ->where('is_thumb', false)
            ->first();
    }

    public function getThumbImageAttribute(): ?ImageOption
    {
        return $this->images()
            ->where('is_thumb', true)
            ->first();
    }

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function preOrderStock(): HasOne
    {
        return $this->hasOne(PreOrderProductOptionQuantity::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImageOption::class);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductOptionSize::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
