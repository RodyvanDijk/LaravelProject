@extends('layouts.layout')


@section('content')
    <div class="card  mt-6">
            <div class="card-header flex flex-row justify-between">
                    <h1 class="h6">Error</h1>
            </div>
    </div>


    <div class="card-body grid grid-cols-1 gap-6 lg:grid-cols-1">
        <div class="p-4">
            <div class="aler alert-error">
                {{$exception->getMessage() }}
            </div>
        </div>

    </div>
@endsection


