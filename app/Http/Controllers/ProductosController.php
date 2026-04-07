<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Marcas; //llamando el archivo
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    // este es el apartado donde se hace la logica, es como cuando haciamos el controller en negocios en singular y el otro es el plural
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //listado de productos.
        $productos = Productos::Latest()->where('estado_producto',1)->where('cantidad_stock','>',0)->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //equivalente al mode= 'INS' es GET, muestra el formulario para crear un nuevo producto

        //agarrando las marcas para el select del formulario
       // $marcas = \App\Models\Marcas::select('id_marca','nombre_marca')->where('estado_marca',1)->get();
        return view('productos.create'/*, compact('marcas')*/);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Equivalente al postdata o sea el POST del INS, recibe los datos del formulario y los guarda en la base de datos
        $request->validate
        ([
            'nombre_producto'=>'required|string|max:100',
            //'id_marca'=>'required|integer',
            'precio_compra'=>'required|numeric|min:0.01',
            'cantidad_stock'=>'required|integer|min:1',
            //'estado_producto'=>'required|boolean'
        ],[
            'nombre_producto.required' => 'El campo nombre del producto es obligatorio.',
           // 'id_marca.required' => 'El campo marca es obligatorio.',
            'precio_compra.required' => 'El campo precio de compra es obligatorio.',
            'cantidad_stock.required' => 'El campo cantidad en stock es obligatorio.',
            
        ]);
        //equivalencia con productosDao::CrearProducto($producto);
        Productos::create([
            'nombre_producto'=>$request->nombre_producto,
            //'id_marca'=>$request->id_marca,
            'precio_compra'=>$request->precio_compra,
            'cantidad_stock'=>$request->cantidad_stock,
            //'estado_producto'=>$request->estado_producto ?? true,
        ]);

        //site redirect with message: 
        return redirect()->route('productos.index')
                         ->with('success','Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //equivalente al mode= 'DSP'
        $producto_detalle = Productos::findorFail($id);

        return view('productos.show',compact('producto_detalle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //equivalente al mode= 'UPD' en el modo GET, recibe que se va a cambiar
        $producto = Productos::findorFail($id);
        return view('productos.edit',compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //este es el POST del UPD
        $request->validate([
            'nombre_producto'=>'required|string|max:100',
            //'id_marca'=>'required|integer',
            'precio_compra'=>'required|numeric|min:0.01',
            'cantidad_stock'=>'required|integer|min:1',
            'estado_producto'=>'required|boolean'
        ]);

        $producto = Productos::findorFail($id);

        $producto->update([
            'nombre_producto'=>$request->nombre_producto,
            //'id_marca'=>$request->id_marca,
            'precio_compra'=>$request->precio_compra,
            'cantidad_stock'=>$request->cantidad_stock,
            'estado_producto'=>$request->estado_producto ?? true,
        ]);

        return redirect()->route('productos.index')
                         ->with('success','Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
    }
}
