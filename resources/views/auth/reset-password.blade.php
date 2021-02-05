@extends('layouts.guest')

@section('meta-title')
    {{ __('Reset Password') }}
@endsection

@section('content')
<div class="flex items-center justify-center px-6 h-full w-full lg:w-1/2 mx-auto">
    <div class="w-full">
        <h1 class="my-8 text-2xl font-semibold tracking-tighter text-gray-700 sm:text-3xl text-center">
            {{ __('Reset Password') }}
        </h1>

        <x-form.form method="POST" action="{{ route('password.update') }}">
            <x-form.input 
                name="email"
                type="email"
                label="Adresse email"
                placeholder="Votre adresse email"
                value="{{ old('email') }}"
                required
            />
            <x-form.input 
                name="password"
                type="password"
                label="Mot de passe"
                placeholder="Votre mot de passe"
                required
            />
            <x-form.input 
                name="password_confirmation"
                type="password"
                label="Confirmation du mot de passe"
                placeholder="Confirmez votre mot de passe"
                required
            />

            <x-form.button class="block w-full bg-yellow-500 text-gray-900 font-bold hover:bg-yellow-600 mt-4">
                {{ __('Reset Password') }}
            </x-form.button>
        </x-form.form>
    </div>
</div>
@endsection
