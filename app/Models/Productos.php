<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//en este de aquí se cargan los datos, o sea el controlador plural de simplemvcphp
class Productos extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';

    protected $fillable = 
    [
        'nombre_producto',
        //'id_marca',
        'precio_compra',
        'cantidad_stock',
        'estado_producto',
        'imagen',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'id_producto');
    }

    public function promedioCalificacion()
    {
        return $this->table_reviews()->avg('calificacion');
    }
}
