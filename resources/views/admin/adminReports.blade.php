@extends('layouts.app')

@section("title", "Reportes - ZIO")

@section('content')

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                <a href="{{route('usersAdmin')}}" class="btn btn-primary rounded-pill" role="button">Usuarios</a>
                <a href="{{route('admins')}}" class="btn btn-primary rounded-pill" role="button">Administradores</a>
                <a href="{{route('usersReports')}}" class="btn active btn-primary rounded-pill" role="button" aria-pressed="true">Reportes</a>
                <a href="{{route('usersPetitions')}}" class="btn btn-primary rounded-pill" role="button">Cuentas suspendidas</a>
            </li>
        
            <li class="list-group-item">
                @if (count($reports) == 0)
                    <main class="container d-flex justify-content-center align-items-center p-4">
                        <h3 class="text-center">No hay reportes</h3>
                    </main>
                @else 
                    <div class="row justify-content-center align-items-center">
                        <table class="col-10">
                            <thead>
                                <tr>
                                    <th>Foto de reportada</th>
                                    <th>Usuario reportado</th>
                                    <th>Usuario reporte</th>
                                    <th>Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>
                                            @foreach ($images as $image)
                                                @if ($image->id == $report->img_id)
                                                    <a href="#exampleModal{{$image->id}}" data-bs-toggle="modal"> <img style="height: 40px; width: 70px; border-radius: 50px" src="{{asset('/img/usersIMG/')}}/{{$image->img_name}}" alt="Foto reportada"> </a>
                                                    <div class="modal fade" id="exampleModal{{$image->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header gap-3">
                                                                    <h5 class="modal-title text-center" id="exampleModalLabel">{{$image->title}}</h5>
                                                                    <button type="button" class="btn cerrado p-1" data-bs-dismiss="modal" aria-label="Close"> 
                                                                        <span class="d-flex justify-content-center align-items-center material-symbols-outlined">close</span> 
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="imagen_modal">
                                                                        <img src="{{asset('/img/usersIMG/' . $image->img_name)}}" class="img-fluid">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td> 
                                            @foreach ($users as $user)
                                                @if ($user->id == $report->owner_id)
                                                    {{$user->name}}
                                                @endif
                                            @endforeach 
                                        </td>
                                        <td> 
                                            @foreach ($users as $user)
                                                @if ($user->id == $report->reporter_id)
                                                    {{$user->name}}
                                                @endif
                                            @endforeach  
                                        </td>
                                        <td> {{$report->reason}}  </td>
                                        <td> 
                                            <form class="swal-confirmar-borrar" action="{{route('delete.report', $report->id)}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <input type="submit" class="btn btn-danger" value="Eliminar">
                                            </form>
                                        </td>
                                        <td> 
                                            @foreach ($images as $image)
                                                @if ($image->id == $report->img_id)
                                                    <form class="swal-confirmar-borrar-img" action="{{route('delete.img', $image->id)}}" method="post">
                                                        @csrf
                                                        @method("delete")
                                                        <input type="submit" class="btn btn-danger" value="Eliminar imagen">
                                                    </form>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td> 
                                            @foreach ($users as $user)
                                                @if ($user->id == $report->owner_id)
                                                    <form class="swal-confirmar-banear" action="{{route('enabled.user', $user->id)}}" method="post">
                                                        @csrf
                                                        @method("put")
                                                        <input type="submit" class="btn btn-danger" value="Suspender">
                                                    </form>
                                                @endif
                                            @endforeach 
                                        </td>
                                    </tr>
                                @endforeach
        
                            </tbody>
                        </table>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {!! $reports->links() !!}
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
            text: "¿Seguro que quieres eliminar este registro de reporte?",
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

<script>
    $('.swal-confirmar-banear').submit(function(e){
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
            text: "¿Seguro que quieres deshabilitar este usuario?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, deshabilitar',
            cancelButtonText: 'No, cancelar',
            reverseButtons: true,
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    });
</script>

<script>
    $('.swal-confirmar-borrar-img').submit(function(e){
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
            text: "¿Seguro que quieres eliminar está imagen? Se notificará a su dueño.",
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
