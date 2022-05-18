@extends('layouts.layout')

@section('content')
<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-wrap -m-4">
            <div class="p-4 md:w-1/3">
                <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">

                @foreach($projects as $project)
                <div tabindex="0" class="focus:outline-none mx-2 w-72 xl:mb-0 mb-8">
                    <div class="bg-gray-100 rounded-lg m-4">
                        <div class="p-4">
                            <img class="h-40 rounded w-full object-cover mb-6" src="https://dummyimage.com/720x400" alt="content">
                            <div class="flex items-center">
                                <h2 tabindex="0" class="focus:outline-none text-lg front-semibold">{{$project->name}}</h2>
                            </div>
                            <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2">{{$project->description}}</p>
                        </div>
                    </div>
                 </div>
                @endforeach
                    <div class="text-xs">
                    {{ $projects->links() }};
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
