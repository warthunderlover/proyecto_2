@extends('layout.app')

@section('titulo', 'Agregar Producto')

@section('contenido')

<x-card class="max-w-lg mx-auto mt-24">

    <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Agregar Producto
            </h2>
            <p class="mb-4">Agregar un producto nuevo al inventario</p>
        </header>

        <div class="card-body">

    <form action="/inventario" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        
        <input  type="text" 
                name="nombre" 
                class="form-control"
                value="{{old('nombre')}}">
        @error('nombre')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    
    <div class="mb-3">
        <label class="form-label">Imagen</label>
        <input  type="file" 
                name="imagen" 
                class="form-control"
                value="{{old('imagen')}}">
        @error('imagen')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Descripción (opcional)</label>
        <input  type="text" 
                name="descripcion" 
                class="form-control"
                value="{{old('descripcion')}}">

        @error('descripcion')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Precio</label>
        <input  type="number" 
                step="0.01" 
                name="precio" 
                class="form-control"
                value="{{old('precio')}}">
        @error('precio')
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>

    <button class="btn btn-success">
        Guardar Producto
    </button>

    <a href="/inventario" class="btn btn-secondary">
        Volver
    </a>

</form>

</div>

</div>

</div>
</x-card>
@endsection()