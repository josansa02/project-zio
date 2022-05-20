@extends("layouts.app")

@section("title", "ZIO - Configuración")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/editProfile.css') }}">
@endsection

@section('content')
<main class="container mt-3 position-relative">
    <div class="row">
        <h2 class="text-center"> Editar perfil </h2>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <form action="{{route('usuarios.edit', $user->id)}}/" method="POST" class="d-flex gap-5 formEdit">
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

                    <label for="email" class="mt-3"> Correo: </label>
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
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#5148ff" fill-opacity="1" d="M0,192L18.5,202.7C36.9,213,74,235,111,202.7C147.7,171,185,85,222,74.7C258.5,64,295,128,332,176C369.2,224,406,256,443,234.7C480,213,517,139,554,128C590.8,117,628,171,665,181.3C701.5,192,738,160,775,128C812.3,96,849,64,886,85.3C923.1,107,960,181,997,186.7C1033.8,192,1071,128,1108,85.3C1144.6,43,1182,21,1218,64C1255.4,107,1292,213,1329,250.7C1366.2,288,1403,256,1422,240L1440,224L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z" style="height:100%;width:100%;line-height: 0;overflow:hidden;font-size: 0"></path>
</svg>

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