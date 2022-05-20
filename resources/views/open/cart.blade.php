@extends('layouts.layout')

@section('content')
    <div class="card mt-6">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Winkelwagen</h1>
        </div>
        <div class="card-body">
            <div class="flex flex-wrap items-center lg:justify-between justify-center">
                @for($i = 1; $i < 6; $i++)
                    <div
                        class="focus:outline-none mx-2 w-72 xl:mb-0 mb-8 flex flex-wrap w-full border-gray-400 border-b">
                        <div class="p-4 flex flex-row gap-12 w-full">
                            <div class="w-1/4">
                            <img class="h-40 rounded object-cover object-center mb-6"
                                 src="https://dummyimage.com/720x400" alt="content">
                            </div>
                            <div class="flex items-center flex-col w-1/2">
                                <h2 tabindex="0" class="focus:outline-none text-lg font-semibold self-start">
                                    Titel</h2>
                                <p class="self-start text-gray-600">Categorie</p>
                                <p class="focus:outline-none text-xs text-gray-600 mt-2">Lorem ipsum dolor sit amet,
                                    consectetur adipisicing elit. Reiciendis, ullam, vitae. Eius, eligendi harum in
                                    omnis praesentium provident sit veritatis vitae. Autem, cupiditate doloremque
                                    ducimus ea itaque molestiae porro quod?</p>
                            </div>
                            <div class="flex items-center flex-col p-4 gap-3">
                                <div class="flex flex-row items-center">
                                    <form>
                                        <label class="text-gray-700">
                                            Aantal
                                            <select>
                                                @for($i1 = 1; $i1 <= 10; $i1++)
                                                    <option>{{$i1}}</option>
                                                @endfor
                                            </select>
                                        </label>
                                    </form>
                                </div>
                                <div>
                                    <div>
                                        <a class="flex flex-row items-center">
                                            <button class="flex items-center justify-between text-sm font-medium leading-5 text-blue-700
                                        rounded-lg focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                     viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0
                                                002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0
                                                00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                            <p class="text-blue-700">
                                                Verwijder
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-black font-bold p-4 text-lg">€{{rand(1, 10) * rand(1, 10) + rand(1, 10)}},{{rand(0,99)}}</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
