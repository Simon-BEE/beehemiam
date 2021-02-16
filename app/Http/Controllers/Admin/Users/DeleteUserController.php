<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Http\RedirectResponse;

class DeleteUserController extends Controller
{
    public function __invoke(UserRepository $repository, User $user): RedirectResponse
    {
        try {
            $repository->delete($user);

            return redirect()->route('admin.users.index')->with([
                'type' => 'Succès',
                'message' => 'Le client a bien été supprimé !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
