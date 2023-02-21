<style>
    .boton{
        margin-left:-10px; 
    }
</style>

<nav class="navbar sticky-top bg-body-tertiary">
    <div class="container-fluid">
        @auth
        <a class="navbar-brand fs-2" data-bs-toggle="offcanvas" href="#offcanvasExample"><img src="https://icones.pro/wp-content/uploads/2021/03/avatar-de-personne-icone-homme.png" alt="foto de perfil" class="rounded-circle" width="50" height="50"></a>
        @endauth

    @auth
        <a href="{{route('inicio')}}" class="text-decoration-none text-dark m-auto"><h2>Logo</h2></a>
    @else
        <a href="{{route('login')}}" class="text-decoration-none text-dark m-auto"><h2>Logo</h2></a>
    @endauth
      
      
      @guest
          <a href="{{route("login")}}" class="btn btn-outline-dark">Login</a>
          <a href="{{route("register")}}" class="btn btn-outline-dark ms-1">Register</a>
      @endguest
      @auth    
      <form class="d-flex" role="search">
        <input class="form-control me-2 rounded-end-0" type="search" placeholder="Buscar..." aria-label="Search">
        <button class="btn boton rounded-start-0 bg-dark border border-dark text-white" type="submit"><i class="bi bi-search"></i></button>
      </form>
      @endauth
    </div>
</nav>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h1 class="offcanvas-title d-flex justify-content-evenly w-50" id="offcanvasExampleLabel"><img src="https://icones.pro/wp-content/uploads/2021/03/avatar-de-personne-icone-homme.png" alt="foto de perfil" class="rounded-circle" width="50" height="50"> Pablo</h1>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="d-flex flex-column gap-3 align-items-center">
            <a href="#" class="btn btn-outline-dark w-50 fs-5"><i class="bi bi-house-fill"></i> Inicio</a>
            <a href="#" class="btn btn-outline-dark w-50 fs-5"><i class="bi bi-person-square"></i> Perfil</a>
            <a href="#" class="btn btn-outline-dark w-50 fs-5"><i class="bi bi-camera-fill"></i> Post</a>
        </div>
    </div>
    <div class="offcanvas-footer mb-5">
        <div class="d-flex flex-column gap-3 align-items-center">
            <a href="#" class="btn btn-outline-danger w-50 fs-5"><i class="bi bi-box-arrow-right"></i> Logout</a>
        </div>
    </div>
</div>