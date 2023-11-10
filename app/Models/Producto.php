<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Producto extends Model
{
    protected $table = 'productos';
    
    protected $primaryKey = 'id_pro';

    static $rules = [
		'nombre_pro' => 'required',
        'descripcion_pro' => 'required',
        'cantidad_pro' => 'required',
        'categorias_id_cat' => 'required',
        'marcas_id_mar' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['id_pro','nombre_pro','descripcion_pro','cantidad_pro','categorias_id_cat','marcas_id_mar'];

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria','categorias_id_cat','id_cat');
    }

    public function marca(){
        return $this->belongsTo('App\Models\Marca','marcas_id_mar','id_mar');
    }

    public function movimiento(){
        return $this->hasMany('App\Models\Movimiento','productos_id_pro','id_pro');
    }
    
}
