<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
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

    public function getImageAttribute(): string
    {
        return 'https://source.unsplash.com/500x600/weekly?' . $this->name;
    }

    /**
     * ? SCOPES
     */

    public function scopeActive(Builder $query): Builder
    {
        return $query->whereHas('products', function ($q) {
            return $q->where('is_active', true);
        });
    }

    /**
     * ? RELATIONS
     */

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
