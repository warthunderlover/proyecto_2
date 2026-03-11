@extends('layout.app')

@section('titulo', 'Productos')

@section('contenido')

<!-- 
    No quitar esto ya que es el apartado que el cliente va a ver y de aquí mismo es que el va a elegir los productos para agregar al carrito
    
-->

<section class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Listado de Productos</h2>
    </div>
    <h2>@if(session('mensaje'))
    <div class="alert alert-success border-0 border-start border-success border-4 mt-3">
        {{ session('mensaje') }}
    </div>
@endif</h2>
    <div class="d-flex justify-content-end align-items-center gap-3">
        <a class="btn btn-secondary" href="{{ route('carrito.index') }}">
            🛒 Ver Carrito
            <span class="badge bg-light text-dark">
                {{ session('carrito') ? count(session('carrito')) : 0 }}
            </span>
        </a>
    </div>

    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

            @forelse($productos as $producto)
            <div class="col">
                <div class="card h-100 shadow-sm">

                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->nombre_producto }}</h5>
                        <p class="card-text" style="font-size: 0.9rem;">
                            <strong>Precio compra:</strong> {{ $producto->precio_compra }} LPS <br>
                            <strong>Stock:</strong> {{ $producto->cantidad_stock }} unidades <br>
                            <strong>Estado:</strong> 
                            @if($producto->estado_producto)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </p>
                        <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm w-100">
                                🛒 Agregar al Carrito
                            </button>
                        </form>
                
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12">
                    <p class="text-muted text-center">No hay productos disponibles.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
@endsection