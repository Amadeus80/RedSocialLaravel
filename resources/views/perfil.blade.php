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
        <div class="d-flex justify-content-around">
            <a class="w-25 btn btn-outline-dark">Post</a>
            <a class="w-25 btn btn-outline-dark">Tus me gusta</a>
            <a class="w-25 btn btn-outline-dark">Siguiendo</a>
        </div>
        <div class="container text-center border-top border-dark pt-3">
            <div class="row">
                {{-- POST --}}
                {{-- <div class="col-12 col-md-4 mb-3">
                    <img src="{{asset("img/default_profile/default_avatar.png")}}" alt="" class="img-fluid rounded">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <img src="{{asset("img/default_profile/default_avatar.png")}}" alt="" class="img-fluid rounded">
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <img src="{{asset("img/default_profile/default_avatar.png")}}" alt="" class="img-fluid rounded">
                </div> --}}
            
                {{-- SIGUIENDO --}}
                {{-- <div class="col-12 col-md-4 mb-3">
                    <a href="#"><img src="{{asset("img/default_profile/default_avatar.png")}}" class="rounded-circle img-fluid" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">Pablo</h3></a>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <a href="#"><img src="{{asset("img/default_profile/default_avatar.png")}}" class="rounded-circle img-fluid" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">Pablo</h3></a>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <a href="#"><img src="{{asset("img/default_profile/default_avatar.png")}}" class="rounded-circle img-fluid" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">Pablo</h3></a>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <a href="#"><img src="{{asset("img/default_profile/default_avatar.png")}}" class="rounded-circle img-fluid" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">Pablo</h3></a>
                </div>
                <div class="col-12 col-md-4 mb-3">
                    <a href="#"><img src="{{asset("img/default_profile/default_avatar.png")}}" class="rounded-circle img-fluid" height="100" width="100"></a> <a href="#" class="text-decoration-none text-dark"><h3 class="mt-2">Pablo</h3></a>
                </div> --}}
            </div>
        </div>
    </div>
@endsection