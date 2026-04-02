<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::where('estado', 'activo')->get();
        return view('admin.inventario.index', compact('productos'));
    }

    public function inactivos()
    {
        $productos = Producto::where('estado', 'inactivo')->get();
        return view('admin.inventario.inactivos', compact('productos'));
    }

    public function create()
    {
        return view('admin.inventario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nombre' => 'required',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'precio' => 'required|numeric',
    ]);

    $imagenPath = null;

    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('imagenes', 'public');
    }

    Producto::create([
        'nombre'  => $request->nombre,
        'precio'  => $request->precio,
        'imagen'  => $imagenPath,
        'stock'   => 0,
        'estado'  => 'activo',
    ]);

    return redirect('/inventario')->with('success', 'Producto creado correctamente');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.inventario.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect('/inventario')->with('success','Producto actualizado correctamente');
    }

    public function desactivar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estado = 'inactivo';
        $producto->save();
        return redirect('/inventario')->with('success', 'Producto desactivado correctamente');
    }

    public function activar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->estado = 'activo';
        $producto->save();
        return redirect('/inventario/inactivos')->with('success', 'Producto activado correctamente');
    }

    public function stock($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.inventario.stock', compact('producto'));
    }

    public function agregarStock(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($id);
        $producto->stock += $request->cantidad;
        $producto->save();

        return redirect('/inventario')->with('success','Stock actualizado correctamente');
    }
}