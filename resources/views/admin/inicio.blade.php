@extends('layout.app')

@section('title', 'Inventario')

@section('contenido')

<div class="text-center mt-5">

    <h1 class="mb-4">Bienvenido al Panel de Administración</h1>

    <p class="lead">
        Desde aquí puedes administrar todas las secciones de tu sistema:
    </p>

    <ul class="list-group list-group-flush mb-4" style="max-width: 500px; margin: auto;">
        <li class="list-group-item">Gestionar Inventario: agregar, editar y desactivar productos, así como sumar stock.</li>
        <li class="list-group-item">Administrar Usuarios: crear, editar o desactivar cuentas de usuario.</li>

    </ul>
    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg">Administrar Usuarios</a>
    </div>

</div>

@endsection