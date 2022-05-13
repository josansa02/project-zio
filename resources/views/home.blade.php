@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}

                    <h2> Prueba de componentes </h2>
                    <!-- Prueba components -->
                    <example-component></example-component>
                    <login-component></login-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
