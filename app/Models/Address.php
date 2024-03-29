<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
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
        'is_billing' => 'boolean',
    ];

    protected $with = ['country'];

    /**
     * ? ATTRIBUTES
     */

    public function getFullNameAttribute(): string
    {
        return ucfirst(strtolower($this->firstname)) . ' ' . ucfirst(strtolower($this->lastname));
    }

    public function getInvoiceEmailAttribute(): string
    {
        return $this->email ?? $this->invoices->last()->order->user->email;
    }

    public function getInlineAddressAttribute(): string
    {
        return $this->street
            . ' ' . ($this->additionnal ?? '')
            . ', ' . $this->city
            . ' ' . $this->zipcode
            . ', ' . $this->country->name;
    }

    /**
     * ? SCOPES
     */

    // ...

    /**
     * ? RELATIONS
     */

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
