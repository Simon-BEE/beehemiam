<?php

namespace App\Models;

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

    // ...

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
