@extends('layouts.app')

@section("title", "Galería - ZIO")

@section('content')

@if (count($users) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center">No hay usuarios registrados</h3>
    </main>
@else 

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                enlaces
            </li>
            <li class="list-group-item">
                <table>
                    <thead>
                        <tr>
                            <th>Foto de perfil</th>
                            <th>Nombre de usuario</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td> <img style="width: 60px" src="{{asset('/img/profileIMG/' . $user->profile_img)}}" alt="Imagen de perfil del usuario {{$user->name}}"> </td>
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
                
            </li>
        </ul>
    </div>
</div>

@endif

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
