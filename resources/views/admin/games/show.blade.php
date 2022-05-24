@extends('layouts.layout')

@section('topmenu')
    <nav class="card bg-white">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-20">
                            <a href="{{ route('games.index') }}" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Overzicht Games</a>
                            <a href="{{ route('games.create') }}" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Game Toevoegen</a>
                            <a href="{{ route('category.index') }}" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Overzicht Categories</a>
                            <a href="{{ route('category.create') }}" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Category Toevoegen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="card mt-6">
        <!--header-->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Game Admin</h1>
        </div>
        <!--end header-->

        <!--content-->
        <div class="py-4 px-6">
            <h2 class="text-lg font-semibold text-gray-800">Game details</h2>
            <p class="py-2 text-lg text-gray-700">Game: {{$game->game}}</p>
            <p class="py-2 text-lg text-gray-700">Beschrijving: {{$game->description}}</p>
            <p class="py-2 text-lg text-gray-700">Categorie: {{$game->category->name}}</p>
            <p class="py-2 text-lg text-gray-700">Prijs: {{$game->price}}</p>
            <p class="py-2 text-lg text-gray-700">Gemaakt op: {{$game->created_at}}</p>
            <p class="py-2 text-lg text-gray-700">Aangepast op: {{$game->updated_at}}</p>
        </div>
        <!--end content-->
    </div>
@endsection
