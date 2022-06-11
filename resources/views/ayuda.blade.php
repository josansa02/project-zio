@php
    session_start();
@endphp


@extends("layouts.app")

@section("title", "Ayuda - ZIO")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/ayuda.css') }}">
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

<main class="container my-3">
    <div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        ¿Cómo puedo reportar una imagen?
                    </button>
                </h2>

              <!-- Acordeón 1 -->
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para reportar una imagen debe seguir estos pasos:</p>
                        <ol>
                            <li> Pulsar la imagen para que se muestre la ventana emergente </li>
                            <li> <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <span class="material-symbols-outlined text-danger">report</span> </div> </li>
                            <li> Este mostrará una ventana desde la que podrá seleccionar la causa del reporte y enviarlo </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Acordeón 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    ¿Cómo puedo comentar una imagen?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para comentar una imagen debe seguir estos pasos:</p>
                        <ol>
                            <li> Pulsar la imagen para que se muestre la ventana emergente </li>
                            <li> 
                                <div class="d-flex align-items-center gap-2"> 
                                    <span>Escribir el comentario en el bloque</span> 
                                    <span>  
                                        <div class="input-group">
                                            <input type="text" class="form-control text-comment" name="message" disabled>
                                            <input class="btn btn-comment" disabled type="submit" value="Comentar">
                                        </div>
                                    </span> 
                                </div> 
                            </li>
                            <li> Pulsar en el botón de comentar </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Acordeón 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        ¿Cómo puedo cambiar el correo asociado?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para cambiar el correo asociado debe seguir estos pasos:</p>
                        <ol>
                            <li> Pulsar en la imagen de perfil para que se muestre el desplegable con las secciones </li>
                            <li> <span class="d-flex align-items-center gap-1"> Seleccionar <span class="d-flex align-items-center gap-2"> <strong>Editar perfil</strong> <span class="material-symbols-outlined text-black"> settings </span> </span> </span> </li>
                            <li> Modificar el apartado <strong>Correo</strong>. En caso de que no sea usado por otro usuario habrá finalizado el cambio </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Acordeón 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        ¿Cómo puedo mirar la bandeja de mensajes?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para mirar la bandeja de mensajes debe seguir estos pasos:</p>
                        <ol>
                            <li> Pulsar en la imagen de perfil para que se muestre el desplegable con las secciones </li>
                            <li> <span class="d-flex align-items-center gap-1"> Seleccionar <span class="d-flex align-items-center gap-2"> <strong>Galería personal</strong> <span class="material-symbols-outlined text-black"> home </span> </span> </span> </li>
                            <li> 
                                <span class="d-flex align-items-center gap-2">
                                    Pulsar el botón
                                    <a type="button" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center w-5">
                                        <span class="material-symbols-outlined">chat</span>
                                    </a>  
                                </span>  
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Acordeón 5 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        ¿Cómo puedo subir una imagen?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para subir una imagen debe seguir estos pasos:</p>
                        <ol>
                            <li> Pulsar en la imagen de perfil para que se muestre el desplegable con las secciones </li>
                            <li> <span class="d-flex align-items-center gap-1"> Seleccionar <span class="d-flex align-items-center gap-2"> <strong>Galería personal</strong> <span class="material-symbols-outlined text-black"> home </span> </span> </span> </li>
                            <li> 
                                <span class="d-flex align-items-center gap-2">
                                    Pulsar el botón
                                    <a type="button" class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center w-5">
                                        <span class="material-symbols-outlined">add_circle</span>
                                    </a>  
                                </span>  
                            </li>
                            <li> Rellenar los datos del formulario y adjuntar una imagen </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- Acordeón 6 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseFive">
                        ¿Cómo puedo votar una fotografía?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para votar una imagen debe seguir estos pasos:</p>
                        <ul>
                            <li> Desde la galería principal: </li>
                            <ol>
                                <li> 
                                    <span class="d-flex align-items-center gap-1"> 
                                        Pulsar 
                                        <span class="d-flex align-items-center gap-2"> 
                                            <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple no-photo-link">
                                                recommend
                                            </span>
                                        </span> 
                                    </span> 
                                </li>
                                <li> 
                                    <span class="d-flex align-items-center gap-1">
                                        Una vez pulsado, aparecerá
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple">
                                                check_circle
                                            </span>
                                        </span>
                                        indicando la confirmación del voto
                                    </span>
                                </li>
                                <li>
                                    <span class="d-flex align-items-center gap-1">
                                        Para retirarlo, pulse de nuevo
                                        <span class="material-symbols-outlined text-dark-purple">
                                            check_circle
                                        </span>
                                    </span>
                                </li>
                            </ol>
                            <li> Desde la galería personal de un usuario: </li>
                            <ol>
                                <li> Previsualizar una imagen </li>
                                <li> 
                                    <span class="d-flex align-items-center gap-1"> 
                                        Pulsar 
                                        <span class="d-flex align-items-center gap-2"> 
                                            <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple no-photo-link">
                                                recommend
                                            </span>
                                        </span> 
                                    </span> 
                                </li>
                                <li> 
                                    <span class="d-flex align-items-center gap-1">
                                        Una vez pulsado, aparecerá
                                        <span class="d-flex align-items-center gap-2">
                                            <span class="material-symbols-outlined d-flex justify-content-center text-dark-purple">
                                                check_circle
                                            </span>
                                        </span>
                                        indicando la confirmación del voto
                                    </span>
                                </li>
                                <li>
                                    <span class="d-flex align-items-center gap-1">
                                        Para retirarlo, pulse de nuevo
                                        <span class="material-symbols-outlined text-dark-purple">
                                            check_circle
                                        </span>
                                    </span>
                                </li>
                            </ol>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Acordeón 7 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseFive">
                        ¿Cómo puedo acceder a la galería de otros usuarios?
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Para acceder a la galería de otros usuarios debe seguir estos pasos:</p>
                        <ul>
                            <li> Desde la galería principal, dar click sobre la imagen de perfil de un usuario </li>
                            <li> Escribiendo el nombre del usuario que quiera visitar en la barra de búsqueda </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Acordeón 8 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseFive">
                        Filtrar imágenes de la galería principal
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> 
                            Dar click sobre el botón 
                            <a type="button" class="rounded-pill boton-galeria btn bg-dark-purple text-white dropdown-toggle">
                                Filtrar
                            </a>
                            en la galería principal 
                        </p>
                        <ul>
                            <li> El filtro <strong>Más votadas</strong> mostrará las imágenes con mas votos, en orden </li>
                            <li> El filtro <strong>Más recientes</strong> mostrará las últimas imágenes subidas a la plataforma, en orden </li>
                            <li> El filtro <strong>Todas</strong> mostrará todas las imágenes </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection