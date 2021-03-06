<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

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
        <nav class="navbar navbar-expand navbar-light d-flex flex-column justify-content-center align-items-center bg-white shadow-sm">

            <div class="container d-flex">
                
                <a class="navbar-brand d-flex justify-content-center align-items-center gap-2" href="{{ url('/home') }}">
                    <!-- {{ config('app.name', 'ZIO') }} -->
                    <img src="{{asset('/img/logo_ZIO.svg')}}" alt="Logo ZIO" width="40" height="40" class="d-inline-block">
                    <h3 class="m-0 d-none d-md-block">ZIO</h3>
                </a>

                @guest
                    @else
                        @if (auth()->user()->enabled && !auth()->user()->role)
                            <div class="p-1 bg-main rounded rounded-pill shadow-sm busqueda-1">
                                <div class="input-group d-flex justify-content-center align-items-center">
                                    <search-component class="barra_busqueda-input" :ruta="{{json_encode(asset('usuarios'))}}"></search-component>
                                    <div>
                                        <button name="{{route('gallery.route')}}" id="ruta" onclick="visitarUsuario()" type="button" class="btn rounded-pill text-dark-purple d-flex justify-content-center"> <span class="material-symbols-outlined">search</span> </button>
                                    </div>
                                </div>
                            </div>
                        @endif            
                @endguest

                <div class="main-search-input-wrap">
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesi??n') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            @if (auth()->user()->role)
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <span class="d-flex justify-content-center align-items-center material-symbols-outlined text-dark-purple">menu</span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="navbarDropdown" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 7px;">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('help.admin')}}">Ayuda <span class="material-symbols-outlined"> help </span></a>
                                        <a class="dropdown-item border-top d-flex justify-content-between align-items-center" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesi??n') }} <span class="material-symbols-outlined"> logout </span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                            @if (auth()->user()->enabled && !auth()->user()->role)
                                <!-- Men?? desplegable del usuario -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img class="img-profile" src="{{asset('img/profileIMG')}}/{{auth()->user()->profile_img}}" alt="ProfileImg">
                                        <div class="d-flex align-items-end">
                                            <span class="material-symbols-outlined">expand_more</span>
                                        </div>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="navbarDropdown" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 2px 7px;">
                                        <a class="dropdown-item d-flex justify-content-between align-items-center gap-3" href="{{route('gallery', auth()->user()->name)}}">Galer??a personal <span class="material-symbols-outlined"> home </span></a>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('messages', auth()->user()->id)}}">Comentarios <span class="material-symbols-outlined"> chat </span></a>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('usuarios.edit', auth()->user()->id)}}">Editar perfil <span class="material-symbols-outlined"> settings </span></a>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('help')}}">Ayuda <span class="material-symbols-outlined"> help </span></a>
                                        <a class="dropdown-item border-top d-flex justify-content-between align-items-center" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesi??n') }} <span class="material-symbols-outlined"> logout </span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else 
                                @if(!auth()->user()->enabled && !auth()->user()->role)
                                    <a class="nav-link" href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesi??n') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endif
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>

            @if (auth()->user())
                @if (auth()->user()->enabled && !auth()->user()->role)
                    <div class="p-1 bg-main rounded rounded-pill shadow-sm busqueda-2 w-75">
                        <div class="input-group d-flex flex-nowrap justify-content-center align-items-center">
                            <search-component class="barra_busqueda-input col-10" :ruta="{{json_encode(asset('usuarios'))}}"></search-component>
                            <div class="col-2 d-flex justify-content-center">
                                <button name="{{route('gallery.route')}}" id="ruta2" onclick="visitarUsuario2()" type="button" class="btn rounded-pill text-dark-purple d-flex justify-content-center"> <span class="material-symbols-outlined">search</span> </button>
                            </div>
                        </div>
                    </div>
                @endif 
            @endif 

        </nav>

        <div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/jquery-3.6.0.min.js') }}"></script>
    <script>
        function visitarUsuario() {
            let autocom = document.getElementById("autocom");
            let ruta = document.getElementById("ruta");
            if (autocom.value != "") {
                window.location.href = ruta.name + "/" + autocom.value;
            }
        }

        function visitarUsuario2() {
            let autocoms = document.getElementsByName("autocompletar");
            let autocom = autocoms[1].value;
            let ruta = document.getElementById("ruta2");
            if (autocom.value != "") {
                window.location.href = ruta.name + "/" + autocom;
            }
        }
    </script>
    @yield('js')
    
</body>
</html>
