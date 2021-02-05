@extends('layouts.guest')

@section('meta-title')
    {{ __('Create Account') }}
@endsection

@section('content')
<div class="hidden lg:block lg:w-1/2 h-full">
    <img src="https://source.unsplash.com/random/400x600" alt="image d'inscription" class="object-cover w-full md:h-full rounded-l-xl">
</div>
<div class="flex items-center justify-center px-6 py-8 h-full w-full lg:w-1/2">
    <div class="w-full">
        <h1 class="my-4 text-2xl font-semibold tracking-tighter text-gray-700 sm:text-3xl text-center">
            {{ __('Create Account') }}
        </h1>

        <x-form.form method="POST" action="{{ route('register') }}">
            <x-form.input 
                name="firstname"
                type="text"
                label="Prénom"
                placeholder="Votre prénom"
                value="{{ old('firstname') }}"
                required
            />
            <x-form.input 
                name="lastname"
                type="text"
                label="Nom de famille"
                placeholder="Votre nom de famille"
                value="{{ old('lastname') }}"
                required
            />
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

            <x-form.checkbox name="newsletter">
                Je souhaite être mis au courant des dernières nouveautés de <strong>Beehemiam</strong>
            </x-form.checkbox>

            <x-form.checkbox name="terms">
                J'ai lu et je suis d'accord avec <a href="#" class="underline">les CGU</a> et <a href="#" class="underline">les CGV</a>
            </x-form.checkbox>

            <x-form.button class="block w-full bg-yellow-500 text-gray-900 font-bold hover:bg-yellow-600 mt-4">
                {{ __('Create Account') }}
            </x-form.button>
        </x-form.form>

        <hr class="w-full my-3 border-gray-300">

        <p class=" text-center">
            {{ __('Already registered?') }} 
            <a href="{{ route('login') }}" class="font-semibold text-gray-500 hover:text-gray-700">Se connecter</a>
        </p>
    </div>
</div>
@endsection