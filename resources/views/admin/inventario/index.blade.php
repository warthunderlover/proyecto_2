@extends('layout.app')

@section('title', 'Inventario')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Inventario</h2>
    <a href="/inventario/create" class="btn btn-success">Agregar Producto</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion ?? 'Sin descripción' }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>L {{ number_format($producto->precio, 2) }}</td>
                    <td>
                        <a href="/inventario/{{ $producto->id }}/edit" class="btn btn-warning btn-sm mb-1">Editar</a>
                        <a href="/inventario/{{ $producto->id }}/stock" class="btn btn-primary btn-sm mb-1">Agregar Stock</a>
                        <form action="/inventario/{{ $producto->id }}/desactivar" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de desactivar este producto?');">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-danger btn-sm mb-1">Desactivar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection