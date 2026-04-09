<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #333; }
        h2 { color: #555; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th { background-color: #4CAF50; color: white; padding: 8px; text-align: left; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .fecha { text-align: right; color: #888; font-size: 10px; }
    </style>
</head>
<body>
    <h1>Reporte de Productos</h1>
    <p class="fecha">Generado el: {{ now()->format('d/m/Y H:i') }}</p>

    <h2>Productos más vendidos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Total vendido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($masVendidos as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->producto->nombre_producto ?? 'N/A' }}</td>
                <td>{{ $item->total_vendido }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Productos menos vendidos</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Total vendido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menosVendidos as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->producto->nombre_producto ?? 'N/A' }}</td>
                <td>{{ $item->total_vendido }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>