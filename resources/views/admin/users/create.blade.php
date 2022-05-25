@extends('layouts.layout')
@section('topmenu')
    <nav class="card">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sn:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            <a href="{{route('admin.users.index')}}" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Overzicht User</a>
                            <a href="{{route('admin.users.create')}}" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">User Toevoegen</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')

    @if($errors->any())
        <div class="bg-red-300 text-red-900 roundend-lg shadow-md p-6 pr-10 mb-10">

            <ul class="mt-3 list-disc list-inside text-sn text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error  }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
        <div class="p-4">
        <form method="POST" class="shadow-md rounded-lg px-8 pt-6 pb-8 mb-4" action="{{ route('user.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm">
                    Account naam:
                <input id="name" class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" type="text" name="name" value="{{old('name')}}" required autofocus />
                @error('name') <span class="text-xs text-red-600"> De naam voldoet niet aan de voorwaarde</span> @enderror
                </label>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <label for="email" class="block text-sm" >
                E-mail:
                <input id="email" class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" type="email" name="email" value="{{old('email')}}" required />
                @error('E-mail') <span class="text-xs text-red-600"> De E-mail voldoet niet aan de voorwaarde</span> @enderror
                </label>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm" >
                Wachtwoord:
                <input id="password" class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                type="text"
                                name="password"
                                required autocomplete="new-password"  />
                </label>
            </div>
                <div class="mt-4">
                    <label for="role" class="block text-sm" >
                        Rol:
                        <select name="role">
                            <option value="user">user</option>
                            <option value="salesperson">salesperson</option>
                            <option value="admin">admin</option>
                        </select>
                    </label>
                </div>

            <!-- Confirm Password -->

            <div class="flex items-center justify-end mt-4">


                <button class="mt-2">Maak account
                </button>
            </div>
        </form>
        </div>
    </div>
@endsection
