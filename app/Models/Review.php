<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'table_reviews';
    protected $fillable = ['id_producto','calificacion','comentario'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
