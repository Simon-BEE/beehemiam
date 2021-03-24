@extends('layouts.guest')

@section('meta-title')
    {{ __('Forgot your password?') }}
@endsection

@section('content')
<div class="flex items-center justify-center px-6 pb-8 h-full w-full lg:w-1/2 mx-auto">
    <div class="w-full">
        <h1 class="my-8 text-2xl font-semibold tracking-tighter sm:text-3xl text-center">
            {{ __('Forgot your password?') }}
        </h1>

        <div class="mb-4 text-sm">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <x-form.form method="POST" action="{{ route('password.email') }}">
            <x-form.input
                name="email"
                type="email"
                label="Adresse email"
                placeholder="Votre adresse email"
                value="{{ old('email') }}"
                required
            />

            <x-form.button class="block w-full bg-primary-500 text-white font-bold hover:bg-primary-600 mt-4">
                {{ __('Email Password Reset Link') }}
            </x-form.button>
        </x-form.form>
    </div>
</div>
@endsection

