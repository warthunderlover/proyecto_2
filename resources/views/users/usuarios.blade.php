
@extends('layout.usuarios')

@section('usuarios_content')

    <div class="container">


        <h1 class="mb-4">Lista de Usuarios</h1>
        <a href="{{ route('admin.inicio') }}" class="btn btn-secondary mb-3">
            ← Regresar al panel de administración
        </a>

        <a href="{{ route('users.create') }}" class="btn btn-success mb-3">
        Agregar Usuario</a>

        {{-- PANEL SUPERIOR PARA CREAR / VER / EDITAR USUARIOS --}}

        @if(isset($accion))

        <div class="card mb-4">

            <div class="card-header bg-primary text-white">

                @if($accion == 'crear')
                Agregar Usuario
                @elseif($accion == 'ver')
                Ver Usuario
                @elseif($accion == 'editar')
                Editar Usuario
                @endif

            </div>

        <div class="card-body">


        {{-- FORMULARIO CREAR USUARIO --}}

        @if($accion == 'crear')

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="row">

                <div class="col-md-3">
                    <label>Nombres</label>
                    <input type="text" name="nombres" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>Contraseña</label>
                    <input type="password" name="password" class="form-control">
                </div>

            </div>

            <button class="btn btn-success mt-3">
            Guardar Usuario
            </button>

        </form>

        @endif


        {{-- MOSTRAR USUARIO --}}

        @if($accion == 'ver')

        <p><strong>ID:</strong> {{ $usuario->id }}</p>
        <p><strong>Nombre:</strong> {{ $usuario->nombres }}</p>
         <p><strong>Apellido:</strong> {{ $usuario->apellidos }}</p>
        <p><strong>Email:</strong> {{ $usuario->email }}</p>
        <p><strong>Estado:</strong> 
            @if($usuario->status == 1)
            Activo
            @else
            Inactivo
            @endif
        </p>

        @endif


        {{-- EDITAR USUARIO --}}

        @if($accion == 'editar')

        <form method="POST" action="{{ route('users.update',$usuario->id) }}">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-4">
                    <label>Nombre</label>
                    <input type="text" name="nombres" class="form-control" value="{{ $usuario->nombres }}">
                </div>
                <div class="col-md-4">
                    <label>Apellido</label>
                    <input type="text" name="apellidos" class="form-control" value="{{ $usuario->apellidos }}">
                </div>

                <div class="col-md-4">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $usuario->email }}">
                </div>

            </div>

            <button class="btn btn-primary mt-3">
             Actualizar Usuario
            </button>

        </form>

        @endif


        </div>
        </div>

        @endif



        {{-- TABLA DE USUARIOS --}}

        <table class="table table-bordered table-striped">

        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($users as $user)

            <tr>

                <td>{{ $user->id }}</td>

                <td>{{ $user->nombres }}</td>

                <td>{{ $user->email }}</td>

                <td>

                    @if($user->status == 1)
                    <span class="badge bg-success">Activo</span>
                    @else
                    <span class="badge bg-secondary">Inactivo</span>
                    @endif

                </td>

                <td>

                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">
                     Ver
                    </a>

                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    @if($user->status == 1)

                    <form action="{{ route('users.inactivate', $user->id) }}" method="POST" style="display:inline-block;">
                     @csrf
                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('¿Inactivar este usuario?')">
                            Inactivar
                        </button>
                    </form>

                    @endif


                </td>

            </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center">
                        No hay usuarios registrados
                    </td>
                </tr>

            @endforelse

        </tbody>

        </table>

    </div>

@endsection