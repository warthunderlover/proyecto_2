@extends('layout.app')

@section('titulo', 'Productos')

@section('contenido')

<div class="bg-dark text-white py-4 mb-4">
    <div class="container">
        <small class="text-secondary">Compras</small>
        <h2 class="fw-bold mb-0">🛒 Carrito de Compras</h2>
    </div>
</div>

<div class="container pb-5">

    @if(session('mensaje'))
        <div class="alert alert-success border-0 border-start border-success border-4">
            {{ session('mensaje') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 border-start border-danger border-4">
            {{ session('error') }}
        </div>
    @endif

    @if(empty($carrito))
        <div class="card border-0 shadow-sm rounded-3 text-center py-5">
            <div class="card-body">
                <p class="fs-1">🛒</p>
                <h5 class="fw-semibold">Tu carrito está vacío</h5>
                <p class="text-muted">Agrega productos desde el listado.</p>
                <a href="{{ route('productos.index') }}" class="btn btn-primary">Ver Productos</a>
            </div>
        </div>

    @else
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
            <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Producto</th>
                            <th class="text-center">Precio Unit.</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carrito as $id => $item)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $item['nombre_producto'] }}</td>
                            <td class="text-center">{{ number_format($item['precio_compra'], 2) }} LPS</td>

                            {{-- Cambiar cantidad --}}
                            <td class="text-center">
                                <form action="{{ route('carrito.actualizar', $id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number"
                                           name="cantidad"
                                           value="{{ $item['cantidad'] }}"
                                           min="1"
                                           class="form-control form-control-sm text-center"
                                           style="width: 70px"/>
                                    <button type="submit" class="btn btn-sm btn-outline-primary">✓</button>
                                </form>
                            </td>

                            <td class="text-center fw-semibold">{{ number_format($item['subtotal'], 2) }} LPS</td>

                            {{-- Eliminar producto --}}
                            <td class="text-center">
                                <form action="{{ route('carrito.eliminar', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">✕ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FOOTER CON TOTAL Y ACCIONES --}}
            <div class="card-footer bg-light px-4 py-3">
                <div class="d-flex justify-content-between align-items-center">

                    {{-- Vaciar carrito --}}
                    <form action="{{ route('carrito.vaciar') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">
                            🗑 Vaciar Carrito
                        </button>
                    </form>

                    <div class="d-flex align-items-center gap-4">
                        <span class="fs-5 fw-bold">
                            Total: {{ number_format($total, 2) }} LPS
                        </span>

                        {{-- Confirmar compra --}}
                        <form action="{{ route('carrito.confirmar') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success px-4">
                                ✔ Confirmar Compra
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary btn-sm">
                ← Seguir comprando
            </a>
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
