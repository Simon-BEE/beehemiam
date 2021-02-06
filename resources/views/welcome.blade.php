@extends('layouts.app')

@section('content')
    @if (Route::has('login'))
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
        @auth
            <a href="{{ route('user.dashboard') }}" class="text-sm text-gray-700 underline">Mon Compte</a>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">{{ __('Login') }}</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">{{ __('Create Account') }}</a>
            @endif
        @endauth
    </div>
    @endif

    <div class="mt-20">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi ab dolores atque ullam voluptate earum voluptates repudiandae sunt in impedit, blanditiis quod! Accusamus porro, distinctio illo vitae in doloribus enim!
    </div>
@endsection