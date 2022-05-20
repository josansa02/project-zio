@extends("layouts.app")

@section("title", "Galería personal - ZIO")

@section("styles")
<link rel="stylesheet" href="{{ asset('css/galeria.css') }}">
@endsection

@section('content')
@if (count($messages) == 0)
    <main class="container d-flex justify-content-center align-items-center mt-5">
        <h3 class="text-center">No tiene mensajes</h3>
    </main>
@else 
<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                Mensajes en la bandeja de entrada: {{count($messages)}}
                <button class="btn btn-danger gap-2 text-white d-flex justify-content-center">Borrar mensajes <span class="material-symbols-outlined">delete</span></button>
            </li>
            <li class="list-group-item">
                @foreach ($messages as $message)
                    <div class="d-flex align-items-center justify-content-center gap-3 my-3">
                        <img src="{{asset('/img/profileIMG')}}/{{$message[1]->profile_img}}" alt="Foto perfil {{$message[1]->name}}">
                        <img src="{{asset('/img/usersIMG')}}/{{$message[1]->img_name}}" alt="Foto comentada por {{$message[1]->name}}">
                        {{$message[1]->name}}
                        <button class="boton-galeria btn bg-dark-purple text-white px-4 d-flex justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{$i}}">Leer <span class="material-symbols-outlined">local_library </span></button>
                        <button class="btn btn-danger text-white d-flex justify-content-center px-2"><span class="material-symbols-outlined"> delete </span></button>
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
                                        <p class="mt-3"> <strong> <img src="{{asset('/img/profileIMG/')}}{{$message[1]->profile_img}}" class="img-fluid imagen_modal_usu"> {{$message[1]->name}}: </strong> </p>
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