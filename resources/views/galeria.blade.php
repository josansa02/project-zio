@extends("layouts.app")

@section("title", "Galería personal - ZIO")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
@endsection

@section('content')
@if (isset($_SESSION["update"]))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Perfil actualizado correctamente</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @php
        unset($_SESSION["update"]);
    @endphp
@endif

<div class="profile d-flex flex-column justify-content-center align-items-center gap-3">
    <div class="d-flex align-items-center gap-3">
        <img src="{{asset('/img/profileIMG/')}}/{{$user->profile_img}}" class="img-fluid">
        <div class="mt-2">
          <h3>{{$user->name}}</h3>
          <p>{{$user->bio}}</p>
        </div>
    </div>
    @if (Auth::user()->name == $user->name)
    <div style="gap: 2px" class="d-flex mt-2 btn-group user-buttons rounded">
        <button type="button" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class="material-symbols-outlined">add_circle</span>
        </button>
        <a type="button" href="{{route('messages', $user->id)}}" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center">
            <span class="material-symbols-outlined">chat</span>
        </a>
    </div>
    @endif
</div>

@if (count($imagenes) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center">Aún no ha subido ninguna imagen</h3>
    </main>
@else 
<main class="container mt-3 mb-3">
    @foreach ($imagenes as $imagen)
        <div class="w-auto">
            <img src="{{asset('/img/usersIMG/' . $imagen->img_name)}}" alt="{{$imagen->title}}" class="img-fluid imagen_galeria" data-bs-toggle="modal" data-bs-target="#exampleModal{{$imagen->id}}">
        </div>
        <div class="modal fade" id="exampleModal{{$imagen->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header gap-3">
                        <button type="button" class="btn" style="width: 30.4px" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-fluid" src="{{asset('/img/menu.svg')}}">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="asd">asdas</a></li>
                        </ul>
                        <h5 class="modal-title text-center" id="exampleModalLabel">{{$imagen->title}}</h5>
                        <button type="button" class="btn-close m-0 cerrado" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="imagen_modal mt-3">
                            <img src="{{asset('/img/usersIMG/' . $imagen->img_name)}}" class="img-fluid">
                        </div>
                        <div>
                            <p class="mt-3"> <strong> <img src="{{asset('/img/profileIMG/' . $user->profile_img)}}" class="img-fluid imagen_modal_usu"> {{$user->name}} </strong> </p>
                            <p> {{$imagen->footer}} </p>
                        </div>
                    </div>
                    {{-- <div class="modal-footer">
                        <form action="{{route('index')}}/image/remove/{{$imagen->id}}" method="post">
                            @csrf
                            @method("delete")
                            <input type="submit" class="btn btn-danger m-auto" value="Eliminar">
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach
</main>
@endif

<!-- Modal subir imagen -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar imagen</h5>
                <button type="button" class="btn-close cerrado" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <imagenform-component></imagenform-component>
        </div>
    </div>
</div>
@endsection