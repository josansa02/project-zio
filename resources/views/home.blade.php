@extends('layouts.app')

@section("title", "Galería - ZIO")

@section('content')
@if (count($images) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center">Aún no se han subido imágenes</h3>
    </main>
@else 
<main class="container mt-3 mb-3">
        @foreach ($images as $imagen)
            <div class="w-auto">
                <img src="{{asset('/img/usersIMG/' . $imagen->name)}}" alt="{{$imagen->title}}" class="img-fluid imagen_galeria" data-bs-toggle="modal" data-bs-target="#exampleModal{{$imagen->id}}">
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
                                <img src="{{asset('/img/usersIMG/' . $imagen->name)}}" class="img-fluid">
                            </div>
                            {{-- <div>
                                <p class="mt-3"> <strong> <img src="{{asset('/img/profileIMG/' . $user->profile_img)}}" class="img-fluid imagen_modal_usu"> {{$user->name}} </strong> </p>
                                <p> {{$imagen->footer}} </p>
                            </div> --}}
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
    @endif

<!-- Prueba components -->
<imagenform-component></imagenform-component>

@endsection
