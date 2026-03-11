<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - Panel Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="d-flex">

    <!-- Menú lateral -->
    <div class="bg-dark text-white vh-100 p-3" style="width:220px;">
        <h4 class="mb-4">MENÚ</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="/admin" class="nav-link text-white {{ request()->is('admin') ? 'active bg-secondary' : '' }}">Inicio</a>
            </li>
            <li class="nav-item mb-2">
                <a href="/inventario" class="nav-link text-white {{ request()->is('inventario') ? 'active bg-secondary' : '' }}">Inventario</a>
            </li>
            <li class="nav-item mb-2">
                <a href="/inventario/inactivos" class="nav-link text-white {{ request()->is('inventario/inactivos') ? 'active bg-secondary' : '' }}">Productos Inactivos</a>
            </li>

            <li class="nav-item mb-2">
                
                <a href="{{ route('users.index') }}" 
                    class="nav-link text-white {{ request()->is('users*') ? 'active bg-secondary' : '' }}">
                    Administrar Usuarios
                </a>
            </li>

            <li class="nav-item mb-2">
                
                <a href="/productos" class="nav-link text-white {{ request()->is('productos') ? 'active bg-secondary' : '' }}">
                    Ver Productos
                </a>
            </li>


            <li class="nav-item mb-2">
                
                <a href="/carrito" class="nav-link text-white {{ request()->is('carrito') ? 'active bg-secondary' : '' }}">
                    Ver Carrito
                </a>
            </li>
            <li class="nav-item mt-3">
                <!-- Logout funcional -->
                <a href="{{ route('logout') }}" class="nav-link text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            
        </ul>
    </div>

    <!-- Contenido principal -->
    <div class="flex-grow-1 p-4">
        @yield('contenido')
    </div>

</div>

</body>
</html>