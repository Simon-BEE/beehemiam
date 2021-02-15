<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
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
        'is_preorder' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * ? ATTRIBUTES
     */

    public function getHasOptionsQuantitiesAttribute(): bool
    {
        $options = $this->productOptions()->with('sizes')->get();

        $filteredOptions = $options->filter(function ($option) {
            return $option->sizes->isNotEmpty();
        });

        return $filteredOptions->isNotEmpty();
    }

    public function getTotalStockAttribute(): int
    {
        if ($this->is_preorder) {
            return $this->productOptions->sum(function (ProductOption $option) {
                return $option->preOrderStock->quantity;
            });
        }

        return $this->productOptions->sum(function (ProductOption $option) {
            return $option->sizes->sum('quantity');
        });
    }

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function productOptions(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }
}
