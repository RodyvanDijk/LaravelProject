
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

        <div class="py-4 px-6 card-body">
            <h2>Project details</h2>
            <table>
                <thead >
                <tr>
                    <td>id</td>
                    <td>name</td>
                    <td>description</td>
                    <td>Create datum</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$project->id}}</td>
                    <td>{{$project->name}}</td>
                    <td>{{$project->description}}</td>
                    <td>{{$project->created_at}}</td>

                </tr>
                </tbody>
            </table>

        </div>
    </div>




@endsection
