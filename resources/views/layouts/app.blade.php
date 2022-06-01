<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <style>
    @import "../node_modules/@syncfusion/ej2-vue-dropdowns/styles/material.css";
    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Google Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- Icon -->
    <link rel="icon" href="{{asset('/img/logo_ZIO.svg')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body id="bod">
    <div id="app">
        <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <!-- {{ config('app.name', 'ZIO') }} -->
                    <img src="{{asset('/img/logo_ZIO.svg')}}" alt="Logo ZIO" width="40" height="40" class="d-inline-block">
                </a>

                @guest
                @else
                    <!-- <form method="POST"> -->
                        <div class="p-1 bg-main rounded rounded-pill shadow-sm">
                            <div class="input-group d-flex justify-content-center align-items-center">
                                <!-- <input type="text" placeholder="Busca usuarios..." class="form-control border-0 bg-main"> -->
                                <search-component class="barra_busqueda-input"></search-component>
                                <div>
                                    <button onclick="visitarUsuario()" type="button" class="btn text-dark-purple d-flex justify-content-center"> <span class="material-symbols-outlined">search</span> </button>
                                </div>
                            </div>
                        </div>
                    <!-- </form> -->
                @endguest

                <div class="main-search-input-wrap">

                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Menú desplegable del usuario -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img style="width: 50px" src="{{asset('img/profileIMG')}}/{{auth()->user()->profile_img}}" alt="ProfileImg">
                                    <div class="d-flex align-items-end">
                                        <span class="material-symbols-outlined">expand_more</span>
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="navbarDropdown" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 3px;">
                                    <a class="dropdown-item d-flex justify-content-between align-items-center gap-3" href="{{route('gallery', auth()->user()->name)}}">Galería personal <span class="material-symbols-outlined"> home </span></a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('messages', auth()->user()->id)}}">Comentarios <span class="material-symbols-outlined"> chat </span></a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('usuarios.edit', auth()->user()->id)}}">Editar perfil <span class="material-symbols-outlined"> settings </span></a>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('help')}}">Ayuda <span class="material-symbols-outlined"> help </span></a>
                                    <a class="dropdown-item border-top d-flex justify-content-between align-items-center" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }} <span class="material-symbols-outlined"> logout </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="py-4">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        function visitarUsuario() {
            let autocom = document.getElementById("autocom");
            console.log("valor: " + autocom.value);
        }
    </script>
    @yield('js')
    
</body>
</html>
