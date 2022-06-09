@extends("layouts.app")

@section("title", "Mensajes - ZIO")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
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

@if (count($messages) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center text-blue">No tiene mensajes</h3>
    </main>
@else 
<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                Mensajes en la bandeja de entrada: {{count($messages)}}
                <form action="{{route('messages.delete.all')}}" class="swal-confirmar-borrar-todos" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger gap-2 text-white d-flex justify-content-center">Borrar mensajes <span class="material-symbols-outlined">delete</span></button>
                </form>
            </li>
            <li class="list-group-item">
                @foreach ($messages as $message)
                    <div class="d-flex align-items-center justify-content-center gap-3 my-3">
                        <img style="width: 40px" src="{{asset('/img/profileIMG')}}/{{$message[1]->profile_img}}" alt="Foto perfil {{$message[1]->name}}">
                        <img style="width: 70px; border-radius: 50px" src="{{asset('/img/usersIMG')}}/{{$message[2]->img_name}}" alt="Foto comentada por {{$message[1]->name}}">
                        {{$message[1]->name}}
                        <button class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}">Leer <span class="material-symbols-outlined">local_library </span></button>
                        <form action="{{route('messages.delete', $message[0]->id)}}" class="swal-confirmar-borrar" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger text-white d-flex justify-content-center px-2"><span class="material-symbols-outlined"> delete </span></button>
                        </form>
                        <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header gap-3">
                                        <h5 class="modal-title text-center" id="exampleModalLabel">{{$message[2]->title}}</h5>
                                        <button type="button" class="btn-close m-0 cerrado" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="imagen_modal mt-3">
                                            <img src="{{asset('/img/usersIMG/' . $message[2]->img_name)}}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-start">
                                        <p class="mt-3"> <strong> <img src="{{asset('/img/profileIMG')}}/{{$message[1]->profile_img}}" class="img-fluid imagen_modal_usu"> {{$message[1]->name}}: </strong> </p>
                                        <p> {{$message[0]->message}} </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $i++ @endphp
                @endforeach
            </li>
        </ul>
    </div>
</div>
@endif
@endsection

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
        text: "¿Seguro que quieres eliminar el mensaje?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
        })
    });
</script>
<script>
    $('.swal-confirmar-borrar-todos').submit(function(e){
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
        text: "¿Seguro que quieres eliminar todos los mensajes?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'No, cancelar',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
        })
    });
</script>
@endsection