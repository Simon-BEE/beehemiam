<?php

namespace App\Repositories\Users;

use App\Models\User;

class UserRepository
{
    public function delete(User $user): void
    {
        abort_if($user->is_admin, 403);

        $user->delete();
    }

    public function resendEmailVerification(User $user): void
    {
        $user->sendEmailVerificationNotification();
    }
}
