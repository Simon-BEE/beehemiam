@extends('layouts.app')

@section('meta-title')
    Mon compte
@endsection

@section('content')

<div class="absolute top-2 left-3">
    <a href="{{ route('welcome') }}" class="p-3 flex items-center text-sm uppercase font-bold text-gray-600 hover:bg-gray-100">
        <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24">
            <path fill="currentColor" d="M18.41,7.41L17,6L11,12L17,18L18.41,16.59L13.83,12L18.41,7.41M12.41,7.41L11,6L5,12L11,18L12.41,16.59L7.83,12L12.41,7.41Z" />
        </svg>
        Retourner à l'accueil
    </a>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                Vous êtes connecté !
            </div>
        </div>
    </div>
</div>
@endsection