<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Users\UserRepository;
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
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
