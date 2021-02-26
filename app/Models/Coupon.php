<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Coupon extends Model
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
        'expired_at' => 'datetime',
        'amount' => 'integer',
    ];

    /**
     * ? ATTRIBUTES
     */

    public function getIsExpiredAttribute(): bool
    {
        return $this->expired_at ? $this->expired_at->isPast() : false;
    }

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
