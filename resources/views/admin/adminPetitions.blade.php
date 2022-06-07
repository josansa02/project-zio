@extends('layouts.app')

@section("title", "Usuarios deshabilitados - ZIO")

@section('content')

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                <a href="{{route('usersAdmin')}}" class="btn btn-primary rounded-pill" role="button">Usuarios</a>
                <a href="" class="btn btn-primary rounded-pill" role="button">Añadir administrador</a>
                <a href="{{route('usersReports')}}" class="btn btn-primary rounded-pill" role="button" aria-pressed="true">Reportes</a>
                <a href="{{route('usersPetitions')}}" class="btn active btn-primary rounded-pill" role="button">Cuentas suspendidas</a>
            </li>
        
            <li class="list-group-item">
                @if (count($petitions) == 0)
                    <main class="container d-flex justify-content-center align-items-center p-4">
                        <h3 class="text-center">No hay peticiones de rehabilitación</h3>
                    </main>
                @else 
                    <div class="row justify-content-center align-items-center">
                        <table class="col-10">
                            <thead>
                                <tr>
                                    <th>Datos del usuario</th>
                                    <th>Petición para retirar el veto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petitions as $petition)
                                    <tr>
                                        <td>
                                            @foreach ($users as $user)
                                                @if ($user->id == $petition->user_id)
                                                <div class="d-flex">
                                                    <div>
                                                        <img style="height: 40px; width: 40px; border-radius: 50px" src="{{asset('/img/profileIMG/')}}/{{$user->profile_img}}" alt="Foto de perfil de {{$user->name}}">
                                                    </div>
                                                    <div>
                                                        {{$user->name}}
                                                        {{$user->email}}    
                                                    </div>
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
                                                        <input type="submit" class="btn btn-warning" value="Habilitar">
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
