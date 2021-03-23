<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContactMessage extends Model
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
        'read_at' => 'datetime',
    ];

    public function markAsRead(): void
    {
        if ($this->read_at) {
            return;
        }

        $this->update([
            'read_at' => now(),
        ]);
    }

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

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'contact_message_id');
    }

    public function original(): BelongsTo
    {
        return $this->belongsTo(self::class, 'contact_message_id');
    }
}
