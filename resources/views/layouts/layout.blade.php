<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{assert('./img/quokka.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.12.1/css/pro.min.css">
    <link rel="stylesheet" type="text/css" href={{asset('css/style.css')}}>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts" defer></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <title>Laravel 9</title>
</head>
<body class="bg-gray-100">


<!-- start navbar -->
<div class="md:fixed md:w-full md:top-0 md:z-20 flex flex-row flex-wrap items-center bg-white p-6 border-b border-gray-300">

    <!-- logo -->
    <div class="flex-none w-56 flex flex-row items-center">
        <a href="/" class="flex flex-row items-center gap-2">
            <img alt="" src="{{asset('img/quokka.png')}}" class="w-10 flex-none">
            <strong class="capitalize ml-1 flex-1">Project Laravel</strong>
        </a>
    </div>
    <!-- end logo -->

    <!-- navbar content toggle -->
    <button id="navbarToggle" class="hidden md:block md:fixed right-0 mr-6">
        <i class="fad fa-chevron-double-down"></i>
    </button>
    <!-- end navbar content toggle -->

    <!-- navbar content -->
    <div id="navbar" class="animated md:hidden md:fixed md:top-0 md:w-full md:left-0 md:mt-16 md:border-t md:border-b md:border-gray-200 md:p-10 md:bg-white flex-1 pl-3 flex flex-row flex-wrap justify-between items-center md:flex-col md:items-center">
        <!-- left -->
        <div>

        </div>
        <!-- end left -->

        <!-- right -->
        <div class="flex flex-row-reverse items-center">
        @hasanyrole('admin|salesperson|user')
            <!-- user -->
            <div class="dropdown relative md:static">

                    <button class="menu-btn focus:outline-none focus:shadow-outline flex flex-wrap items-center">
                        <div class="w-8 h-8 overflow-hidden rounded-full">

                        </div>

                        <div class="ml-2 capitalize flex ">
                            <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">{{Auth::user()->name}}</h1>
                            <i class="fad fa-chevron-down ml-2 text-xs leading-none"></i>
                        </div>
                    </button>
                <button class="hidden fixed top-0 left-0 z-10 w-full h-full menu-overflow"></button>

                <div class="text-gray-500 menu hidden md:mt-10 md:w-full rounded bg-white shadow-md absolute z-20 right-0 w-40 mt-5 py-2 animated faster">

                    <!-- item -->
                    <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="{{route('orders.index')}}">
                        <i class="fad fa-list text-xs mr-1"></i>
                        bestellingen
                    </a>
                    <!-- end item -->

                    <hr>

                    <!-- item -->
                    <a class="px-4 py-2 block capitalize font-medium text-sm tracking-wide bg-white hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 ease-in-out" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fad fa-user-times text-xs mr-1"></i>
                        log out
                    </a>
                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none">
                        @csrf
                    </form>
                    <!-- end item -->
        @else
                        <div class="ml-2 capitalize flex ">
                            <h1 class="text-sm text-gray-800 font-semibold m-0 p-0 leading-none">Guest</h1>
                        </div>
    @endhasanyrole




                </div>
            </div>


        </div>
        <!-- end right -->
    </div>
    <!-- end navbar content -->

</div>
<!-- end navbar -->


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">

    <!-- start sidebar -->
    <div id="sideBar" class="relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">


        <!-- sidebar content -->
        <div class="flex flex-col">

            <!-- sidebar toggle -->
            <div class="text-right hidden md:block mb-4">
                <button id="sideBarHideBtn">
                    <i class="fad fa-times-circle"></i>
                </button>
            </div>
            <!-- end sidebar toggle -->
    @guest
        <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">Guest</p>
                <a href="{{route('login')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-user text-xs mr-2"></i>
                    Login
                </a>
                <a href="{{route('register')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-user-plus text-xs mr-2"></i>
                    Register
                </a>


                <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">public</p>

                <!-- link -->
                <a href="{{route('open.games.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-gamepad text-xs mr-2"></i>
                    Games
                </a>
                <!-- end link -->

                <!-- link -->
                <a href="{{route('cart.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-shopping-cart text-xs mr-2"></i>
                    Winkelwagen ({{\Gloudemans\Shoppingcart\Facades\Cart::count()}})
                </a>
                <!-- end link -->




            @endguest

            @hasanyrole('user|salesperson|admin')
                <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider">User</p>
            <a class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fad fa-user-times text-xs mr-1"></i>
                log out
            </a>
            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display:none">
                @csrf
            </form>

            <a href="{{route('orders.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-list text-xs mr-2"></i>
                Bestellingen
            </a>

                <p class="uppercase text-xs text-gray-600 mb-4 tracking-wider"> Public</p>

            <!-- link -->
            <a href="{{route('open.games.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-gamepad text-xs mr-2"></i>
                Games
            </a>
            <!-- end link -->

                <!-- link -->
                <a href="{{route('cart.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                    <i class="fad fa-shopping-cart text-xs mr-2"></i>
                    Winkelwagen ({{\Gloudemans\Shoppingcart\Facades\Cart::count()}})
                </a>
                <!-- end link -->

            @endhasanyrole




            @hasanyrole('admin')
            <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">admin</p>
            <a href="{{route('admin.users.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-list text-xs mr-2"></i>
                User List
            </a>
            <a href="{{route('games.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-list text-xs mr-2"></i>
                Games List
            </a>
            <a href="{{route('category.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-list text-xs mr-2"></i>
                Category List
            </a>
            @endhasanyrole

            @hasanyrole('salesperson')
            <p class="uppercase text-xs text-gray-600 mb-4 mt-4 tracking-wider">salesperson</p>
            <a href="{{route('games.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-list text-xs mr-2"></i>
                Games List
            </a>
            <a href="{{route('category.index')}}" class="mb-3 capitalize font-medium text-sm hover:text-teal-600 transition ease-in-out duration-500">
                <i class="fad fa-list text-xs mr-2"></i>
                Category List
            </a>
            @endhasanyrole










        </div>
        <!-- end sidebar content -->

    </div>
    <!-- end sidbar -->

    <!-- strat content -->
    <div class="bg-gray-100 flex-1 p-6 md:mt-16">

        @yield('topmenu')
        @yield('content')
    </div>
    <!-- end content -->

</div>
<!-- end wrapper -->



<!-- script -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="js/scripts.js"></script>
<!-- end script -->

</body>
</html>
