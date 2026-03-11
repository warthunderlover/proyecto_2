<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagina protegida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Sistema</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mi Perfil</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Administrar Usuarios</a>
                        </li>
                    </ul>
                    
                    
                    <div class="d-flex align-items-center">
                        <span class="text-white me-3">
                            Hola, <strong>{{ Auth::user()->nombres }}</strong>
                        </span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm" type="submit">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <div class="alert alert-success" role="alert">
            <h5 class="alert-heading">Hola</h5>
            <p>Bienvenido a la pagina. Esta página solo es visible para usuarios autenticados.</p>
            <hr>
            <p class="mb-0">
                <strong>Email:</strong> {{ Auth::user()->email }} 
            </p>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <div class="container mt-4">
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://picsum.photos/id/237/1200/400" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/238/1200/400" class="d-block w-100" alt="Imagen 2">
                </div>
                <div class="carousel-item">
                    <img src="https://picsum.photos/id/239/1200/400" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <h3 class="mb-4">Contenido Exclusivo</h3>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="https://picsum.photos/id/139/400/300" class="card-img-top" alt="Card 1">
                    <div class="card-body">
                        <h5 class="card-title">Recurso 1</h5>
                        <p class="card-text">Contenido exclusivo disponible solo para usuarios registrados.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="https://picsum.photos/id/140/400/300" class="card-img-top" alt="Card 2">
                    <div class="card-body">
                        <h5 class="card-title">Recurso 2</h5>
                        <p class="card-text">Acceso a material privado y documentación restringida.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="https://picsum.photos/id/141/400/300" class="card-img-top" alt="Card 3">
                    <div class="card-body">
                        <h5 class="card-title">Recurso 3</h5>
                        <p class="card-text">Herramientas y recursos protegidos para miembros.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="https://picsum.photos/id/142/400/300" class="card-img-top" alt="Card 4">
                    <div class="card-body">
                        <h5 class="card-title">Recurso 4</h5>
                        <p class="card-text">Panel de administración y configuración de cuenta.</p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">© Seminario SW</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>