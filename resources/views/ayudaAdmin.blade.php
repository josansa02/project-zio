@php
    session_start();
@endphp


@extends("layouts.app")

@section("title", "ZIO - Ayuda administradores")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/ayuda.css') }}">
@endsection

@section('content')

<main class="container mt-3">
    <div>
        <div class="accordion" id="accordionExample">

            <!-- Acordeón 1 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        ¿Cómo funciona la vista de usuarios?
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Funciones de la vista de usuarios:</p>
                        <ul>
                            <li> Visualizar los datos de los usuarios </li>
                            <li> 
                                Eliminar un usuario 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center"> Eliminar <span class="material-symbols-outlined">delete</span> </button> <span>en la fila del usuario</span> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Si, eliminar </button> <span>(esta acción es irreversible)</span> </div> 
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Acordeón 2 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Cómo funciona la vista de administradores?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Funciones de la vista de administradores:</p>
                        <ul>
                            <li> Visualizar los datos de los administradores </li>
                            <li>
                                Registrar un administrador 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center gap-1"> <span>Registrar administrador</span> <span class="material-symbols-outlined"> person_add </span> </button> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Rellenar el formulario y pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Registrar </button> </div> 
                                    </li>
                                </ol>
                            </li>
                            <li class="mt-2"> 
                                Eliminar un administrador 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center"> Eliminar <span class="material-symbols-outlined">delete</span> </button> <span>en la fila del administrador</span> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Si, eliminar </button> <span>(esta acción es irreversible)</span> </div> 
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Acordeón 3 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        ¿Cómo funciona la vista de reportes?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Funciones de la vista de reportes:</p>
                        <ul>
                            <li> Visualizar los datos de los reportes </li>
                            <li> 
                                Eliminar un registro de reporte 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center gap-1"> Eliminar <span class="material-symbols-outlined">delete</span> </button> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Si, eliminar </button> <span>(esta acción es irreversible)</span> </div> 
                                    </li>
                                </ol>
                            </li>
                            <li class="mt-3"> 
                                Eliminar la imagen de reporte 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center gap-1"> Eliminar imagen <span class="material-symbols-outlined">image_not_supported</span> </button> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Si, eliminar </button> <span>(esta acción es irreversible)</span> </div> 
                                    </li>
                                </ol>
                            </li>
                            <li class="mt-3"> 
                                Suspender al usuario reportado 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center gap-1"> Suspender <span class="material-symbols-outlined">person_off</span> </button> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Si, deshabilitar </button> </div> 
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Acordeón 4 -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        ¿Cómo funciona la vista de cuentas suspendidas?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p> Funciones de la vista de cuentas suspendidas:</p>
                        <ul>
                            <li> Visualizar los datos de los usuarios vetados </li>
                            <li> 
                                Habilitar un usuario 
                                <ol>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-warning d-flex justify-content-center align-items-center gap-1"> Habilitar <span class="material-symbols-outlined">account_circle</span> </button> <span>en la fila del usuario</span> </div> 
                                    </li>
                                    <li> 
                                        <div class="d-flex align-items-center gap-1 mt-2"> <span>Pulsar en el botón</span> <button type="button" class="btn btn-success d-flex justify-content-center align-items-center"> Si, habilitar </button> </div> 
                                    </li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection