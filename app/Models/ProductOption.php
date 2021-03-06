<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

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

    protected $appends = ['formatted_price', 'path'];

    public function hasSize(int $sizeId): bool
    {
        return $this->sizes->contains('size_id', $sizeId);
    }

    public function getSizeQuantity(int $sizeId): int
    {
        return $this->sizes->firstWhere('size_id', $sizeId)->quantity;
    }

    /**
     * ? ATTRIBUTES
     */

    public function getFormattedPriceAttribute(): float
    {
        return $this->price / 100;
    }

    public function getMainImageAttribute(): ?ImageOption
    {
        return $this->images
            ->where('is_main', true)
            ->where('is_thumb', false)
            ->first();
    }

    public function getThumbImageAttribute(): ?ImageOption
    {
        return $this->images
            ->where('is_thumb', true)
            ->first();
    }

    public function getDefaultSizeAttribute(): ?ProductOptionSize
    {
        return $this->sizes->first();
    }

    public function getIsAvailableAttribute(): bool
    {
        if ($this->product->is_preorder) {
            return $this->preOrderStock
                ? $this->preOrderStock->quantity > 0
                : false;
        }

        return $this->sizes->where('quantity', '>', 0)->isNotEmpty();
    }

    public function getPathAttribute(): string
    {
        return route('shop.products.show', [$this->product->categories->first(), $this->product]);
    }

    public function getReleaseDateAttribute(): ?Carbon
    {
        if (!$this->product->is_preorder) {
            return null;
        }

        return $this->preOrderStock?->created_at->addWeeks(config('beehemiam.preorder.release_date_weeks'));
    }

    public function getThumbnailsAttribute(): Collection
    {
        return $this->images->where('is_thumb', true);
    }

    public function getRealImagesAttribute(): Collection
    {
        return $this->images->where('is_thumb', false);
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

    public function imagesWithoutThumb(): HasMany
    {
        return $this->images()->where('is_thumb', false);
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductOptionSize::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function availabilityNotifications(): HasMany
    {
        return $this->hasMany(ProductNotification::class);
    }
}
