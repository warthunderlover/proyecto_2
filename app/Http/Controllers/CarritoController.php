<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\compra;
use App\Models\Productos;
use App\Models\DetalleCompra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    //ver carrito
    public function index()
    {
    //activando la sesión para el carrito

        $carrito = session('carrito',[]);

        $total = array_sum(array_map(fn($item) => $item['subtotal'],$carrito));

        return view('carrito.index',compact('carrito','total'));
    }

    public function agregar(Request $request, $id){
        $producto = Productos::findOrFail($id);
        $cantidad = $request->input('cantidad_compra',1);
        
        $carrito = session('carrito',[]);

        if(isset($carrito[$id])){
            $carrito[$id]['cantidad'] += $cantidad;
            $carrito[$id]['subtotal'] = $carrito[$id]['cantidad'] * $producto->precio_compra;
        } else {
            $carrito[$id] = [
                'id_producto' => $producto->id_producto,
                'nombre_producto' => $producto->nombre_producto,
                'precio_compra' => $producto->precio_compra,
                'cantidad' => $cantidad,
                'subtotal' => $cantidad * $producto->precio_compra
            ];
        }
        session(['carrito' => $carrito]);

        return redirect()->route('producto')->with('mensaje',"'{$producto->nombre_producto}'agregado al carrito");
    }

    public function actualizar(Request $request, $id){
        $carrito = session('carrito',[]);

        if(isset($carrito[$id])){
            $cantidad = max(1, intval($request->cantidad)); //minimo 1 
            $carrito[$id]['cantidad'] = $cantidad;
            $carrito[$id]['subtotal'] = $cantidad * $carrito[$id]['precio_compra'];
            session(['carrito' => $carrito]);
        }

        return redirect()->route('carrito.index')->with('success','Carrito actualizado');
    }

    public function eliminar($id)
    {
        $carrito = session('carrito', []);
        unset($carrito[$id]);
        session(['carrito' => $carrito]);

        return redirect()->route('carrito.index')
                         ->with('mensaje', 'Producto eliminado del carrito.');
    }

    public function vaciar()
    {
        session()->forget('carrito');

        return redirect()->route('carrito.index')
                         ->with('mensaje', 'Carrito vaciado.');
    }

    public function confirmar()
    {
        $carrito = session('carrito',[]);

        if(empty($carrito)){
            return redirect()->route('carrito.index')->with('error','El carrito está vacío');
        }  

        foreach($carrito as $item){
            $producto = Productos::find($item['id_producto']);

            if($producto->cantidad_stock < $item['cantidad']){
                return redirect()->route('carrito.index')
                                ->with('error', "Stock insuficiente para '{$producto->nombre_producto}'. 
                                                Disponible: {$producto->cantidad_stock} unidades, 
                                                solicitado: {$item['cantidad']}.");
        }
    }

        $total = array_sum(array_map(fn($item)=>$item['subtotal'],$carrito));

        $compra = compra::create([
            'usuario'=>Auth::id(),
            'total_compra'=>$total,
            'fecha_compra'=>now(),
        ]);

        //creando cada linea de detalle, seria mejor hacerlo con un trigger pero no lo voy a hacer jaja

        foreach($carrito as $item){
            DetalleCompra::create([
                'id_compra' => $compra->id_compra,
                'id_producto' => $item['id_producto'],
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $item['precio_compra'],
                'subtotal' => $item['subtotal']
            ]);
        }

        session()->forget('carrito');   

        return redirect()->route('carrito.index')->with('success','Compra confirmada exitosamente');
    }

}
