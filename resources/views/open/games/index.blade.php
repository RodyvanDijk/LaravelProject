@extends('layouts.layout')

@section('topmenu')
    <nav class="card bg-white">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-20">
                            <a href="{{ route('open.categories.index') }}" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Overzicht Categories</a>
                            <a href="{{ route('open.games.index') }}" class="text-gray-800 px-3 py-2 rounded-md text-sm font-medium">Overzicht Games</a>
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

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="card-body">
                    <div class="bg-red-400 text-red-800 rounded-lg shadow-md p-6 pr-10 mb-8" style="...">{{$error}}</div>
                </div>
            @endforeach
        </div>
    @endif

    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
            <th class="px-4 py-3">Game</th>
            <th class="px-4 py-3">Category</th>
            <th class="px-4 py-3">Price</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y">
        @foreach($games as $item)
            <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm">{{ $item->game }}</td>
                <td class="px-4 py-3 text-sm">{{$item-> category->name}}</td>
                <td class="px-4 py-3 text-sm">{{$item->price}}</td>
                <td class="px-4 py-3 text-sm">
                    <form action="{{route('cart.store')}}" method="POST" class="flex flex-row">
                        @csrf
                        <input type="hidden" name="game_id" value="{{$item->id}}">
                        <input type="number" value="1" name="quantity" min="1" max="9" class="text-sm sm:text-base px-2 pr-2 rounded-lg border border-gray-400 py-1 focus:outline-none focus:border-blue-400">
                        <button type="submit" id="add-{{$item->id}}" class="flex flex-row items-center gap-3 bg-blue-700 px-4 rounded hover:bg-blue-500">
                            <p class="text-white">Toevoegen</p>
                            <i class="fad fa-shopping-cart text-xs mr-2 text-white"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

