
@extends('layouts.layout')
@section('topmenu')
    <nav class="card">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sn:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            <a href="" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Overzicht Project</a>
                            <a href="" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Project Toevoegen</a>
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
        <h1 class="h6">Project Admin</h1>
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
        <th>id</th>
        <th>name</th>
        <th>details</th>
        <th>edit</th>
        <th>delete</th>
        </thead>
        <tbody class="divide-y">
        @foreach($projects as $project)
            <tr class="text-gray-700 dark:text-gray-400">
                <td class="px-4 py-3 text-sm">{{$project->id}}</td>
                <td class="px-4 py-3 text-sm">{{$project->name}}</td>
                <td class="px-4 py-3 text-sm"><a href="{{route('projects.show', ['project' => $project->id] )}}">Details</a></td>
                <td class="px-4 py-3 "><a href="{{route('projects.edit', ['project' => $project->id] )}}">Edit</a></td>
                <td><a href="{{route('projects.delete', ['project' => $project->id] )}}">Delete</a></td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>

    </div>
@endsection

