@extends("layouts.app")

@section("title", "ZIO - Home")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
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

{{-- {{auth()->user()}} --}}

<div class="profile d-flex flex-column justify-content-center align-items-center gap-3">
    <div class="d-flex align-items-center gap-3">
        <img src="{{asset('/img/profileIMG/')}}/{{$user->profile_img}}" class="img-fluid">
        <div>
          <h3>{{$user->name}}</h3>
          <p>{{$user->bio}}</p>
        </div>
    </div>
    @if (Auth::user()->name == $user->name)
    <div class="justify-content-center pt-1">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <img src="{{asset('img')}}/add_circle_outline_black_24dp.svg" />
        </button>
        <a class="btn btn-primary" href="{{route('usuarios.edit', $user->id)}}">Editar perfil</a>
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
    @endif
</main>

<!-- Modal subir imagen -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar imagen</h5>
                <button type="button" class="btn-close cerrado" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form action="{{route('image.add')}}" enctype="multipart/form-data" class="formulario_modal" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="modal_input">
                        <label for="files" class="subir_boton"> Haz clic aquí para seleccionar una imagen </label>
                        <input type="file" id="files" name="files">
                    </div>

                    <div class="modal_input mt-3">
                        <label for="titulo">Titulo: </label>
                        <input type="text" id="tituloIMG" name="tituloimg" maxlength="30">
                    </div>

                    <div class="modal_input mt-2">
                        <label for="pieIMG">Pie: </label>
                        <input type="text" id="pieIMG" name="pieimg">
                    </div>
                    <input type="hidden" name="img" id="img_sub">

                    <div class="imagen_modal mt-3">
                        <output id="list"></output>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Añadir">
                </div>
            </form> --}}
        </div>
    </div>
</div>

<div class="col text-center">
    <label id="switch" class="d-flex justify-content-center align-items-center">
        <input type="checkbox">
        <div class="icono_tema"></div>
    </label>
</div>

<script>
    function archivo(evt) {
        var files = evt.target.files; // FileList object
   
        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
          //Solo admitimos imágenes.
          if (!f.type.match('image.*')) {
              continue;
          }
   
          var reader = new FileReader();
   
          reader.onload = (function(theFile) {
              return function(e) {
                // Insertamos la imagen
               document.getElementById("list").innerHTML = ['<img class="thumb img-fluid" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
               document.getElementById("img_sub").value = theFile.name;
              };
          })(f);
   
          reader.readAsDataURL(f);
        }
    }
   
    document.getElementById('files').addEventListener('change', archivo, false);
</script>
@endsection