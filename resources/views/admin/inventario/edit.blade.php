@extends('layout.app')

@section('title', 'Editar Producto')

@section('contenido')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow">
                <div class="card-header bg-warning text-center">
                    <h4 class="mb-0">Editar Producto</h4>
                </div>

                <div class="card-body">

                    <form action="/inventario/{{ $producto->id }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" 
                                   name="nombre" 
                                   class="form-control"
                                   value="{{ old('nombre', $producto->nombre) }}"
                                   required>
                            @error('nombre')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" 
                                      class="form-control" 
                                      rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Precio (L)</label>
                            <input type="number" 
                                   step="0.01"
                                   name="precio" 
                                   class="form-control"
                                   value="{{ old('precio', $producto->precio) }}"
                                   required>
                            @error('precio')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="/inventario" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-warning">Actualizar Producto</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection