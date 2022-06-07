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
                @foreach ($users as $user)
                    <div class="d-flex align-items-center justify-content-center gap-3 my-3">
                        {{$user}}
                    </div>
                @endforeach
            </li>
        </ul>
    </div>
</div>

@endif

@endsection
