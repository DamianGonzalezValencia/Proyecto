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
        'productos_id_pro' => 'required',
        'users_id' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['id_mov','cantidad_mov','fecha_mov','productos_id_pro','users_id'];

    public function User(){
        return $this->belongsTo('App\Models\User','users_id','id');
    }

    public function Producto(){
        return $this->belongsTo('App\Models\Producto','productos_id_pro','id_pro');
    }

}