@extends('layout.app')

@section('titulo', 'Inventario')

@section('contenido')

<div class="text-center mt-5">

    <h1 class="mb-4">Bienvenido al Panel de Clientes</h1>

    <p class="lead">
        Desde aquí puedes:
    </p>

    <ul class="list-group list-group-flush mb-4" style="max-width: 500px; margin: auto;">
        <li class="list-group-item">Hacer compra de los productos de tu preferencia</li>
        <li class="list-group-item">Visualizar tu carrito de compras para ver los productos seleccionados y proceder con el pago</li>
    </ul>
</div>

@endsection