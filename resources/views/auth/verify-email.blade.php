@extends('layouts.guest')

@section('meta-title')
    {{ __('Verify Email Address') }}
@endsection

@section('content')
<div class="flex flex-col items-center justify-center px-6 pb-8 h-full w-full lg:w-1/2 mx-auto">

    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="w-full">
        <h1 class="my-8 text-2xl font-semibold tracking-tighter text-gray-700 sm:text-3xl text-center">
            {{ __('Verify Email Address') }}
        </h1>

        <x-form.form method="POST" action="{{ route('verification.send') }}">

            <x-form.button class="block w-full bg-primary-500 text-gray-900 font-bold hover:bg-primary-600 mt-4">
                {{ __('Resend Verification Email') }}
            </x-form.button>

        </x-form.form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                {{ __('Logout') }}
            </button>
        </form>
    </div>
</div>
@endsection
