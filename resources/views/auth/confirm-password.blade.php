@extends('layouts.guest')

@section('meta-title')
    {{ __('Confirm Password') }}
@endsection

@section('content')
<div class="flex items-center justify-center px-6 h-full w-full lg:w-1/2 mx-auto">
    <div class="w-full">
        <h1 class="my-8 text-2xl font-semibold tracking-tighter text-gray-700 sm:text-3xl text-center">
            {{ __('Confirm Password') }}
        </h1>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-form.form method="POST" action="{{ route('password.confirm') }}">
            <x-form.input 
                name="password"
                type="password"
                label="Mot de passe"
                placeholder="Votre mot de passe"
                required
                autocomplete="current-password"
            />

            <x-form.button class="block w-full bg-yellow-500 text-gray-900 font-bold hover:bg-yellow-600 mt-4">
                {{ __('Confirm') }}
            </x-form.button>
        </x-form.form>
    </div>
</div>
@endsection

