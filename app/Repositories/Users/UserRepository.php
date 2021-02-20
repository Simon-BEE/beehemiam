<?php

namespace App\Repositories\Users;

use App\Events\PasswordEdited;
use App\Exceptions\CannotDeleteUserAccountException;
use App\Mail\Users\UserAccountDeletedMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function askToDeleteAccount(User $user): void
    {
        DB::transaction(function () use ($user) {
            DB::table('delete_users')->upsert([
                'email' => $user->email,
                'created_at' => now(),
            ], 'email');
        });

        $user->sendEmailToDeleteAccount();
    }

    public function deleteAccount(User $user): void
    {
        if (!DB::table('delete_users')->where('email', $user->email)->whereNull('deleted_at')->exists()) {
            throw new CannotDeleteUserAccountException(
                'Une erreur est survenue, nous ne pouvons compléter la requête demandée.',
                1
            );
        }

        DB::table('delete_users')->where('email', $user->email)->update(['deleted_at' => now()]);

        Auth::logout();

        $user->delete();

        notify_administrators("Un utilisateur vient de supprimer son compte.");
        
        Mail::to($user->email)->send(new UserAccountDeletedMail);
    }
}
