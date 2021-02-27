<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use Exception;
use Illuminate\Http\RedirectResponse;

class UserProfileController extends Controller
{
    public function sendEmailVerification(UserRepository $repository): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        if ($user->hasVerifiedEmail()) {
            return back();
        }

        try {
            $repository->resendEmailVerification($user);

            return back()->with([
                'type' => 'Succès',
                'message' => 'Vous allez recevoir un nouvel e-mail de vérification.',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
