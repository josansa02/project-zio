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
                <img src="{{asset('/img/usersIMG/' . $imagen[0]->name)}}" alt="{{$imagen[0]->title}}" class="img-fluid imagen_galeria" data-bs-toggle="modal" data-bs-target="#exampleModal{{$imagen[0]->id}}">
            </div>
            <div class="modal fade" id="exampleModal{{$imagen[0]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header gap-3">
                            <button type="button" class="btn" style="width: 30.4px" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="img-fluid" src="{{asset('/img/menu.svg')}}">
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="asd">asdas</a></li>
                            </ul>
                            <h5 class="modal-title text-center" id="exampleModalLabel">{{$imagen[0]->title}}</h5>
                            <button type="button" class="btn-close m-0 cerrado" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="imagen_modal mt-3">
                                <img src="{{asset('/img/usersIMG/' . $imagen[0]->img_name)}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <div class="d-flex align-items-center">
                                <p class="mt-3"> <strong> <img src="{{asset('/img/profileIMG/')}}/{{$imagen[1]->profile_img}}" class="img-fluid imagen_modal_usu"> </strong> </p>
                                <p> {{$imagen[0]->footer}} </p>
                            </div>
                            <div class="d-flex align-items-center">
                                <img style="width: 30px" src="{{asset('/img/profileIMG/')}}/{{auth()->user()->profile_img}}" alt="ProfileImg">
                                <form action="{{ route('messages.add') }}" method="post">
                                    @csrf
                                    @method("post")
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="message" id="message">
                                        <input type="hidden" name="img_id" id="img_id" value="{{$imagen[0]->id}}">
                                        <input type="hidden" name="owner_id" id="owner_id" value="{{$imagen[0]->user_id}}">
                                        <input type="hidden" name="writer_id" id="writer_id" value="{{auth()->user()->id}}">
                                        <input class="btn btn-outline-secondary" type="submit" value="Comentar">
                                      </div>
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

<!-- Prueba components -->
<imagenform-component></imagenform-component>

@endsection
