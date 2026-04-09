<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .text-success { color: green; }
        .text-danger { color: red; }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Crear Cuenta</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/registro" method="POST" id="formRegistro">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Primer nombre</label>
                                <input type="text" class="form-control" name="nombres" 
                                       value="{{ old('nombres') }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]+">
                                <small id="helpNombres">Solo letras, sin espacios ni guiones.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" name="apellidos" 
                                       value="{{ old('apellidos') }}" required pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]+">
                                <small id="helpApellidos">Solo letras, sin espacios ni guiones.</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" 
                                   value="{{ old('email') }}" required>
                            <small>Debe ser un email válido.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="password" required
                                pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*#?&\-_]).{8,}">
                            <small>Mínimo 8 caracteres, incluye mayúscula, minúscula, número y algún carácter especial (@ $ ! % * # ? & - _ ).</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                            <small>Debe coincidir con la contraseña anterior.</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>

                    <p class="text-center mt-3">
                        ¿Ya tienes cuenta? <a href="/login">Inicia sesión</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('#formRegistro input').forEach(input => {
    input.addEventListener('input', () => {
        const small = input.nextElementSibling;
        if(input.validity.valid){
            small.classList.remove('text-danger');
            small.classList.add('text-success');
        } else {
            small.classList.remove('text-success');
            small.classList.add('text-danger');
        }
    });
});
</script>

</body>
</html>