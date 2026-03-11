<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    //php artisan make:model Marcas -m para crear el modelo y la migracion, luego se hace la migracion con php artisan migrate
    protected $table = 'marcas';
    protected $primaryKey = 'id_marca'; 

    protected $fillable = [
        'nombre_marca',
        'id_proveedor',
        'estado_marca',
    ];
}
