@extends('layouts.app')

@section("title", "Añadir administradores - ZIO")

@section('content')

<div class="container mt-3 mb-3">
    <div class="card">
        <ul class="list-group list-group-flush">
            <li class="list-group-item align-items-center d-flex justify-content-center gap-3">
                <a href="{{route('usersAdmin')}}" class="btn btn-primary rounded-pill" role="button">Usuarios</a>
                <a href="{{route('addAdmin')}}" class="btn btn-primary active rounded-pill" role="button">Añadir administrador</a>
                <a href="{{route('usersReports')}}" class="btn btn-primary rounded-pill" role="button" aria-pressed="true">Reportes</a>
                <a href="{{route('usersPetitions')}}" class="btn btn-primary rounded-pill" role="button">Cuentas suspendidas</a>
            </li>
        
            <li class="list-group-item">
                <adminform-component :route="{{json_encode(route('store.admin'))}}"></updateimagen-component>

            </li>
        </ul>
    </div>
</div>

@endsection
