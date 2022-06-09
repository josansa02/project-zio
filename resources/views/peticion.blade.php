@extends('layouts.app')

@section("title", "Galería - ZIO")

@section('content')

<peticionform-component :user_id="{{json_encode(auth()->user()->id)}}"></peticionform-component>

@endsection
