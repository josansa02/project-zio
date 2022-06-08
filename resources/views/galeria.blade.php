@extends("layouts.app")

@section("title", "Galería personal - ZIO") <!-- Título de la página -->

<!-- Sección de estilos de la página -->
@section("styles")
<link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
@endsection

<!-- **Sección de contenido** -->
@section('content')

    <!-- Muestra un alerta que informe que un reporte ha sido llevado a cabo tras su realización -->
    @if (isset($_SESSION["report"]))
    <div class="row justify-content-center fixed-bottom">
        <div class="alert alert-danger alert-dismissible fade show w-25" role="alert">
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
        <div class="alert alert-primary alert-dismissible fade show w-25" role="alert">
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
        <div class="alert alert-success alert-dismissible fade show w-25" role="alert">
            <strong>{{$_SESSION["update"]}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @php
            unset($_SESSION["update"]);
        @endphp
    </div>
    @endif

@if ($user->enabled)

    <div class="profile d-flex flex-column justify-content-center align-items-center gap-3 py-4">
        <div class="d-flex align-items-center gap-3">
            <img src="{{asset('/img/profileIMG/')}}/{{$user->profile_img}}" class="img-fluid imagen_usu">
            <div class="mt-2">
            <h3>{{$user->name}}</h3>
            <p>{{$user->bio}}</p>
            </div>
        </div>

        <!-- 
            Si el usuario autenticado es el mismo que está en la vista de galería 
            personal hace lo siguiente:
        -->
        @if (Auth::user()->name == $user->name)
        <div style="gap: 2px" class="d-flex mt-2 btn-group user-buttons rounded">
            <button type="button" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="eliminarclass()">
                <span class="material-symbols-outlined">add_circle</span>
            </button>
            @if ($_SESSION["nMensajes"] < $nMensajes)
                <a type="button" href="{{route('messages', $user->id)}}" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center">
                    <span class="material-symbols-outlined">
                        chat
                        <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </span>
                </a>
            @else 
                <a type="button" href="{{route('messages', $user->id)}}" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center">
                    <span class="material-symbols-outlined">chat</span>
                </a>
            @endif
        </div>
        @endif
    </div>

    <!-- Si el usuario NO TIENE imagenes hace lo siguiente: -->
    @if (count($imagenes) == 0)
        <main class="container d-flex justify-content-center align-items-center mt-5">
            <h3 class="text-center text-blue">Aún no ha subido ninguna imagen</h3>
        </main>
    @else 

    <!-- Si el usuario TIENE imagenes hace lo siguiente: -->
    <main class="container mt-3 mb-3">
        @foreach ($imagenes as $imagen)
            <div class="imagenes-div">
                <img src="{{asset('/img/usersIMG/' . $imagen[0]->img_name)}}" alt="{{$imagen[0]->title}}" class="img-fluid imagen_galeria" data-bs-toggle="modal" data-bs-target="#exampleModal{{$imagen[0]->id}}" onclick="eliminarclass()">
            </div>

            <!-- Modal de cada imagen -->
            <div class="modal fade" id="exampleModal{{$imagen[0]->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header gap-3">
                            @if ($user->id == Auth::user()->id)
                            <button type="button" class="btn dropdown-button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-flex justify-content-center align-items-center material-symbols-outlined">menu</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form class="swal-confirmar-borrar" action="{{route('image.delete', $imagen[0]->id)}}" method="post">
                                        @csrf
                                        @method("delete")
                                        <input type="submit" class="dropdown-item" value="Eliminar">
                                    </form>
                                </li>
                            </ul>
                            @else 
                                <button class="btn d-flex justify-content-center align-items-center" type="button" data-bs-target="#modalReportar{{$imagen[0]->id}}" data-bs-toggle="modal">
                                    <span class="material-symbols-outlined text-danger">report</span>
                                </button>
                            @endif
                            <h5 class="modal-title text-center" id="exampleModalLabel">{{$imagen[0]->title}}</h5>
                            <button type="button" class="btn cerrado p-1" data-bs-dismiss="modal" aria-label="Close"> 
                                <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="imagen_modal">
                                <img src="{{asset('/img/usersIMG/' . $imagen[0]->img_name)}}" class="img-fluid">
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3 px-3">
                                <p class="d-flex align-items-center gap-1"> 
                                    <img src="{{asset('/img/profileIMG/' . $user->profile_img)}}" class="img-fluid imagen_modal_usu no-photo-link"> 
                                    <strong> {{$user->name}}: </strong> 
                                    <span> {{$imagen[0]->footer}} </span>
                                </p>
                                @if ($user->id == auth()->user()->id)
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-1">
                                        <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple no-photo-link"> recommend </span>
                                        <span> {{$imagen[1]}} </span>    
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if ($user->id != Auth::user()->id)
                            <div class="modal-footer justify-content-between">
                                <div class="d-flex align-items-center gap-1">
                                    <img src="{{asset('/img/profileIMG/')}}/{{auth()->user()->profile_img}}" alt="ProfileImg" class="my-modal-img no-photo-link">
                                    <form action="{{ route('messages.add') }}" method="post">
                                        @csrf
                                        @method("post")
                                        <div class="input-group">
                                            <input type="text" class="form-control text-comment" onkeyup="comprobar('message{{$imagen[0]->id}}', 'comentar{{$imagen[0]->id}}')" name="message" id="message{{$imagen[0]->id}}">
                                            <input type="hidden" name="img_id" id="img_id" value="{{$imagen[0]->id}}">
                                            <input type="hidden" name="owner_id" id="owner_id" value="{{$imagen[0]->user_id}}">
                                            <input type="hidden" name="name" id="name" value="{{$user->name}}">
                                            <input class="btn btn-comment" id="comentar{{$imagen[0]->id}}" type="submit" disabled value="Comentar">
                                        </div>
                                    </form>    
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalReportar{{$imagen[0]->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Reportar esta imagen</h5>
                        <button type="button" class="btn cerrado p-1" data-bs-target="#exampleModal{{$imagen[0]->id}}" data-bs-toggle="modal" onclick="eliminarclass()">
                            <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                        </button>
                    </div>
                    <form action="{{route('reports.add')}}" method="post">
                        @csrf
                        @method("post")
                        <input type="hidden" name="img_id" value="{{$imagen[0]->id}}">
                        <input type="hidden" name="owner_id" value="{{$imagen[0]->user_id}}">
                        <input type="hidden" name="name" value="{{$user->name}}">
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

    <!-- Modal subir imagen -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subir fotografía</h5>
                    <button type="button" class="btn cerrado p-1" data-bs-dismiss="modal" aria-label="Close">
                        <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                    </button>
                </div>
                <imagenform-component></imagenform-component>
            </div>
        </div>
    </div>

    {{$_SESSION["nMensajes"]}}
    {{$nMensajes}}

    <!-- Sección de scripts de la página -->
    @section('js')

    <script>
        function comprobar(id1, id2) {
            var input = document.getElementById(id1);
            var boton = document.getElementById(id2);
            boton.disabled = true;
            if (input.value != ""){            
                boton.disabled = false;
            }
        }

        function eliminarclass() {
            bod = document.getElementById("bod");
            bod.setAttribute("style", "");
        }
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.swal-confirmar-borrar').submit(function(e){
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-2'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estás seguro?',
                text: "¿Seguro que quieres eliminar esta fotografía?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, cancelar',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

    @endsection

@else 

<main class="container d-flex flex-column justify-content-center align-items-center mt-5">
    <div class="d-flex align-items-center gap-3">
        <img src="{{asset('/img/profileIMG/')}}/{{$user->profile_img}}" class="img-fluid imagen_usu">
        <div class="mt-2">
        <h3>{{$user->name}}</h3>
        <p>{{$user->bio}}</p>
        </div>
    </div>
    <h3 class="text-center mt-5">Esta cuenta ha sido suspendida</h3>
</main>

@endif

@endsection