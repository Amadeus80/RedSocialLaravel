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

@php
    use App\models\Like;
@endphp

<div class="container p-4 rounded d-flex flex-column justify-content-center">{{-- Div fondo --}}
    @if (count($posts) > 0)    
        @foreach ($posts as $post)
            <div class="post container-fluid w-100 mx-auto mb-5"> {{-- Div Card --}}
                <div class="bg-dark-subtle rounded-top">
                    <div class="d-flex align-items-center gap-3 ms-4">
                        <img src="{{asset($post->user->profile->img)}}" alt="imagenUsuario" width="50px" height="50px" class="rounded-circle">
                        <div class="mt-3 d-flex flex-column align-items-center justify-content-center">
                            <h5>{{$post->user->name}}</h5>
                            <p>{{$post->created_at}}</p>
                        </div>
                    </div>
                </div>
            
                <div class="m-auto">
                    <a href="#"><img src="{{asset($post->img)}}" alt="imagen" class="img-fluid w-100"></a>
                </div>
            
                <div class="bg-dark-subtle m-auto rounded-bottom p-2 d-flex align-items-center">
                    <div class="text-center mx-2 d-flex flex-column">
                        <a href="#"><i class="icono bi bi-heart fs-2"></i></a><span>{{count(Like::where("post_id", $post->id)->get())}}</span>
                    </div>
                    <div class="text-center mx-2 d-flex flex-column">
                        <a href="#"><i class="icono bi bi-chat fs-2"></i></a><span>{{count($post->comment)}}</span>
                    </div> 
                    <h4 class="tituloPost m-auto p-1">{{$post->titulo}}</h4>
                </div>
            </div>
        @endforeach
    @else
        <h1 class="text-center text-white">No hay posts</h1>
        <img src="{{asset('img/no_posts.svg')}}" alt="imagen no posts" class="img-fluid w-50 mx-auto mt-3">
    @endif
</div>

@endsection