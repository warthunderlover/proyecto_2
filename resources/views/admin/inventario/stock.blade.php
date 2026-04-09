@extends('layout.app')

@section('title', 'Agregar Stock')

@section('contenido')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Agregar Stock a {{ $producto->nombre }}</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="/inventario/{{ $producto->id }}/stock" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Stock Actual</label>
                            <input type="text" 
                                   class="form-control bg-light" 
                                   value="{{ $producto->stock }}" 
                                   disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Cantidad a agregar</label>
                            <input type="number" 
                                   name="cantidad" 
                                   class="form-control" 
                                   min="1" 
                                   required>
                            @error('cantidad')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="/inventario" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Agregar Stock</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection