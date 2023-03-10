@vite(['resources/css/nav.css'])
{{-- BARRA DE NAVEGACiÓN --}}
<nav class="navbar sticky-top bg-light bg-opacity-75">
    <div class="container-fluid">
        @auth
        <a class="navbar-brand fs-2" data-bs-toggle="offcanvas" href="#offcanvasExample"><img src="{{asset(Auth::user()->profile->img)}}" alt="foto de perfil" class="rounded-circle" width="50" height="50"></a>
        @endauth

        @auth
            <a href="{{route('inicio')}}" class="text-decoration-none text-dark m-auto"><h2 class=""><img src="{{asset('img/logo.avif')}}" alt="logo camara" width="75" height="75"></h2></a>
        @else
            <a href="{{route('portada')}}" class="text-decoration-none text-dark m-auto"><h2 class=""><img src="{{asset('img/logo.avif')}}" alt="logo camara" width="75" height="75"></h2></a>
        @endauth
        @guest
            <a href="{{route("login")}}" class="btn btn-outline-dark">Login</a>
            <a href="{{route("register")}}" class="btn btn-outline-dark ms-1">Register</a>
        @endguest
        @auth    
        <form class="d-flex" role="search">
            <input class="form-control me-2 inputSearch" type="search" placeholder="Buscar..." aria-label="Search" data-bs-toggle="modal" data-bs-target="#modalBusqueda">
            <span class="btn boton bg-dark border border-dark text-white botonSearch" data-bs-toggle="modal" data-bs-target="#modalBusqueda"><i class="bi bi-search"></i></span>
        </form>
      @endauth
    </div>
</nav>

@auth
{{-- OFFCANVAS IZQUIERDA --}}
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h3 class="offcanvas-title d-flex justify-content-around w-75" id="offcanvasExampleLabel"><img src="{{asset(Auth::user()->profile->img)}}" alt="foto de perfil" class="rounded-circle" width="50" height="50"> <span class="nombreUser">{{ucfirst(Auth::user()->name)}}</span></h3>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex flex-column gap-3 align-items-center">
            <a href="{{route('inicio')}}" class="btn btn-outline-dark w-50 fs-5 {{request()->routeIs("inicio")?'active':''}}"><i class="bi bi-house-fill"></i> Inicio</a>
            <a href="{{route('perfil', Auth::user()->id)}}" class="btn btn-outline-dark w-50 fs-5 {{request()->routeIs("perfil")?'active':''}}"><i class="bi bi-person-square"></i> Perfil</a>
            <a class="btn btn-outline-dark w-50 fs-5" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-camera-fill"></i> Nuevo post</a>
        </div>
    </div>
    <div class="offcanvas-footer mb-5">
        <div class="d-flex flex-column gap-3 align-items-center">
            <form action="{{route('logout')}}" method="POST" class="w-50 fs-5">
                @csrf
                <a class="btn btn-outline-danger w-100 fs-5" onclick="this.closest('form').submit()"><i class="bi bi-box-arrow-right"></i> Logout</a>
            </form>
        </div>
    </div>
</div>

{{-- MODAL PUBLICAR POST --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Publicar post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('publicarPost')}}" class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 form-floating position-relative">
                        <input type="text" name="titulo" id="titulo" class="form-control" placeholder=" " required />
                        <label for="titulo" class="form-label">Titulo</label>
                        <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Debes añadir un titulo</div>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Seleccionar imagen...</label>
                        <input class="form-control" name="file" type="file" id="file" required>
                        <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Debes insertar una imagen</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Publicar post">
                </div>
            </form>
        </div>
    </div>
</div>



{{-- MODAL BUSQUEDA --}}
<div class="modal fade" id="modalBusqueda" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Busqueda de usuarios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="d-flex" role="search" id="formBusqueda">
                    <input class="form-control me-2 inputSearch" type="search" placeholder="Buscar..." aria-label="Search" id="campoBusqueda">
                    <span class="btn boton bg-dark border border-dark text-white botonSearch"><i class="bi bi-search"></i></span>
                </form>
                <div class="usuarios p-4 d-flex flex-column gap-4" id="usuarios">
                </div>
            </div>
        </div>
    </div>
</div>

@endauth

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