@extends('layouts.guest')

@section('meta-title')
    {{ __('Reset Password') }}
@endsection

@section('content')
<div class="flex items-center justify-center px-6 pb-8 h-full w-full lg:w-1/2 mx-auto">
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
                helper="Le mot de passe doit contenir au moins 8 caractères."
                required
            />
            <x-form.input 
                name="password_confirmation"
                type="password"
                label="Confirmation du mot de passe"
                placeholder="Confirmez votre mot de passe"
                required
            />

            <x-form.button class="block w-full bg-primary-500 text-gray-900 font-bold hover:bg-primary-600 mt-4">
                {{ __('Reset Password') }}
            </x-form.button>
        </x-form.form>
    </div>
</div>
@endsection
