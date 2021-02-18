<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Cache;

class CacheUserProvider extends EloquentUserProvider
{
    public function __construct(Hasher $hasher)
    {
        parent::__construct($hasher, User::class);
    }

    public function retrieveById($identifier): ?Authenticatable
    {
        return Cache::get("user.$identifier") ?? parent::retrieveById($identifier);
    }
}
