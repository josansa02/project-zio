@extends('layouts.app')

@section("title", "Usuarios deshabilitados - ZIO")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/adminPetitions.css') }}">
@endsection

@section('content')

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                <a href="{{route('usersAdmin')}}" class="btn btn-form rounded-pill" role="button">Usuarios</a>
                <a href="{{route('admins')}}" class="btn btn-form rounded-pill" role="button">Administradores</a>
                <a href="{{route('usersReports')}}" class="btn btn-form rounded-pill" role="button" aria-pressed="true">Reportes</a>
                <a href="{{route('usersPetitions')}}" class="btn btn-form btn-form-active rounded-pill" role="button">Cuentas suspendidas</a>
            </li>
        
            <li class="list-group-item">
                @if (count($petitions) == 0)
                    <main class="container d-flex justify-content-center align-items-center p-4">
                        <h3 class="text-center">No hay peticiones de rehabilitación</h3>
                    </main>
                @else 
                    <div class="row justify-content-center align-items-center px-3">
                        <table>
                            <thead>
                                <tr class="text-center">
                                    <th>Foto de perfil</th>
                                    <th>Datos del usuario</th>
                                    <th>Petición para retirar el veto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petitions as $petition)
                                    <tr class="text-center">
                                        <td> 
                                            @foreach ($users as $user)
                                                @if ($user->id == $petition->user_id)
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <img class="img_suspendida" src="{{asset('/img/profileIMG/')}}/{{$user->profile_img}}" alt="Foto de perfil de {{$user->name}}"> 
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($users as $user)
                                                @if ($user->id == $petition->user_id)
                                                <div class="d-flex flex-column">
                                                    {{$user->name}}
                                                    {{$user->email}}    
                                                </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$petition->unban_reason}}
                                        </td>
                                        <td> 
                                            @foreach ($users as $user)
                                                @if ($user->id == $petition->user_id)
                                                    <form class="swal-confirmar" action="{{route('enabled.user', $user->id)}}" method="post">
                                                        @csrf
                                                        @method("put")
                                                        <button type="submit" class="btn btn-warning d-flex justify-content-center align-items-center gap-1"> Habilitar <span class="material-symbols-outlined">account_circle</span> </button>
                                                    </form>
                                                @endif
                                            @endforeach 
                                        </td>
                                    </tr>
                                @endforeach
        
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {!! $petitions->links() !!}
                        </div>
                    </div>
                @endif
            </li>
        </ul>
    </div>
</div>


@section('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.swal-confirmar').submit(function(e){
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
            text: "¿Seguro que quieres habilitar esta cuenta de usuario?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, habilitar',
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

@endsection
