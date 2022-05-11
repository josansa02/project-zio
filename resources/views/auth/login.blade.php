@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
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
