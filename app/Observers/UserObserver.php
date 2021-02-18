<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UserObserver
{
    /**
     * Handle the User "saved" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        Cache::put("user.{$user->id}", $user, 60);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        Cache::put("user.{$user->id}", $user, 60);
    }

    /**
     * Handle the User "retrieved" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function retrieved(User $user)
    {
        Cache::put("user.{$user->id}", $user, 60);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        Cache::forget("user.{$user->id}");
    }
}
