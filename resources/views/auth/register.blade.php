@extends('layouts.app')

@section("title", "Registro - ZIO")

@section('styles')
<link rel="stylesheet" href="{{ asset('css/registro.css') }}">
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"> Registrate en ZIO para tener acceso a la galería de imagenes más liviana y rápida. </h2>
    <div class="row portada">
        <div class="col-12 col-md-8 text-center d-flex align-items-center justify-content-center">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">Nombre: </label>
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <label for="email" class="mt-3">Email: </label>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password" class="mt-3">Contraseña: </label>
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <label for="password-confirm" class="mt-3">Confirmar contraseña: </label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">

                <div class="d-flex justify-content-center mt-2">
                    <input type="submit" class="boton_sesion" value="Registrarse">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="d-flex imagenes_fondo">
    <img src="{{ asset('img/dreamer.svg') }}" class="col-4 img-fluid">
    <img src="{{ asset('img/photo_session.svg') }}" class="col-4 img-fluid">
</div>
@endsection
