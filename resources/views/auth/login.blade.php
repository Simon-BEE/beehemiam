@extends('layouts.guest')

@section('meta-title')
    {{ __('Login') }}
@endsection

@section('content')
<div class="hidden lg:block lg:w-1/2 h-60-screen">
    <img src="https://source.unsplash.com/random/400x600" alt="image de connexion" class="object-cover w-full md:h-60-screen rounded-l-xl">
</div>
<div class="flex items-center justify-center px-6 pb-8 h-full w-full lg:w-1/2">
    <div class="w-full">
        <h1 class="my-8 text-2xl font-semibold tracking-tighter sm:text-3xl text-center">
            {{ __('Login') }}
        </h1>

        <x-form.form method="POST" action="{{ route('login') }}">
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

            <x-form.checkbox name="remember">
                Se souvenir de moi ?
            </x-form.checkbox>

            <div class="mt-2 text-right">
                <a href="{{ route('password.request') }}" class="text-sm font-semibold leading-relaxed text-kaki-800 hover:text-kaki-900 focus:text-gray-700">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
            <x-form.button class="block w-full bg-primary-500 text-white font-bold hover:bg-primary-600 mt-4">
                {{ __('Login') }}
            </x-form.button>
        </x-form.form>

        <hr class="w-full my-6 border-gray-300">

        <p class="md:mt-8 text-center">
            {{ __('Need an account?') }}
            <a href="{{ route('register') }}" class="font-semibold text-kaki-800 hover:text-kaki-900">{{ __('Create Account') }}</a>
        </p>
    </div>
</div>
@endsection
