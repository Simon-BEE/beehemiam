<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOptionSize extends Model implements Buyable
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
        'quantity' => 'integer',
    ];

    /**
     * ? ATTRIBUTES
     */

    // ...

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function productOption(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function getBuyableIdentifier($options = null): int
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null): string
    {
        return $this->productOption->name;
    }

    public function getBuyablePrice($options = null): int
    {
        return $this->productOption->price;
    }
}
