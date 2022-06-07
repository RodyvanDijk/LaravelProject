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

@section('content')
    <div class="card mt-6 bg-white">
        <!--header-->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6"><strong>Category Admin</strong></h1>
        </div>
        <!--end header-->

        <!--errors-->
        @if($errors->any())
            <div class="bg-red-200 text-red-900 rounded-lg shadow-md p-6 pr-10 mb-8"
                 style="...">
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
    @endif
    <!--end errors-->

        <!--body-->
        <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
            <div class="p-4">
                <form id="form" class="shadow-md rounded-lg px-8 pt-6 pb-8 mb-4"
                      action="{{route('category.update', ['category' => $category->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <label class="block text-sm">
                        <span class="text-gray-700">Category</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input
                        @error('name') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                               name="name" value="{{old('name', $category->name)}}" type="text" required />
                    </label>
                    <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-black bg-gray transition-colors duration-150
                     bg-purple-600 border border-4 rounded-lg active:bg-purple-600 hover:bg-purple-700
                     focus:outline-none focus:shadow-outline-purple" id="update">Wijzigen</button>
                </form>
            </div>
        </div>
        <!--end body-->
    </div>
@endsection

@endsection
