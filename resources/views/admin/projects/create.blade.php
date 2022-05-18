
@extends('layouts.layout')
@section('topmenu')
    <nav class="card">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sn:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            <a href="" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Overzicht Category</a>
                            <a href="" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Category Toevoegen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="card mt-6">

            <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
                <div class="p-4">

                <form id="form" class="shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" action="{{route('projects.store')}}" method="POST">
                @csrf
                    <label class="block text-sm">
                        <span class="text-gray-700">Name</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input
                               @error('name') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                               name="name" value="{{old('name')}}" type="text" required>
                        @error('name') <span class="text-xs text-red-600"> De categorie naam voldoet niet aan de voorwaarde</span> @enderror
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">Description</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" name="description"
                               value="{{old('description')}}" type="text" required>
                    </label>

                    <button class="mt-2">Toevoegen</button>
                </form>
                </div>





    </div>
@endsection

