@extends('layout.plantilla')

@section("title", "Post")

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

<div class="container p-4 rounded d-flex flex-column justify-content-center">{{-- Div fondo --}}
    <div class="post container-fluid w-100 mx-auto mb-5">
        <div class="bg-dark-subtle rounded-top">
            <div class="d-flex align-items-center gap-3 ms-4">
                <img src="{{asset($post->user->profile->img)}}" alt="Imagen Usuario" width="50px" height="50px" class="rounded-circle">
                <div class="mt-3 d-flex flex-column align-items-center justify-content-center">
                    <h5>{{$post->user->name}}</h5>
                    <p>{{$post->created_at}}</p>
                </div>
            </div>
        </div>
    
        <div class="m-auto">
            <a href="#"><img src="{{asset($post->img)}}" alt="Imagen Post" class="img-fluid w-100"></a>
        </div>
    
        <div class="bg-dark-subtle m-auto p-2 d-flex align-items-center">
            <h4 class="tituloPost m-auto p-1">{{$post->titulo}}</h4>
        </div>

        <div class="bg-dark-subtle rounded-bottom p-3">
            <div class="interacciones d-flex justify-content-center">
                <div class="text-center mx-2">
                    <a href="#"><i class="icono bi bi-heart fs-2 text-dark"></i></a><span class="ms-2">{{$like}}</span>
                </div>
                <div class="text-center mx-2">
                    <a href="#"><i class="icono bi bi-chat fs-2 text-dark"></i></a><span class="ms-2">{{count($post->comment)}}</span>
                </div> 
            </div>

            <h3 class="text-center w-100">Comentarios</h3>

            <div class="comment border-top border-dark p-3">
                <h4>Realizar comentario: </h4>
                <div class="comment__info d-flex gap-2">
                    <img src="{{asset(Auth::user()->profile->img)}}" alt="Imagen Usuario Auth" width="50px" height="50px" class="rounded-circle">
                    <div class="comment__text d-flex justify-content align-items-center">
                        <small>{{Auth::user()->name}}</small>
                    </div>
                    <div class="w-100">
                        <form action="#" class="d-flex justify-content align-items-center gap-3">
                            <textarea type="text" name="comentario" id="comentario" style="resize: none" maxlength="500" class="d-block w-100 rounded"></textarea>
                            <input type="submit" value="Comentar" class="btn btn-outline-success">
                        </form>
                    </div>
                </div>
            </div>

            @if (count($post->comment)>0)
                @foreach ($post->comment as $comment)
                    <div class="comment border-top border-dark p-3">
                        <div class="comment__info d-flex gap-2">
                            <img src="{{asset($comment->user->profile->img)}}" alt="Imagen Comentario" width="50px" height="50px" class="rounded-circle">
                            <div class="comment__text">
                                <small>{{$comment->user->name}}</small>
                                <small class="d-block">{{$comment->created_at}}</small>
                            </div>
                        </div>
                        <p>{{$comment->content}}</p>
                    </div>
                @endforeach 
            @else
                <h4 class="text-center py-4 border-top border-dark">No hay comentarios</h4>
            @endif
        </div>
    </div>
</div>
@endsection