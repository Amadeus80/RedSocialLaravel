@extends('layout.plantilla')

@section("title", "Perfil")

@section('content')
@vite(['resources/css/perfil.css'])
    @if (session('imagenCambiada'))
    <div class="alert container alert-success mt-3">
        {{ session('imagenCambiada') }}
    </div>
    @endif

    <div class="container bg-dark-subtle p-4 rounded contenedorPerfil d-flex flex-column gap-4">
        <div class="w-75 m-auto d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-4">
                <img src="{{asset($perfil->img)}}" alt="imagen perfil" width="100px" height="100px" class="rounded-circle">
                <h2>{{$nombreUsuario->name}}</h2>
            </div>
            @if (Auth::user()->id == $nombreUsuario->id)
                <a href="#" class="btn btn-outline-dark" data-bs-target="#modalCambio" data-bs-toggle="modal"><i class="bi bi-image"></i></a>
            @else
                <div id="botonFollow">
                @if ($follow)
                    <a href="{{$nombreUsuario->id}}" class="btn btn-outline-danger" id="unfollow"><i class="bi bi-person-dash-fill"></i> Unfollow</a>
                @else
                    <a href="{{$nombreUsuario->id}}" class="btn btn-outline-success" id="follow"><i class="bi bi-person-plus-fill"></i> Follow</a>
                @endif
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-around w-75 m-auto">
            <a href="{{$nombreUsuario->id}}" class="btn btn-outline-dark active fs-3" id="recuperarPost" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Post"><i class="bi bi-camera"> </i></a>
            <a href="{{$nombreUsuario->id}}" class="btn btn-outline-dark fs-3" id="recuperarLikes" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Me gustas"><i class="bi bi-suit-heart"></i> </a>
            <a href="{{$nombreUsuario->id}}" class="btn btn-outline-dark fs-3" id="recuperarSiguiendo" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Siguiendo"><i class="bi bi-person-vcard"></i> </a>
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



    {{-- MODAL CAMBIAR IMAGEN --}}
    <div class="modal fade" id="modalCambio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar imagen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('cambiarImagen')}}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="file" class="form-label">Seleccionar imagen...</label>
                            <input class="form-control" name="file" type="file" id="file" required>
                            <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Debes insertar una imagen</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Cambiar imagen">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
    </script>

@endsection