<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Repositories\Users\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EditUserController extends Controller
{
    public function edit(): View
    {
        return view('user.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(UserRepository $repository, UpdateUserRequest $request): RedirectResponse
    {
        try {
            $repository->update(auth()->user(), $request->validated());

            return back()->with([
                'type' => 'Succès',
                'message' => 'Vos informations ont bien été mises à jour.',
            ]);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), 1);
        }
    }
}
