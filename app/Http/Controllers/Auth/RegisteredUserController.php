<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \App\Http\Requests\Auth\RegisterUserRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request)
    {
        Auth::login($user = User::create([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'newsletter' => $request->get('newsletter') ?? false,
            'role' => User::USER_ROLE,
        ]));

        event(new Registered($user));

        return redirect()->intended(route('user.profile.dashboard'))->with([
            'type' => 'Succès',
            'message' => "Votre compte a bien été créé sur Beehemiam.fr ! 
                Pensez à confirmer votre adresse email depuis votre messagerie."
        ]);
    }
}
