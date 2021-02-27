<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use App\Exceptions\User\CannotDeleteUserAccountException;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsUserController extends Controller
{
    public function index(): View
    {
        return view('user.settings', [
            'user' => auth()->user(),
        ]);
    }

    public function personnalData(UserRepository $repository): RedirectResponse
    {
        try {
            $repository->exportPersonnalData(auth()->user());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Vos données sont en préparation. Un email va vous être envoyé pour les récupérer.',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    public function emailDeleteAccount(UserRepository $repository): RedirectResponse
    {
        try {
            $repository->askToDeleteAccount(auth()->user());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Un email vous permettant de supprimer votre compte vient de vous être envoyé.',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }

    public function deleteAccount(UserRepository $repository, User $user): RedirectResponse
    {
        try {
            $repository->deleteAccount($user);

            return redirect()->route('welcome')->with([
                'type' => 'Succès',
                'message' => 'Votre compte est désormais supprimé. On espère vous revoir très vite.',
            ]);
        } catch (CannotDeleteUserAccountException $e) {
            return redirect()->route('user.profile.dashboard')->with([
                'type' => 'Erreur',
                'message' => 'Une erreur est survenue, nous ne pouvons compléter la requête demandée.',
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), 1);
        }
    }
}
