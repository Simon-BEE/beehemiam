<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateUserPasswordRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Users\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditUserController extends Controller
{
    public function edit(User $user): View
    {
        return view('admin.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRepository $repository, UpdateUserRequest $request, User $user): RedirectResponse
    {
        try {
            $repository->update($user, $request->validated());

            return redirect()->route('admin.users.show', $user)->with([
                'type' => 'Succès',
                'message' => 'Le client a bien été modifié !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }

    public function updatePassword(UserRepository $repository, UpdateUserPasswordRequest $request, User $user): RedirectResponse
    {
        try {
            $repository->updatePassword($user, $request->get('password'));

            return redirect()->route('admin.users.show', $user)->with([
                'type' => 'Succès',
                'message' => 'Le client a bien été modifié !',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
