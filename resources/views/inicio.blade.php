@extends('layout.plantilla')

@section("title", "Inicio")

@section('content') 

@vite(['resources/css/post.css'])

@php
    use App\models\Like;
@endphp

<div class="container p-4 rounded d-flex flex-column justify-content-center">{{-- Div fondo --}}
    @if (count($posts) > 0)
        <h1 class="text-center text-white pb-5">Timeline</h1>    
        @foreach ($posts as $post)
            <div class="post container-fluid w-100 mx-auto mb-5"> {{-- Div Card --}}
                <div class="bg-dark-subtle rounded-top">
                    <div class="d-flex align-items-center gap-3 ms-4">
                        <a href="#"><img src="{{asset($post->user->profile->img)}}" alt="imagenUsuario" width="50px" height="50px" class="rounded-circle"></a>
                        <div class="mt-3 d-flex flex-column align-items-center justify-content-center">
                            <a href="#" class="text-decoration-none text-dark"><h5>{{$post->user->name}}</h5></a>
                            <p>{{$post->created_at}}</p>
                        </div>
                    </div>
                </div>
            
                <div class="m-auto">
                    <a href="{{route('post', $post->id)}}"><img src="{{asset($post->img)}}" alt="imagen" loading="lazy" class="img-fluid w-100"></a>
                </div>
            
                <div class="bg-dark-subtle m-auto rounded-bottom p-2 d-flex align-items-center">
                    <div class="text-center mx-2 d-flex flex-column">
                        @if (!Like::where("post_id", $post->id)->where("user_id", Auth::user()->id)->first())
                            <a href="darLike" id="{{$post->id}}" class="likes"><i class="icono bi bi-heart fs-2 text-dark"></i></a><span>{{count(Like::where("post_id", $post->id)->get())}}</span>
                        @else
                            <a href="quitarLike" id="{{$post->id}}" class="likes"><i class="icono bi bi-heart-fill fs-2 text-dark"></i></a><span>{{count(Like::where("post_id", $post->id)->get())}}</span>
                        @endif
                    </div>
                    <div class="text-center mx-2 d-flex flex-column">
                        <a href="{{route('post', $post->id)}}"><i class="icono bi bi-chat fs-2 text-dark"></i></a><span>{{count($post->comment)}}</span>
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