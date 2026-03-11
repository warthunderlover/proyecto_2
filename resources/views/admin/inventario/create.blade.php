<!DOCTYPE html>
<html>
<head>

<title>Agregar Producto</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h4>Agregar Producto</h4>
</div>

<div class="card-body">

<form action="/inventario" method="POST">

@csrf

<div class="mb-3">
<label class="form-label">Nombre</label>
<input type="text" name="nombre" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Descripción</label>
<input type="text" name="descripcion" class="form-control">
</div>


<div class="mb-3">
<label class="form-label">Precio</label>
<input type="number" step="0.01" name="precio" class="form-control" required>
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

</body>
</html>