@extends('layouts.layout')

@section('content')
    <div class="card mt-6">
        <div class="card-header flex flex-row justify-between">
            <h1 class="h6">Winkelwagen ({{\Gloudemans\Shoppingcart\Facades\Cart::count()}})</h1>
        </div>
        @if(session('message'))
            <div class="card-body">
                <div class="bg-green-400 text-green-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('message')}}</div>
            </div>
        @endif
        @if(session('warning-message'))
            <div class="card-body">
                <div class="bg-yellow-400 text-orange-800 rounded-lg shadow-md p-6 pr-10 mb-8">{{session('warning-message')}}</div>
            </div>
        @endif
        @if(\Gloudemans\Shoppingcart\Facades\Cart::count() < 1)
            <p class="card-body ">De winkelwagen is leeg.</p>
        @endif
        <div class="card-body">
            <div class="flex flex-wrap items-center lg:justify-between justify-center">
                @foreach($cart as $row)
                    <div
                        class="focus:outline-none mx-2 w-72 xl:mb-0 mb-8 flex flex-wrap w-full border-gray-400 border-b">
                        <div class="p-4 flex flex-row gap-12 w-full">
                            <div class="flex items-center flex-col w-2/3">
                                <h2 tabindex="0" class="focus:outline-none text-lg font-semibold self-start">
                                    {{$row->name}}</h2>
                                <p class="self-start text-gray-600">{{$row->options->category_name}}</p>
                                <p class="focus:outline-none text-xs text-gray-600 mt-2">{{$row->options->description}}</p>
                            </div>
                            <div class="flex items-center flex-col p-4 gap-3">
                                <div class="flex flex-row items-center">
                                    <form action="{{route('cart.update', ['rowId' => $row->rowId])}}" method="POST">
                                        @csrf
                                        <label class="text-gray-700">
                                            Aantal
                                            <form class="flex flex-row">
                                                <select name="newQty">
                                                    @for($i = 1; $i < 10; $i++)
                                                        <option value="{{$i}}"
                                                            @if($i == $row->qty)
                                                                selected
                                                            @endif>{{$i}}</option>
                                                    @endfor
                                                </select>
                                                <input type="hidden" value="{{$row->rowId}}" name="rowId">
                                                <button type="submit" class="flex flex-row items-center gap-3 bg-blue-700 px-4 rounded hover:bg-blue-500">
                                                    <p class="text-white">Aanpassen</p>
                                                </button>
                                            </form>
                                        </label>
                                    </form>
                                </div>
                                <div>
                                    <div>
                                        <form class="flex flex-row items-center" action="{{route('cart.delete', ['rowId' => $row->rowId])}}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$row->rowId}}" name="rowId">
                                            <button type="submit" class="flex items-center justify-between text-sm font-medium leading-5 text-blue-700
                                        rounded-lg focus:outline-none focus:shadow-outline-gray hover:text-red-600" aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                     viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0
                                                002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0
                                                00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p class="text-black font-bold p-4 text-lg">€{{$row->price * $row->qty}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer flex flex-row justify-between">
            <h2 class="h6">Totale prijs: €{{$cart_totalPrice}}</h2>
            @if(\Gloudemans\Shoppingcart\Facades\Cart::count() < 1)
                <form action="{{route('order.store')}}" method="POST">
                    @csrf
                    <button disabled type="submit" class="flex flex-row items-center gap-3 px-4 py-2 rounded bg-gray-500">
                        <p class="text-white">Bestelling Plaatsen</p>
                    </button>
                </form>
            @else
            @guest
                <form action="{{route('order.store')}}" method="POST">
                    @csrf
                    <button type="submit" class="flex flex-row items-center gap-3 bg-blue-700 px-4 py-2 rounded hover:bg-blue-500">
                        <p class="text-white">Bestelling Plaatsen</p>
                    </button>
                </form>
            @endguest
            @hasanyrole('user|salesperson|admin')
            <form action="{{route('order.store')}}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                <button type="submit" class="flex flex-row items-center gap-3 bg-blue-700 px-4 py-2 rounded hover:bg-blue-500">
                    <p class="text-white">Bestelling Plaatsen</p>
                </button>
            </form>
            @endhasanyrole
            @endif
        </div>
    </div>
@endsection
