@extends("layouts.app")

@section("title", "ZIO - Configuración")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
<link rel="stylesheet" href="{{ asset('css/registro.css') }}">
@endsection

@section('content')
<main class="container mt-5">
    <div class="row portada">
        <div class="col-12 col-md-8 text-center d-flex align-items-center justify-content-center">
            <h2> Editar perfil </h2>
            <form action="{{route('usuarios.edit', $user->id)}}/" method="POST" class="d-flex gap-5">
                @csrf
                @method('put')
                <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                    <img src="{{asset('/img/profileIMG')}}/{{$user->profile_img}}" class="img-fluid mod_profile">
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="cambiar_img"> Cambiar imagen de perfil </div>
                </div>
                <div>
                    <label for="name"> Usuario: </label>
                    @error('name')
                        <div class="msg-error mb-1">*{{$message}}</div>
                    @enderror
                    <input type="text" id="name" name="name" value="{{$user->name}}" maxlength="30">

                    <label for="email"> Email: </label>
                    @error('email')
                        <div class="msg-error mb-1">*{{$message}}</div>
                    @enderror
                    <input type="email" id="email" name="email" value="{{$user->email}}">

                    <label for="bio" class="mt-3"> Biografía: </label>
                    @error('bio')
                        <div class="msg-error mb-1">*{{$message}}</div>
                    @enderror
                    <textarea id="bio" name="bio" class="form-control" style="resize: none;" rows="3" maxlength="38">{{$user->bio}}</textarea>

                    <div class="d-flex justify-content-center">
                        <input type="submit" class="boton_sesion" value="Actualizar datos">
                    </div>
                </div>
            </form>
            <div>
                @php
                    if (isset($_SESSION["updateError"])) {
                        if ($_SESSION["updateError"] != "") {
                            echo $_SESSION["updateError"];
                            $_SESSION["updateError"] = "";
                        }
                    }
                @endphp
            </div> 
        </div> 
    </div>
</main>

<!-- Modal subir imagen -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar imagen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('usuarios.edit.profileimg.update', $user->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="modal_input">
                        <label for="files" class="subir_boton"> Haz clic aquí para seleccionar una imagen </label>
                        <input type="file" id="files" name="files">
                        @error('files')
                        <div class="msg-error mb-1">*{{$message}}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="img" id="img_sub">
                    <div class="imagen_modal mt-3">
                        <output id="list"></output>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
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