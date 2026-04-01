@extends('layout.app')

@section('titulo', $producto_detalle->nombre_producto)

@section('contenido')
<div class="container py-4">

    <a href="/productos" class="btn btn-outline-secondary mb-4">
        <i class="fa-solid fa-arrow-left"></i> Volver
    </a>

    <div class="row g-4">

        {{-- Columna izquierda: Producto --}}
        <div class="col-md-7">
            <div class="card shadow-sm p-4">
                <div class="text-center mb-4">
                    <img 
                        src="{{ $producto_detalle->imagen ? asset('storage/' . $producto_detalle->imagen) : asset('images/no-image.png') }}"
                        alt="imagen producto"
                        class="img-fluid rounded mb-3"
                        style="max-height: 250px; object-fit: contain;"
                    />
                    <h3 class="fw-bold">{{ $producto_detalle->nombre_producto }}</h3>
                    <p class="text-muted fs-5">
                        <strong>Precio:</strong> {{ $producto_detalle->precio_compra }} LPS
                    </p>
                    <p class="text-muted">
                        <strong>Stock:</strong> {{ $producto_detalle->cantidad_stock }} unidades
                    </p>
                    <p>
                        <strong>Estado:</strong>
                        @if($producto_detalle->estado_producto)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </p>

                    {{-- Promedio calificación --}}
                    <p class="mt-2">
                        <strong>Calificación promedio:</strong>
                        {{ number_format($producto_detalle->promedioCalificacion(), 1) ?? 'Sin reseñas' }} / 5
                    </p>
                </div>

                <hr>
            </div>
        </div>

        {{-- Columna derecha: Reviews --}}
        <div class="col-md-5">
            <div class="card shadow-sm p-4">
                <h5 class="fw-bold mb-3">Reseñas</h5>

                {{-- Formulario para agregar review --}}
                @auth
                <form action="/productos/{{ $producto_detalle->id_producto }}/reviews" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label">Calificación (1-5)</label>
                        <input type="number" name="calificacion" min="1" max="5" class="form-control" required>
                        @error('calificacion')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Comentario</label>
                        <textarea name="comentario" class="form-control" rows="3"></textarea>
                        @error('comentario')
                            <p class="text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fa-solid fa-star"></i> Publicar reseña
                    </button>
                </form>
                @else
                    <p class="text-muted small mb-4">
                        <a href="/login">Inicia sesión</a> para dejar una reseña.
                    </p>
                @endauth

                <hr>

                {{-- Listado de reviews --}}
                @forelse($producto_detalle->reviews as $review)
                <div class="mb-3 border-bottom pb-3">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-warning text-dark">
                            {{ $review->calificacion }} / 5
                        </span>
                    </div>
                    <p class="text-muted small mb-0">{{ $review->comentario }}</p>
                    <p class="text-muted" style="font-size: 0.75rem;">
                        {{ $review->created_at->diffForHumans() }}
                    </p>
                </div>
                @empty
                    <p class="text-muted text-center">Este producto aún no tiene reseñas.</p>
                @endforelse

            </div>
        </div>

    </div>
</div>
@endsection