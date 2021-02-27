<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ShowUserController extends Controller
{
    public function show(User $user): View
    {
        abort_if($user->is_admin, 403, 'Vous ne pouvez afficher cette page.');

        return view('admin.users.show', [
            'user' => $user->load(['addresses']),
        ]);
    }

    public function orders(User $user): View
    {
        return view('admin.users.orders', [
            'user' => $user,
            'orders' => $user->orders()->paginate(),
        ]);
    }

    public function sendEmailVerification(UserRepository $repository, User $user): RedirectResponse
    {
        if ($user->hasVerifiedEmail()) {
            return back();
        }

        try {
            $repository->resendEmailVerification($user);

            return back()->with([
                'type' => 'Succès',
                'message' => 'Le client va recevoir un nouveau mail de vérification !',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
