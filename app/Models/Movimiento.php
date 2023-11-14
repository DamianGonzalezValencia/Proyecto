<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    
    protected $primaryKey = 'id_mov';

    static $rules = [ //FALTA, AQUI QUEDE
		'tipo_mov' => 'required',#Crear una validacion booleana entre "Ingreso" y "Retiro"
        'cantidad_mov' => 'required',
        'fecha_mov' => 'required',
        'nombre_mov' => 'required',
        'users_id' => 'required',
        'descripcion_mov' => 'required',
        'categorias_mov' => 'required',
        'marcas_mov' => 'required',
        'modelos_mod' => 'required'
    ];

    protected $perPage = 20;

    protected $fillable = ['id_mov','cantidad_mov','fecha_mov','nombre_mov','users_id', 'descripcion_mov', 'categorias_mov', 'marcas_mov', 'modelos_mod'];

    public function User(){
        return $this->belongsTo('App\Models\User','users_id','id');
    }

    public function Producto()
    {
        return $this->belongsTo(Producto::class, 'productos_id_pro', 'id_pro');
    }

}
