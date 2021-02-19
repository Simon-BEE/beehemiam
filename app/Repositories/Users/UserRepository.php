<?php

namespace App\Repositories\Users;

use App\Events\PasswordEdited;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\PersonalDataExport\Jobs\CreatePersonalDataExportJob;

class UserRepository
{
    public function update(User $user, array $validatedData): User
    {
        if (!auth()->user()->is_admin && $user->email !== $validatedData['email']) {
            $validatedData['email_verified_at'] = null;
        }

        $user = tap($user)->update(array_merge($validatedData, [
            'newsletter' => isset($validatedData['newsletter']),
        ]));

        if (!$user->hasVerifiedEmail()) {
            $this->resendEmailVerification($user);
        }

        return $user;
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

    public function exportPersonnalData(User $user): void
    {
        dispatch(new CreatePersonalDataExportJob($user));
    }
}
