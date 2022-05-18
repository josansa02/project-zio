@extends('layouts.app')

@section("title", "Galería - ZIO")

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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                {{$images}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Has iniciado sesión correctamente!') }}

                    <!-- Prueba components -->
                    <imagenform-component></imagenform-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
