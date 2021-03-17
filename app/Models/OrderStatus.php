<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

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

    const CANCELLED = 1;
    const COMPLETED = 2;
    const FAILED = 3;
    const SHIPPING = 4;
    const MANUFACTURE = 5;
    const REFUNDED = 6;
    const PREPARATION = 7;
    const PROCESS = 8;

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

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
