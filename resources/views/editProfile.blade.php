@extends("layouts.app")

@section("title", "ZIO - Configuración")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/editProfile.css') }}">
@endsection

@section('content')

<!-- Muestra un alerta si no encuentra el usuario que se busca -->
@if (isset($_SESSION["userNotFound"]))
<div class="row justify-content-center fixed-bottom">
    <div class="alert alert-danger alert-dismissible fade show w-25" role="alert">
        <strong>{{$_SESSION["userNotFound"]}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @php
        unset($_SESSION["userNotFound"])
      @endphp    
</div>
@endif

<!-- Muestra un alerta que indica que el perfil se ha actualizado correctamente -->
@if (isset($_SESSION["update"]))
<div class="row justify-content-center fixed-bottom">
    <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
        <strong>{{$_SESSION["update"]}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @php
        unset($_SESSION["update"]);
    @endphp
</div>
@endif

<main class="container mt-4 position-relative">
    <div class="row">
        <h2 class="text-center text-blue"> Editar perfil </h2>
        <div class="d-flex align-items-center justify-content-center mt-3">
            <form action="{{route('usuarios.edit', $user->id)}}" method="POST" class="d-flex gap-5 formEdit">
                @csrf
                @method('put')
                <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                    <img data-bs-toggle="modal" data-bs-target="#exampleModal" src="{{asset('/img/profileIMG')}}/{{$user->profile_img}}" class="img-fluid mod_profile cambiar_img" onclick="eliminarclass()">
                    <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="cambiar_img text-dark-purple" onclick="eliminarclass()"> Cambiar imagen de perfil </div> 
                </div>
                <div>
                    <label for="name"> Usuario: </label>
                    @error('name')
                        <span class="d-block invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="text" id="name" name="name" value="{{$user->name}}" maxlength="30">

                    <label for="email" class="mt-3"> Correo: </label>
                    @error('email')
                        <span class="d-block invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>  
                    @enderror
                    <input type="text" id="email" name="email" value="{{$user->email}}">

                    <label for="bio" class="mt-3"> Biografía: </label>
                    @error('bio')
                        <span class="d-block invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <textarea id="bio" name="bio" class="form-control" style="resize: none;" rows="3" maxlength="40">{{$user->bio}}</textarea>

                    <div class="d-flex justify-content-center">
                        <input type="submit" class="boton_sesion" value="Actualizar datos">
                    </div>
                </div>
            </form>
        </div> 
    </div>
</main>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#5148ff" fill-opacity="1" d="M0,192L18.5,202.7C36.9,213,74,235,111,202.7C147.7,171,185,85,222,74.7C258.5,64,295,128,332,176C369.2,224,406,256,443,234.7C480,213,517,139,554,128C590.8,117,628,171,665,181.3C701.5,192,738,160,775,128C812.3,96,849,64,886,85.3C923.1,107,960,181,997,186.7C1033.8,192,1071,128,1108,85.3C1144.6,43,1182,21,1218,64C1255.4,107,1292,213,1329,250.7C1366.2,288,1403,256,1422,240L1440,224L1440,320L1421.5,320C1403.1,320,1366,320,1329,320C1292.3,320,1255,320,1218,320C1181.5,320,1145,320,1108,320C1070.8,320,1034,320,997,320C960,320,923,320,886,320C849.2,320,812,320,775,320C738.5,320,702,320,665,320C627.7,320,591,320,554,320C516.9,320,480,320,443,320C406.2,320,369,320,332,320C295.4,320,258,320,222,320C184.6,320,148,320,111,320C73.8,320,37,320,18,320L0,320Z" style="height:100%;width:100%;line-height: 0;overflow:hidden;font-size: 0"></path>
</svg>

<!-- Modal cambiar imagen de perfil -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar fotografía</h5>
                <button type="button" class="btn cerrado p-1" data-bs-dismiss="modal" aria-label="Close">
                    <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                </button>
            </div>
            <updateimagen-component :user_id="{{$user->id}}"></updateimagen-component>
        </div>
    </div>
</div>

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