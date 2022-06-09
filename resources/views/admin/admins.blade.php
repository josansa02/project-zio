@extends('layouts.app')

@section("title", "Administradores - ZIO")

@section('content')

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                <a href="{{route('usersAdmin')}}" class="btn btn-primary rounded-pill" role="button">Usuarios</a>
                <a href="{{route('admins')}}" class="btn btn-primary active rounded-pill" role="button">Administradores</a>
                <a href="{{route('usersReports')}}" class="btn btn-primary rounded-pill" role="button" aria-pressed="true">Reportes</a>
                <a href="{{route('usersPetitions')}}" class="btn btn-primary rounded-pill" role="button">Cuentas suspendidas</a>
            </li>
        
            <li class="list-group-item">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#adminModal">
                    Registrar administrador
                </button>
                @if (count($users) == 0)
                    <main class="container d-flex justify-content-center align-items-center mt-5">
                        <h3 class="text-center">No hay usuarios registrados</h3>
                    </main>
                @else 
                    <div class="row justify-content-center align-items-center">
                        <table class="col-10">
                            <thead>
                                <tr>
                                    <th>Nombre de usuario</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    @if (auth()->user()->id != $user->id)
                                        <tr>
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
                                    @endif
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

<!-- Modal registrar administradores -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo administrador</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <adminform-component :route="{{json_encode(route('store.admin'))}}"></adminform-componen>
    </div>
    </div>
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
            text: "¿Seguro que quieres eliminar este administrador?",
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