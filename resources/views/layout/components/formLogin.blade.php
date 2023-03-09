<div class="container-md">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 p-5 bg-dark p-4 rounded bg-opacity-75">
        <!-- Formulario -->
            <form action="{{route("login.log")}}" class="needs-validation" novalidate method="POST">
                @csrf
                <legend class="text-center fs-1 text-white"><i class="bi bi-people"></i> Login</legend>
            
                {{-- Campo email --}}
                <div class="mb-3 form-floating position-relative">
                    <input type="email" name="email" id="input-email" class="form-control" placeholder=" " required />
                    <label for="input-email" class="form-label">Correo electrónico</label>
                    <div class="valid-feedback fs-5"><i class="bi bi-check-lg"></i> Válido</div>
                    <div class="invalid-feedback fs-5"><i class="bi bi-exclamation-octagon-fill"></i> Email no válido</div>
                </div>

                {{-- Campo contraseña --}}
                <div class="mb-3 form-floating position-relative">
                    <input type="password" name="password" id="input-password" class="form-control" placeholder=" " required minlength="8"/>
                    <label for="input-password" class="form-label">Contraseña</label>
                    <div class="valid-feedback fs-5"><i class="bi bi-check-lg"></i> Válido </div>
                    <div class="invalid-feedback fs-5"><i class="bi bi-exclamation-octagon-fill"></i> Contraseña no válida (Requerida y mínimo 8 caracteres)</div>
                </div>

                {{-- Campo recuerdame --}}
                <div class="form-check mb-3 form-switch fs-5">
                    <label for="check-remember" class="form-check-label text-white">Recuérdame</label>
                    <input type="checkbox" name="remember" id="check-remember" class="form-check-input"/>
                </div>

                @if (session('invalido'))
                <div class="alert alert-danger">
                    {{ session('invalido') }}
                </div>
                @endif
            
                {{-- Submit --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-danger">Entrar <i class="bi bi-arrow-up-right-square"></i></button>
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