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
            <li class="list-group-item">Mensajes en la bandeja de entrada: {{count($messages)}} </li>
            <li class="list-group-item">
                @foreach ($messages as $message)
                    @foreach ($message as $data)
                        {{$data[0]->message}}
                        {{$data[0]->name}}
                        {{$data[0]->name}}
                        <div style="height: 10px">

                        </div>
                    @endforeach  
                    <div style="height: 50px">

                    </div>
                @endforeach
            </li>
        </ul>
    </div>
</div>
@endif
@endsection