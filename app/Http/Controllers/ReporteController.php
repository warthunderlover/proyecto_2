<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleCompra;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    
    public function reporteProductos()
    {
        // Productos más vendidos
        $masVendidos = DetalleCompra::select('id_producto')
            ->selectRaw('SUM(cantidad) as total_vendido')
            ->with('producto')
            ->groupBy('id_producto')
            ->orderByDesc('total_vendido')
            ->limit(10)
            ->get();

        // Productos menos vendidos
        $menosVendidos = DetalleCompra::select('id_producto')
            ->selectRaw('SUM(cantidad) as total_vendido')
            ->with('producto')
            ->groupBy('id_producto')
            ->orderBy('total_vendido','asc')
            ->limit(10)
            ->get();

        $pdf = Pdf::loadView('Reportes.reporte', compact('masVendidos', 'menosVendidos'));

        return $pdf->download('reporte_productos.pdf');
        // O para verlo en el navegador:
         return $pdf->stream('reporte_productos.pdf');
    }
}
