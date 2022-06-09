@extends('layouts.app')

@section("title", "Usuarios - ZIO")

@section('content')

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                <a href="{{route('usersAdmin')}}" class="btn btn-primary active rounded-pill" role="button" aria-pressed="true">Usuarios</a>
                <a href="{{route('admins')}}" class="btn btn-primary rounded-pill" role="button">Administradores</a>
                <a href="{{route('usersReports')}}" class="btn btn-primary rounded-pill" role="button">Reportes</a>
                <a href="{{route('usersPetitions')}}" class="btn btn-primary rounded-pill" role="button">Cuentas suspendidas</a>
            </li>
            <li class="list-group-item">
                @if (count($users) == 0)
                    <main class="container d-flex justify-content-center align-items-center mt-5">
                        <h3 class="text-center">No hay usuarios registrados</h3>
                    </main>
                @else 
                    <div class="row justify-content-center align-items-center">
                        <table class="col-10">
                            <thead>
                                <tr class="text-center">
                                    <th>Foto de perfil</th>
                                    <th>Nombre de usuario</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td> <div class="d-flex justify-content-center"> <img style="width: 60px" src="{{asset('/img/profileIMG/' . $user->profile_img)}}" alt="Imagen de perfil del usuario {{$user->name}}"> </div> </td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->email}} </td>
                                        <td> 
                                            <form class="swal-confirmar-borrar" action="{{route('delete.user', $user->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <input type="submit" class="btn btn-danger" value="Eliminar">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
        
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {!! $users->links() !!}
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
            text: "¿Seguro que quieres eliminar este usuario?",
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

@endsection
