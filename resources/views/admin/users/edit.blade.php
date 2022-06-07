
@extends('layouts.layout')
@section('topmenu')
    <nav class="card">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sn:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            <a href="{{route('user.index')}}" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Overzicht user</a>
                            <a href="{{route('user.create')}}" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">user Toevoegen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="card mt-6">
        @if(session('error'))
            <div class="card-body">
                <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('error')}}</div>
            </div>

        @endif

        <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
            <div class="p-4">

                <form id="form" class="shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" action="{{route('user.update', ['user' => $user->id])}}" method="POST">
                    @method('PUT')
                    @csrf
                    <label class="block text-sm">
                        <span class="text-gray-700">Name</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input
                               @error('name') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                               name="name" value="{{old('name',$user->name)}}" type="text" required>
                        @error('name') <span class="text-xs text-red-600"> De user naam voldoet niet aan de voorwaarde</span> @enderror
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">email</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" name="email"
                               value="{{old('email',$user->email)}}" type="text" required>
                    </label>
                    <label for="role" class="block text-sm" >
                        Rol:
                        <select name="role" >
                            <option value="">Select rol</option>
                            <option value="user">user</option>
                            <option value="salesperson">salesperson</option>
                            <option value="admin">admin</option>
                        </select>
                    </label>

                    <button id="submit" class="mt-2">Update</button>
                </form>
            </div>





        </div>
@endsection
