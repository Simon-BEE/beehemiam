<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageOption extends Model
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
        'is_main' => 'boolean',
        'is_thumb' => 'boolean',
    ];

    /**
     * ? ATTRIBUTES
     */

    public function getPathAttribute(): string
    {
        return url('storage/products')
            . ($this->is_thumb ? '/thumbs/' : '/')
            . $this->product_option_id
            . '/'
            . $this->filename;
    }

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
}
