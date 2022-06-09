@extends('layouts.app')

@section("title", "Galería - ZIO")

<!-- Sección de estilos de la página -->
@section("styles")
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

<!-- **Sección de contenido** -->
@section('content')

<!-- Muestra un alerta que infrme que un reporte ha sido llevado a cabo tras su realización -->
@if (isset($_SESSION["report"]))
<div class="row justify-content-center fixed-bottom">
    <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
        <strong>{{$_SESSION["report"]}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @php
        unset($_SESSION["report"])
      @endphp    
</div>
@endif

<!-- Muestra un alerta que informe que un mensaje enviado sobre una imagen -->
@if (isset($_SESSION["message"]))
<div class="row justify-content-center fixed-bottom">
    <div class="alert alert-primary alert-dismissible fade show w-50" role="alert">
        <strong>{{$_SESSION["message"]}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @php
        unset($_SESSION["message"])
      @endphp    
</div>
@endif

<!-- Muestra un alerta si no encuentra el usuario que se busca -->
@if (isset($_SESSION["userNotFound"]))
<div class="row justify-content-center fixed-bottom">
    <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
        <strong>{{$_SESSION["userNotFound"]}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @php
        unset($_SESSION["userNotFound"])
      @endphp    
</div>
@endif

@if (count($images) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center text-blue">Aún no se han subido imágenes</h3>
    </main>
@else 

<!-- Lista de filtros -->
<div class="dropdown">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
      Filtrar
    </a>
  
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <li><a class="dropdown-item" href="{{route('home')}}?f=up">Más votadas</a></li>
      <li><a class="dropdown-item" href="{{route('home')}}?f=now">Ultimas actualizaciones</a></li>
      <li><a class="dropdown-item" href="{{route('home')}}">Todas</a></li>
    </ul>
</div>

<!-- Muestra por lo que se filtra -->
@if (isset($_REQUEST["f"]))
    @if ($_REQUEST["f"] == "up")
        Filtro: Más votadas
    @else 
        Filtro: Últimas actualizaciones         
    @endif
@endif 

<main class="container mt-3 mb-3 py-4">
    @foreach ($images as $imagen)
        <div class="main-block bg-white d-flex flex-column justify-content-between">
            <div class="px-3 imagen-titulo d-flex justify-content-center align-items-center"> <h4 class="text-center m-0"> {{$imagen[0]->title}} </h4> </div>
            <div class="imagenes-div">
                <img src="{{asset('/img/usersIMG/')}}/{{$imagen[0]->img_name}}" alt="{{$imagen[0]->title}}" class="img-fluid imagen_galeria" data-bs-toggle="modal" data-bs-target="#exampleModal{{$imagen[0]->id}}" onclick="eliminarclass()">
            </div>
            <div class="px-3 imagen-pie d-flex justify-content-between align-items-center"> 
                <div class="d-flex justify-content-center align-items-center gap-2"> 
                    <a href="{{route('gallery', $imagen[1]->name)}}"> <img src="{{asset('/img/profileIMG/')}}/{{$imagen[1]->profile_img}}" class="img-fluid imagen_usu"> </a>
                    <strong> {{$imagen[1]->name}} </strong>  
                </div>
                @if ($imagen[0]->user_id != auth()->user()->id)
                    <like-component :img_id="{{json_encode($imagen[0]->id)}}" :user_id="{{json_encode(auth()->user()->id)}}" :ruta_votos="{{json_encode(asset('votos'))}}" :ruta_getvotos="{{json_encode(asset('getVotos'))}}"></like-component>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal{{$imagen[0]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header gap-3">
                        @if ($imagen[1]->id != auth()->user()->id)
                            <button type="button" class="btn d-flex justify-content-center align-items-center" data-bs-target="#modalReportar{{$imagen[0]->id}}" data-bs-toggle="modal" onclick="eliminarclass()">
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="material-symbols-outlined text-danger">report</span>
                                </div>
                            </button>
                        @endif
                        <h5 class="modal-title text-center" id="exampleModalLabel">{{$imagen[0]->title}}</h5>
                        <button type="button" class="btn cerrado p-1" data-bs-dismiss="modal" aria-label="Close" onclick="eliminarclass()"> 
                            <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="imagen_modal">
                            <img src="{{asset('/img/usersIMG/')}}/{{$imagen[0]->img_name}}" class="img-fluid">
                        </div>
                        <div class="mt-3 mb-3 px-3">
                            <div class="d-flex align-items-center gap-2"> 
                                <div class="d-flex align-items-center gap-1">
                                    <a href="{{route('gallery', $imagen[1]->name)}}" class="imagen_modal_usu"> <img src="{{asset('/img/profileIMG/')}}/{{$imagen[1]->profile_img}}" class="img-fluid my-modal-img"> </a>
                                    <p class="m-0"><strong>{{$imagen[1]->name}}:</strong></p>
                                </div>
                                <p class="m-0"> {{$imagen[0]->footer}} </p>
                            </div>
                        </div>
                        @if ($imagen[1]->id != auth()->user()->id)
                        <div class="modal-footer justify-content-between">
                            <div class="d-flex align-items-center gap-1">
                                <img src="{{asset('/img/profileIMG/')}}/{{auth()->user()->profile_img}}" alt="ProfileImg" class="no-photo-link my-modal-img">
                                <form action="{{ route('messages.add') }}" method="post">
                                    @csrf
                                    @method("post")
                                    <div class="input-group">
                                        <input type="text" class="form-control text-comment" onkeyup="comprobar('message{{$imagen[0]->id}}', 'comentar{{$imagen[0]->id}}')" name="message" id="message{{$imagen[0]->id}}" maxlength="150">
                                        <input type="hidden" name="img_id" id="img_id" value="{{$imagen[0]->id}}">
                                        <input type="hidden" name="owner_id" id="owner_id" value="{{$imagen[0]->user_id}}">
                                        <input class="btn btn-comment" id="comentar{{$imagen[0]->id}}" disabled type="submit" value="Comentar">
                                    </div>
                                </form>    
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalReportar{{$imagen[0]->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-dark-purple modal-title" id="exampleModalToggleLabel2">Reportar esta fotografía</h5>
                    <button type="button" class="btn cerrado p-1" data-bs-target="#exampleModal{{$imagen[0]->id}}" data-bs-toggle="modal" onclick="eliminarclass()">
                        <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                    </button>
                </div>
                <form action="{{route('reports.add')}}" method="post">
                    @csrf
                    @method("post")
                    <input type="hidden" name="img_id" value="{{$imagen[0]->id}}">
                    <input type="hidden" name="owner_id" value="{{$imagen[1]->id}}">
                    <div class="modal-body row justify-content-center">
                        <div class="col-10 py-4">
                            <div class="form-floating">
                                <select class="form-select" name="report" id="report" aria-label="Report select">
                                  <option value="Spam">Spam</option>
                                  <option value="Desnudos o actividad sexual">Desnudos o actividad sexual</option>
                                  <option value="Lenguajes o símbolos que inciten al odio">Lenguajes o símbolos que inciten al odio</option>
                                  <option value="Violencia">Violencia</option>
                                  <option value="Bullying o acoso">Bullying o acoso</option>
                                </select>
                                <label for="floatingSelect">Seleccione el motivo del reporte</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button class="btn btn-danger" data-bs-target="#exampleModal{{$imagen[0]->id}}">Enviar reporte</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    @endforeach
</main>
@endif

<!-- Sección de scripts de la página -->
@section('js')

<script>
    function comprobar(id1, id2) {
        var input = document.getElementById(id1);
        var boton = document.getElementById(id2);
        boton.disabled = true;
        if (input.value != "" && input.value.length <= 50){            
            boton.disabled = false;
        }
    }
</script>

<script>
    function eliminarclass() {
        bod = document.getElementById("bod");
        bod.setAttribute("style", "");
    }
</script>

@endsection
    
@endsection