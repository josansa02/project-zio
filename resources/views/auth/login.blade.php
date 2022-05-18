@extends('layouts.app')

@section("title", "Inicio - ZIO")

@section('styles')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('header')
<nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <!-- {{ config('app.name', 'ZIO') }} -->
            <img src="{{asset('/img/logo_ZIO.svg')}}" alt="Logo ZIO" width="40" height="40" class="d-inline-block">
        </a>

        <div id="navbarSupportedContent">
            <div class="main-search-input fl-wrap">
                <div class="main-search-input-item">
                    <input type="text" placeholder="Busca usuarios...">
                </div>
                                    
                <button class="main-search-button">Search</button>
            </div>
        </div>

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
                    <!-- Barra de búsqueda de usuarios -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img style="width: 50px" src="{{asset('img/profileIMG')}}/{{auth()->user()->profile_img}}" alt="ProfileImg">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item d-flex justify-content-between align-items-center gap-3" href="{{route('gallery', auth()->user()->name)}}">Ver galería personal <span class="material-symbols-outlined"> home </span></a>
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="">Ver comentarios <span class="material-symbols-outlined"> chat </span></a>
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{route('usuarios.edit', auth()->user()->id)}}">Editar perfil <span class="material-symbols-outlined"> settings </span></a>
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="">Ayuda <span class="material-symbols-outlined"> help </span></a>
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
@endsection

@section('content')

<div class="container mt-5">
    <div class="row portada">
        <div class="col-12 col-md-8 text-center d-flex align-items-center justify-content-center">
            <h2> ZIO, la plataforma más liviana de imágenes </h2>
            <form method="POST" action="{{ route('login') }}">
                
                <div class="d-flex justify-content-center align-items-center gap-0">
                    <h4> ¿Tienes ya una cuenta en ZIO?</h4>
                    <h4> Inicia sesión aquí </h4>
                </div>
                
                @csrf

                <label for="email">Email: </label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password">Contraseña: </label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                {{-- @if (Route::has('password.request'))
                    <a class="mt-1 d-block btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif --}}

                <div class="d-flex justify-content-center">
                    <input type="submit" class="boton_sesion" value="Iniciar sesión">
                </div>
            </form>
        </div>
        <div class="col-12 col-md-4">
            <img class="img-fluid imagen_portada" alt="Chica mirando un cuadro" src="{{ asset('img/art_lover.svg') }}">
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container text-center">
        <span class="text-muted">Jesús Sánchez Rodríguez y José Antonio Sánchez Andrades &copy; 2022</span>
    </div>
</footer>
@endsection
