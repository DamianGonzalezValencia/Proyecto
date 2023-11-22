<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Producto;

class UniqueProductAttributes implements Rule
{
    public function passes($attribute, $value)
    {
        $exists = Producto::where('categorias_id_cat', $value['categorias_id_cat'])
            ->where('marcas_id_mar', $value['marcas_id_mar'])
            ->where('modelos_id_mod', $value['modelos_id_mod'])
            ->exists();

        return !$exists;
    }

    public function message()
    {
        return 'Ya existe un producto con la misma categoría, marca y modelo.';
    }
}
