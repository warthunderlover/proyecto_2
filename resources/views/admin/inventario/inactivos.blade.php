@extends('layouts.admin')

@section('title', 'Inventario')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Reactivacion de productos</h2>
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
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>L {{ $producto->precio }}</td>
                    <td>
                        <form action="/inventario/{{ $producto->id }}/activar" method="POST" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas activar este producto?');">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-success btn-sm mb-1">Activar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection