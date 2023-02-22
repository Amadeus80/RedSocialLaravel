@extends('layout.plantilla')

@section("title", "Inicio")

@section('content')    

<style>

    .tituloPost{
        text-overflow: ellipsis ;
        white-space: nowrap;
        overflow: hidden;
    }

    @media (min-width: 992px) {
        .post{
            width: 50% !important;
        }
    }

</style>

{{-- 
@foreach ($posts as $post)
        <div>
            <h1>{{$post->titulo}}</h1>
            <img src="{{$post->img}}" alt="">
            <span class="">user: {{$post->user->name}}</span>
            <img src="{{$post->user->profile->img}}" alt="" width="50" height="50">
            <span class="">Fecha: {{$post->created_at}}</span>
        </div>
@endforeach --}}

<div class="container p-4 rounded d-flex flex-column justify-content-center">{{-- Div fondo --}}
    @foreach ($posts as $post)
        <div class="post container-fluid w-100 mx-auto mb-5"> {{-- Div Card --}}
            <div class="bg-dark-subtle rounded-top">
                <div class="d-flex align-items-center gap-3 ms-4">
                    <img src="{{asset($post->user->profile->img)}}" alt="imagenUsuario" width="50px" height="50px" class="img-fluid rounded-circle">
                    <div class="mt-3 d-flex flex-column align-items-center justify-content-center">
                        <h5>{{$post->user->name}}</h5>
                        <p>{{$post->created_at}}</p>
                    </div>
                </div>
            </div>
        
            <div class="m-auto">
                <img src="{{asset($post->img)}}" alt="imagen" class="img-fluid w-100">
            </div>
        
            <div class="bg-dark-subtle m-auto rounded-bottom p-2 d-flex align-items-center">
                <i class="icono bi bi-heart fs-2 mx-2"></i>
                <i class="icono bi bi-chat fs-2 mx-2"></i>
                <h4 class="tituloPost m-auto p-1">{{$post->titulo}}</h4>
            </div>
        </div>
    @endforeach
</div>

@endsection