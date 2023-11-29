<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function aumentarStock(Request $request, $id_pro)
    {

        $productos = Producto::findOrFail($id_pro);
        $categorias= Categoria::pluck('nombre_cat','id_cat');
        $marcas= Marca::pluck('nombre_mar','id_mar');
        $modelos= Modelo::pluck('nombre_mod','id_mod');
        $cantidad_pro = $productos->cantidad_pro;
    
        return view('productos.aumentar_stock', compact('cantidad_pro','productos','categorias','marcas','modelos'));

    }

//----------------------------------------------------------------

    public function disminuirStock(Request $request, $id_pro)
    {
        $productos = Producto::findOrFail($id_pro);
        $categorias= Categoria::pluck('nombre_cat','id_cat');
        $marcas= Marca::pluck('nombre_mar','id_mar');
        $modelos= Modelo::pluck('nombre_mod','id_mod');


        return view('productos.disminuir_stock', compact('productos','categorias','marcas','modelos'));
    }

//----------------------------------------------------------------

    public function prestamosShow(Request $request, $id_pro)
    {
        $productos = Producto::findOrFail($id_pro);
        $categorias= Categoria::pluck('nombre_cat','id_cat');
        $marcas= Marca::pluck('nombre_mar','id_mar');
        $modelos= Modelo::pluck('nombre_mod','id_mod');


        return view('productos.prestamos_stock', compact('productos','categorias','marcas','modelos'));
    }

//----------------------------------------------------------------

    public function añadirMasProductos(Request $request, $id_pro)
    {
        $validatedData = $request->validate([
            
            'cantidad_pro' => 'required|numeric|gt:0',
            
        ]);

        $productos = Producto::find($id_pro);

        if (!$productos) {
            // Si el producto no se encuentra, redireccionar o mostrar un mensaje de error
            return redirect()->route('productos.index')->with('error', 'El producto no fue encontrado.');
        }else{
        
            $cantidadAñadida = $validatedData['cantidad_pro'];
            $productos->cantidad_pro += $cantidadAñadida;
            $categoria_anterior = $productos->categoria->nombre_cat;
            $marca_anterior = $productos->marca->nombre_mar;
            $modelo_anterior = $productos->modelo->nombre_mod;
            $productos->save();
            
            $fechaActual = date('d-m-y');

                #----------------- MOVIMIENTOS -----------------------
            $categorias = Categoria::find($request->input('categorias_id_cat'));
            $marcas = Marca::find($request->input('marcas_id_mar'));
            $modelos = Modelo::find($request->input('modelos_id_mod'));

            $movimiento = new Movimiento(); 
            $movimiento->tipo_mov = 'INGRESO DE STOCK';
            $movimiento->cantidad_mov = $cantidadAñadida;
            $movimiento->fecha_mov = $fechaActual;
            $movimiento->nombre_mov = $productos-> nombre_pro;
            $movimiento->users_id = auth()->user()->id;
            $movimiento->descripcion_mov = $productos-> descripcion_pro;
                        
            $movimiento->categorias_mov = $categoria_anterior;
            $movimiento->marcas_mov = $marca_anterior;
            $movimiento->modelos_mov = $modelo_anterior;

            $movimiento->save();
            return redirect()->route('productos.index')->with('success', 'Stock actualizado correctamente.');
        }
    }

//----------------------------------------------------------------

    public function retirarProductos(Request $request, $id_pro)
    {
        $validatedData = $request->validate([
            
            'cantidad_pro' => 'required|numeric|gt:0'
            
        ]);

        $productos = Producto::find($id_pro);

        if (!$productos) {
            // Si el producto no se encuentra, redireccionar o mostrar un mensaje de error
            return redirect()->route('productos.index')->with('error', 'El producto no fue encontrado.');
        }else
        
        $cantidad_antes = $productos->cantidad_pro;
        $cantidadIngresada = $validatedData['cantidad_pro'];
        $categoria_anterior = $productos->categoria->nombre_cat;
        $marca_anterior = $productos->marca->nombre_mar;
        $modelo_anterior = $productos->modelo->nombre_mod;

        if ($cantidadIngresada > $productos->cantidad_pro) {
            return redirect()->back()->with('error', 'La cantidad ingresada es mayor que la cantidad disponible.');
        }
        $productos->cantidad_pro -= $cantidadIngresada;

                // Busca la categoría por su ID
        $productos->save();
        $fechaActual = date('d-m-y');
        
        $categorias = Categoria::find($request->input('categorias_id_cat'));
        $marcas = Marca::find($request->input('marcas_id_mar'));
        $modelos = Modelo::find($request->input('modelos_id_mod'));
            #----------------- MOVIMIENTOS -----------------------

        $movimiento = new Movimiento(); 
        $movimiento->tipo_mov = 'RETIRO DE STOCK';
        $movimiento->cantidad_mov = $cantidadIngresada;
        $movimiento->fecha_mov = $fechaActual;
        $movimiento->nombre_mov = $productos-> nombre_pro;
        $movimiento->users_id = auth()->user()->id;
        $movimiento->descripcion_mov = $productos-> descripcion_pro;
                    
        $movimiento->categorias_mov = $categoria_anterior;
        $movimiento->marcas_mov = $marca_anterior;
        $movimiento->modelos_mov = $modelo_anterior;

        $movimiento->save();
        return redirect()->route('productos.index')->with('success', 'Stock actualizado correctamente.');
    
    }

#--------------------------------------------------------

    public function eliminar($id_pro)
    {
        $request = request();
        $fechaActual = date('d-m-y');
        $productos = Producto::with('categoria', 'marca', 'modelo')->find($id_pro);

        if ($productos){
            $nombre_pal_producto = $productos->nombre_pro;
            $cantidad_anterior = $productos->cantidad_pro;
            $descripcion_pal_movimiento = $productos->descripcion_pro;

            $productos->delete();
                $movimiento = new Movimiento();
                $movimiento->tipo_mov = 'PRODUCTO BORRADO';
                $movimiento->cantidad_mov = $cantidad_anterior;//marca 0 porque está el input y ahi no escribimos nada
                $movimiento->fecha_mov = $fechaActual;
                $movimiento->nombre_mov = $nombre_pal_producto;
                $movimiento->users_id = auth()->user()->id;
                $movimiento->descripcion_mov = $descripcion_pal_movimiento;

                $movimiento->categorias_mov = $productos->categoria->nombre_cat;
                $movimiento->marcas_mov = $productos->marca->nombre_mar;
                $movimiento->modelos_mov = $productos->modelo->nombre_mod;
                $movimiento->save();

            return redirect()->route('productos.index')
                ->with('success', 'producto deleted successfully');
        } else {
            return redirect()->route('productos.index')
                ->with('error', 'Producto no Encontrado');

        }   
    }

//----------------------------------------------------------------

    public function prestamosProductos(Request $request, $id_pro)#Usar de referencia a "public function retirarProductos"
    {
        $validatedData = $request->validate([
            
            'cantidad_pro' => 'required|numeric|gt:0'
            
        ]);

        $productos = Producto::find($id_pro);

        if (!$productos) {
            // Si el producto no se encuentra, redireccionar o mostrar un mensaje de error
            return redirect()->route('productos.index')->with('error', 'El producto no fue encontrado.');
        }else
        
        $cantidad_antes = $productos->cantidad_pro;
        $cantidadIngresada = $validatedData['cantidad_pro'];
        $categoria_anterior = $productos->categoria->nombre_cat;
        $marca_anterior = $productos->marca->nombre_mar;
        $modelo_anterior = $productos->modelo->nombre_mod;

        if ($cantidadIngresada > $productos->cantidad_pro) {
            return redirect()->back()->with('error', 'La cantidad ingresada es mayor que la cantidad disponible.');
        }
        $productos->cantidad_pro -= $cantidadIngresada;

                // Busca la categoría por su ID
        $productos->save();
        $fechaActual = date('d-m-y');
        
        $categorias = Categoria::find($request->input('categorias_id_cat'));
        $marcas = Marca::find($request->input('marcas_id_mar'));
        $modelos = Modelo::find($request->input('modelos_id_mod'));
            #----------------- MOVIMIENTOS -----------------------

        $movimiento = new Movimiento(); 
        $movimiento->tipo_mov = 'PRÉSTAMO';
        $movimiento->cantidad_mov = $cantidadIngresada;
        $movimiento->fecha_mov = $fechaActual;
        $movimiento->nombre_mov = $productos-> nombre_pro;
        $movimiento->users_id = auth()->user()->id;
        $movimiento->descripcion_mov = $productos-> descripcion_pro;
                    
        $movimiento->categorias_mov = $categoria_anterior;
        $movimiento->marcas_mov = $marca_anterior;
        $movimiento->modelos_mov = $modelo_anterior;

        $movimiento->save();
        return redirect()->route('productos.index')->with('success', 'Stock actualizado correctamente.');
    }

}

//----------------------------------------------------------------

