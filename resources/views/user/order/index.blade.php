@extends('layouts.layout')

@section('content')

    <div class="card mt-6">
        <!-- Header -->
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Bestellingen</h1>
        </div>
        <!-- End header -->

        <!-- Status -->
        @if(session('status'))
            <div class="card-body">
                <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8" style="...">{{session('status')}}</div>
            </div>
        @endif
        @if(session('status-wrong'))
            <div class="card-body">
                <div class="bg-red-400 text-red-800 rounded-lg shadow-md p-6 pr-10 mb-8" style="...">{{session('status-wrong')}}</div>
            </div>
        @endif
        <!-- End status -->
    </div>

    <!-- Content -->
    @if(empty($order_rows))
        <div class="card-body">
            <div class="bg-orange-300 text-orange-800 rounded-lg shadow-md p-6 pr-10 mb-8 mt-6" style="...">Er zijn geen bestellingen gevonden.</div>
        </div>
    @else
    <table class="w-full whitespace-no-wrap">
        <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
            <th class="px-4 py-3">Order ID</th>
            <th class="px-4 py-3">Game</th>
            <th class="px-4 py-3">Hoeveelheid</th>
            <th class="px-4 py-3">Datum Geplaatst</th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y border-gray-600 border">
        @foreach($order_rows as $order_row)
            <tr>
                <td class="px-4 py-3 text-sm bg-gray-600 text-white">{{ $order_row[0]->order_id}}</td>
                <td class="bg-gray-600 border-gray-600"></td>
                <td class="bg-gray-600"></td>
                <td class="bg-gray-600"></td>
            </tr>
            @foreach($order_row as $row)
                <div class="hidden">{{$game = \App\Models\Game::findOrFail($row->game_id)}}</div>
                <tr class="text-gray-700">
                    <td></td>
                    <td class="px-4 py-3 text-sm">{{ $game->game}}</td>
                    <td class="px-4 py-3 text-sm">{{ $row->quantity}}</td>
                    <td class="px-4 py-3 text-sm">{{ $row->updated_at}}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
    @endif
    <!-- End content -->

@endsection
