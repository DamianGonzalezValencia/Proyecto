<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $id_cat
 * @property $nombre_cat
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto[] $productos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    protected $table = 'categorias';
    
    protected $primaryKey = 'id_cat';

    static $rules = [
		'nombre_cat' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cat','nombre_cat'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos() //ÉSTA FUNCION ACÁ SE ENCARGA DE HACER EL TIPO DE RELACION 1 A MUCHOS ENTRE LA TABLA CATEGORIAS Y LA TABLA PRODUCTOS
    {
        return $this->hasMany('App\Models\Producto', 'categorias_id_cat', 'id_cat');
    }
    

}
