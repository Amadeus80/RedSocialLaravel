<div class="container-md">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
        <!-- Formulario -->
            <form action="{{route("register.log")}}" class="needs-validation" novalidate method="POST">
                @csrf
                <legend class="text-center fs-1"><i class="bi bi-people"></i> Register</legend>
            
                {{-- Campo nombre --}}
                <div class="mb-3 form-floating position-relative">
                    <input type="text" name="name" id="input-email" class="form-control" placeholder=" " required />
                    <label for="input-email" class="form-label">Nombre</label>
                    <div class="valid-feedback"><i class="bi bi-check-lg"></i> Válido</div>
                    <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Nombre requerido</div>
                </div>

                {{-- Campo email --}}
                <div class="mb-3 form-floating position-relative">
                    <input type="email" name="email" id="input-email" class="form-control" placeholder=" " required />
                    <label for="input-email" class="form-label">Correo electrónico</label>
                    <div class="valid-feedback"><i class="bi bi-check-lg"></i> Válido</div>
                    <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Email no válido</div>
                </div>

                @if (session('email'))
                <div class="alert alert-danger">
                    {{ session('email') }}
                </div>
                @endif

                {{-- Campo contraseña --}}
                <div class="mb-3 form-floating position-relative">
                    <input type="password" name="password" id="input-password" class="form-control" placeholder=" " required minlength="8"/>
                    <label for="input-password" class="form-label">Contraseña</label>
                    <div class="valid-feedback"><i class="bi bi-check-lg"></i> Válido </div>
                    <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Contraseña no válida (Requerida y mínimo 8 caracteres)</div>
                </div>

                {{-- Campo repite contraseña --}}
                <div class="mb-3 form-floating position-relative">
                    <input type="password" name="password2" id="input-password2" class="form-control" placeholder=" " required minlength="8"/>
                    <label for="input-password2" class="form-label">Repite contraseña</label>
                    <div class="valid-feedback"><i class="bi bi-check-lg"></i> Válido </div>
                    <div class="invalid-feedback"><i class="bi bi-exclamation-octagon-fill"></i> Contraseña no válida (Requerida y mínimo 8 caracteres)</div>
                </div>

                @if (session('password'))
                <div class="alert alert-danger">
                    {{ session('password') }}
                </div>
                @endif
            
                {{-- Submit --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-danger">Entrar <i class="bi bi-arrow-up-right-square"></i></button>
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