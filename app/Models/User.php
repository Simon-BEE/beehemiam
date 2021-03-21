<?php

namespace App\Models;

use App\Mail\Users\DeleteAccountMail;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\PersonalDataExport\ExportsPersonalData;
use Spatie\PersonalDataExport\PersonalDataSelection;

class User extends Authenticatable implements MustVerifyEmail, ExportsPersonalData
{
    use HasFactory, Notifiable;

    const USER_ROLE = 'ROLE_USER';
    const ADMIN_ROLE = 'ROLE_ADMIN';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'newsletter' => 'boolean',
    ];

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmailQueued);
    }

    public function sendEmailToDeleteAccount(): void
    {
        Mail::to($this)->send(new DeleteAccountMail($this));
    }

    /**
     * ? ATTRIBUTES
     */

    public function getIsAdminAttribute(): bool
    {
        return $this->role === self::ADMIN_ROLE;
    }

    public function getFullNameAttribute(): string
    {
        return ucfirst(strtolower($this->firstname)) . ' ' . ucfirst(strtolower($this->lastname));
    }

    public function getAddressAttribute(): ?Address
    {
        return $this->addresses
            ->firstWhere('is_main', true);
    }

    public function getBillingAddressAttribute(): ?Address
    {
        return $this->addresses
            ->firstWhere('is_billing', true);
    }

    public function getItemsCountAttribute(): int
    {
        return $this->orders->sum('order_items_count');
    }

    public function getFormattedSpentAttribute(): int
    {
        return number_format($this->orders->sum('price') / 100, 2);
    }

    /**
     * ? SCOPES
     */

    public function scopeAdministrators(Builder $query): Collection
    {
        return $query->where('role', self::ADMIN_ROLE)->get();
    }

    public function scopeAdminNotifications(): MorphMany
    {
        return $this->notifications()->whereNull('read_at')->orWhere(function ($query) {
            $query->whereDate('created_at', '>', now()->subDays(7));
        });
    }

    /**
     * ? RELATIONS
     */

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function availabilityNotifications(): HasMany
    {
        return $this->hasMany(ProductNotification::class);
    }

    public function refunds(): HasMany
    {
        return $this->hasMany(Refund::class);
    }

    /**
     * ? Packages methods
     */

    public function selectPersonalData(PersonalDataSelection $personalData): void
    {
        $personalData
            ->add('user.json', [
                'prénom' => $this->firstname,
                'nom' => $this->lastname,
                'email' => $this->email,
                'adresse' => $this->address
                    ? $this->address->street
                        . ' '
                        . $this->address->zipcode
                        . ' '
                        . $this->address->city
                        . ' '
                        . $this->address->country->name
                        . ' '
                        . $this->address->phone
                    : 'Non renseigné',
            ])
        ;
    }

    public function personalDataExportName(): string
    {
        $userName = Str::slug($this->full_name);

        return "beehemiam-donnees-personnelles-{$userName}.zip";
    }
}
