<?php

namespace App\Repositories\Users;

use App\Events\PasswordEdited;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function update(User $user, array $validatedData): User
    {
        return tap($user)->update(array_merge($validatedData, [
            'newsletter' => isset($validatedData['newsletter']),
        ]));
    }

    public function updatePassword(User $user, string $newPassword): User
    {
        $user->update([
            'password' => Hash::make($newPassword),
        ]);

        PasswordEdited::dispatch($user);

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function resendEmailVerification(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
