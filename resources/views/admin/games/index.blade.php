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
            <h1 class="h6">Games</h1>
        </div>
        <!--end header-->

    </div>
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
            <th class="px-4 py-3">Game</th>
            <th class="px-4 py-3">Category</th>
            <th class="px-4 py-3">Price</th>
            <th class="px-4 py-3">Edit</th>
            <th class="px-4 py-3">Delete</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y">
                @foreach($games as $item)
        <tr class="text-gray-700">
            <td class="px-4 py-3 text-sm">{{ $item->game }}</td>
            <td class="px-4 py-3 text-sm">{{ $item->category_id }}</td>
            <td class="px-4 py-3 text-sm">{{ $item->price }}</td>
            <td class="px-4 py-3 text-sm">Edit</td>
            <td class="px-4 py-3 text-sm">Delete</td>
        </tr>
                @endforeach
        </tbody>
    </table>

@endsection
