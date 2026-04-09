<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    //
    protected $table = 'detalle_compras';
    protected $primaryKey = 'id_detalle_compra';

    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function producto()
    {
        return $this->belongsTo(Productos::class, 'id_producto', 'id_producto');
    }
}
