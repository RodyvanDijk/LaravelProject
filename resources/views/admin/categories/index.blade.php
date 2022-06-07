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
            <h1 class="h6">Categories</h1>
        </div>
        <!--end header-->
        <!--status-->
        @if(session('status'))
            <div class="card-body">
                <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8" style="...">{{session('status')}}</div>
            </div>
        @endif
        @if(session('status-wrong'))
            <div class="card-body">
                <div class="bg-red-400 text-red-800 rounded-lg shadow-md p-6 pr-10 mb-8" style="...">{{session('status-wrong')}}</div>
            </div>
    @endif
    <!--end status-->
    </div>
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
            <th class="px-4 py-3">ID</th>
            <th class="px-4 py-3">Name</th>
            <th class="px-4 py-3">Details</th>
            <th class="px-4 py-3">Edit</th>
            <th class="px-4 py-3">Delete</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y">
        @foreach($categories as $item)
            <tr class="text-gray-700">
                <td class="px-4 py-3 text-sm">{{ $item->id }}</td>
                <td class="px-4 py-3 text-sm">{{ $item->name }}</td>
                <td class="px-4 py-3 text-sm"><a id="show-{{$item->id}}" href="{{ route('category.show', ['category' => $item->id]) }}">Details</a></td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm">
                        <a id="edit-{{$item->id}}" href="{{route('category.edit', ['category' => $item->id])}}"><button class="flex items-center
                        justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none
                        focus:shadow-outline-gray" aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379
                                                5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg></button> </a>
                    </div> </td>
{{--                            @can('delete product')--}}
                <td>
                    <div class="flex items-center space-x-4 text-sm">
                        <a id="delete-{{$item->id}}" href="{{ route('category.delete', ['category' => $item->id]) }}">
                            <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600
                                    rounded-lg focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0
                                            002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0
                                            00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
