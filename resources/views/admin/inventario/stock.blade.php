<!DOCTYPE html>
<html>
<head>
    <title>Agregar Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-primary text-white">
<h4>Agregar Stock a {{ $producto->nombre }}</h4>
</div>

<div class="card-body">

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<form action="/inventario/{{ $producto->id }}/stock" method="POST">
@csrf

<div class="mb-3">
<label class="form-label">Stock actual:</label>
<input type="text" class="form-control" value="{{ $producto->stock }}" disabled>
</div>

<div class="mb-3">
<label class="form-label">Cantidad a agregar:</label>
<input type="number" name="cantidad" class="form-control" min="1" required>
</div>

<button class="btn btn-primary">Agregar Stock</button>
<a href="/inventario" class="btn btn-secondary">Volver al Inventario</a>

</form>

</div>

</div>

</div>

</body>
</html>