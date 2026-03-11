<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    //
    protected $table = 'compras';
    protected $primaryKey = 'id_compra'; 

    protected $fillable = [
        'usuario',
        'total_compra',
        'fecha_compra',
    ];
}
