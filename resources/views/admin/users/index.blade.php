
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
    <div class="card mt-6">
    <div class="card-header flex flex-row justify-between">
        <h1 class="h6">User Admin</h1>
    </div>

        @if(session('status'))
            <div class="card-body">
                <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('status')}}</div>
            </div>

        @endif
        @if(session('status-wrong'))
            <div class="card-body">
                <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('status-wrong')}}</div>
            </div>

        @endif



<div class="card-body">
    <table>
        <thead>
        <th>name</th>
        <th>Email</th>
        <th>Role</th>
        <th>detail</th>
        <th>edit</th>
        <th>delete</th>
        </thead>
        <tbody class="divide-y">
        @foreach($users as $User)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm">{{$User->name}}</td>
                <td class="px-4 py-3 text-sm">{{$User->email}}</td>
                <td class="px-4 py-3 text-sm">@foreach ($User->getRoleNames() as $role )
                                                  {{$role}}
                    @endforeach
    </td>
                <td class="px-4 py-3 text-sm"><a href="{{route('user.show', ['user' => $User->id] )}}">Details</a></td>

                <td class="px-4 py-3 ">Edit</td>
                <td>Delete</td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>

    </div>
@endsection

