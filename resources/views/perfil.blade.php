@extends('layout.plantilla')

@section("title", "Perfil")

@section('content')
@vite(['resources/css/perfil.css'])
    <div class="container bg-dark-subtle p-4 rounded contenedorPerfil d-flex flex-column gap-4">
        <div class="w-75 m-auto d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-4">
                <img src="{{asset($perfil->img)}}" alt="imagen perfil" width="100px" height="100px" class="rounded-circle">
                <h2>{{$nombreUsuario->name}}</h2>
            </div>
            @if (Auth::user()->id == $nombreUsuario->id)
                <a href="#" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-title="Cambiar imagen de perfil"><i class="bi bi-image"></i></a>
            @else
                @if ($follow)
                    <a href="#" class="btn btn-outline-danger">Unfollow</a>
                @else
                    <a href="#" class="btn btn-outline-success">Follow</a>
                @endif
            @endif
        </div>
        <div class="d-flex justify-content-around w-75 m-auto">
            <a href="{{$nombreUsuario->id}}" class="btn btn-outline-dark active" id="recuperarPost">Post</a>
            <a href="{{$nombreUsuario->id}}" class="btn btn-outline-dark" id="recuperarLikes">Tus me gusta</a>
            <a href="{{$nombreUsuario->id}}" class="btn btn-outline-dark" id="recuperarSiguiendo">Siguiendo</a>
        </div>
        <div class="container text-center border-top border-dark pt-3">
            <div class="row" id="contenedorInfoPerfiles">
                {{-- POST --}}
                @foreach ($postsUsuario as $post)
                    <div class="col-12 col-md-4 mb-3">
                        <a href="{{route('post', $post->id)}}"><img src="{{asset($post->img)}}" alt="" class="img-fluid rounded h-100 w-100"></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection