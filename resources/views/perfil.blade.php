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
                    <a href="{{$nombreUsuario->id}}" class="btn btn-outline-danger"><i class="bi bi-person-dash-fill"></i> Unfollow</a>
                @else
                    <a href="{{$nombreUsuario->id}}" class="btn btn-outline-success"><i class="bi bi-person-plus-fill"></i> Follow</a>
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
                @if(count($postsUsuario) > 0)
                    @foreach ($postsUsuario as $post)
                        <div class="col-12 col-md-4 mb-3">
                            <a href="{{route('post', $post->id)}}"><img src="{{asset($post->img)}}" alt="" class="img-fluid rounded w-100 h-100"></a>
                        </div>
                    @endforeach
                @else
                    <h2 class="p-3">No hay posts</h2>
                @endif
            </div>
        </div>
    </div>
@endsection