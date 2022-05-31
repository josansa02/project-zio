@extends('layouts.app')

@section("title", "Galería - ZIO")

<!-- Sección de estilos de la página -->
@section("styles")
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

<!-- **Sección de contenido** -->
@section('content')
@if (count($images) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center">Aún no se han subido imágenes</h3>
    </main>
@else 
<main class="container mt-3 mb-3">
    @foreach ($images as $imagen)
        <div class="main-block bg-white d-flex flex-column justify-content-between">
            <div class="px-3 imagen-titulo d-flex justify-content-center align-items-center"> <h4 class="text-center m-0"> {{$imagen[0]->title}} </h4> </div>
            <div class="imagenes-div">
                <img src="{{asset('/img/usersIMG/')}}/{{$imagen[0]->img_name}}" alt="{{$imagen[0]->title}}" class="img-fluid imagen_galeria" data-bs-toggle="modal" data-bs-target="#exampleModal{{$imagen[0]->id}}" onclick="eliminarclass()">
            </div>
            <div class="px-3 imagen-pie d-flex justify-content-between align-items-center"> 
                <div class="d-flex justify-content-center align-items-center gap-1"> 
                    <a href="{{route('gallery', $imagen[1]->name)}}"> <img src="{{asset('/img/profileIMG/')}}/{{$imagen[1]->profile_img}}" class="img-fluid imagen_usu"> </a>
                    <strong> {{$imagen[1]->name}} </strong>  
                </div>
                <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple"> recommend </span>
            </div>
        </div>

        <div class="modal fade" id="exampleModal{{$imagen[0]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header gap-3">
                        <button type="button" data-bs-target="#modalReportar{{$imagen[0]->id}}" data-bs-toggle="modal">
                            <span class="material-symbols-outlined">report</span>
                        </button>
                        <h5 class="modal-title text-center" id="exampleModalLabel">{{$imagen[0]->title}}</h5>
                        <button type="button" class="btn cerrado p-1" data-bs-dismiss="modal" aria-label="Close"> 
                            <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="imagen_modal">
                            <img src="{{asset('/img/usersIMG/')}}/{{$imagen[0]->img_name}}" class="img-fluid">
                        </div>
                        <div class="mt-3 px-3">
                            <div class="d-flex align-items-center gap-1"> 
                                <div class="d-flex align-items-center">
                                    <p class="mt-3"> <strong> <img src="{{asset('/img/profileIMG/')}}/{{$imagen[1]->profile_img}}" class="img-fluid imagen_modal_usu"> {{$imagen[1]->name}} </strong> </p>
                                    <p> {{$imagen[0]->footer}} </p>
                                    <p class="row align-items-center justify-content-center"> 
                                        <span class="material-symbols-outlined d-flex justify-content-center"> recommend </span> {{$imagen[2]}}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
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
        </div>

        <div class="modal fade" id="modalReportar{{$imagen[0]->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalToggleLabel2">Reportar esta imagen</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Hide this modal and show the first with the button below.
                </div>
                <div class="modal-footer">
                  <button class="btn btn-primary" data-bs-target="#exampleModal{{$imagen[0]->id}}" data-bs-toggle="modal">Back to first</button>
                </div>
              </div>
            </div>
          </div>
    @endforeach
</main>
@endif

<!-- Sección de scripts de la página -->
@section('js')
<script>
    function eliminarclass() {
        bod = document.getElementById("bod");
        bod.setAttribute("style", "");
    }
</script>
@endsection
    
@endsection