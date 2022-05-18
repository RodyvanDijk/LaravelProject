@extends('layouts.layout')
@section('topmenu')
    <nav class="card">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="flex-1 flex items-center justify-center sn:items-stretch sm:justify-start">
                    <div class="sm:block sm:ml-6">
                        <div class="flex space-x-4">

                            <a href="" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Overzicht
                                Task</a>
                            <a href="" class="text-gray-800 hover:text-teal-600 transition ease-in-out duration-150">Task
                                Toevoegen</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@section('content')
    <div class="card mt-6 bg-white">
        <!--header-->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6"><strong>Task Admin</strong></h1>
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
                      action="{{route('tasks.store')}}" method="POST">
                    @csrf
                    <label class="block text-sm">
                        <span class="text-gray-700">Task</span>
                        <input class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input
                        @error('Task') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                               name="task" value="{{old('task')}}" type="text" required />
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">begindate</span>
                        <input type="date" class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input
                        @error('begindate') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                                  name="begindate" required >{{old('begindate')}}
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">enddate</span>
                        <input type="date" class="bg-gray-200 block rounded w-full p-2 mt-1 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input
                        @error('enddate') border-red-600 focus:border-red-400 focus:shadow-outline-red @enderror"
                               name="enddate">{{old('enddate')}}
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">user</span>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 ldeading-tight
                                focus:outline-none focus:shadow-outline" name="user_id" id="category_id">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @selected($user->id == old('user_id'))>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">project</span>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 ldeading-tight
                                focus:outline-none focus:shadow-outline" name="project_id" id="category_id">
                            @foreach($projects as $project)
                                <option value="{{$project->id}}" @selected($project->id == old('user_id'))>{{$project->name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700">activity</span>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 ldeading-tight
                                focus:outline-none focus:shadow-outline" name="activity_id" id="category_id">
                            @foreach($activitys as $activity)
                                <option value="{{$activity->id}}" @selected($activity->id == old('user_id'))>{{$activity->name}}</option>
                            @endforeach
                        </select>
                    </label>
                    <button class="mt-2 px-4 py-2 text-sm font-medium leading-5 text-black bg-gray transition-colors duration-150
                     bg-purple-600 border border-4 rounded-lg active:bg-purple-600 hover:bg-purple-700
                     focus:outline-none focus:shadow-outline-purple">Toevoegen</button>
                </form>
            </div>
        </div>
        <!--end body-->
    </div>
@endsection
