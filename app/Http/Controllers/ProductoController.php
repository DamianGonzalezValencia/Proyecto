<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\UniqueProductAttributes;


class ProductoController extends Controller
{
    public function index(Request $request){

        $busqueda = $request->busqueda;

    $productos = Producto::where('id_pro', 'LIKE', '%' . $busqueda . '%')
        ->orWhere('nombre_pro', 'LIKE', '%' . $busqueda . '%')
        ->latest('id_pro')
        ->paginate(20);

    if ($productos->count() > 0) {
        return view('productos.index', compact('productos'))
            ->with('i', ($productos->currentPage() - 1) * $productos->perPage());
    } else {
        return redirect()->back()->with('error', 'No se encontraron productos');
    }
        //$productos = Producto::orderBy('created_at', 'desc')->paginate(20);

        //if ($productos) {
            //return view('productos.index', compact('productos'))
                //->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
        //} else {
            //return redirect()->back()->with('error', 'Error al obtener los productos');
        //}



        //$productos = Producto::query()
        //    ->with(['productos'])
        //    ->when(request('search'), function ($query){
        //        return $query->where('nombre_pro', 'like', '%'. request('search') . '%');
        //    })
        //    ->paginate(5);
        //return view('productos.index', compact('productos'));
}

    
//------------------------------------------------------------
    public function create(){
        $productos = new Producto();
        $categorias= Categoria::pluck('nombre_cat','id_cat');
        $marcas= Marca::pluck('nombre_mar','id_mar');
        $modelos= Modelo::pluck('nombre_mod','id_mod');
        return view('productos.create', compact('productos','categorias','marcas','modelos'));
    }
//------------------------------------------------------------
    public function store(Request $request){ //DEBO HACER LO MISMO EN EL STORE DE MOVIMIENTOS PERO SOLO CON "retiro"

        try {
            $request->validate([
                'nombre_pro' => 'required',
                'descripcion_pro' => 'required',
                'cantidad_pro' => 'required|numeric|gt:0',
                'categorias_id_cat' => 'required',
                'marcas_id_mar' => 'required', 
                'modelos_id_mod' => 'required',
                new UniqueProductAttributes([
                    'categorias_id_cat' => $request->input('categorias_id_cat'),
                    'marcas_id_mar' => $request->input('marcas_id_mar'),
                    'modelos_id_mod' => $request->input('modelos_id_mod'),
                ]),
            ]);
            // Resto del código para guardar el producto si la validación pasa
        } catch (ValidationException $e) {
            return redirect()->route('productos.form')
                ->withErrors($e->validator)
                ->withInput()
                ->with("error",'Ya existe un producto con la misma categoría, marca y modelo.');        
        }
        
            $fechaActual = date('d-m-y');
            $productos = Producto::create($request->all());

            if($productos){
                $nombre_pal_producto = $productos->nombre_pro;
                $descripcion_pal_movimiento = $productos->descripcion_pro;

                $categorias = Categoria::findOrFail($request->input('categorias_id_cat'));
                $marcas = Marca::findOrFail($request->input('marcas_id_mar'));
                $modelos = Modelo::findOrFail($request->input('modelos_id_mod'));

                $movimiento = new Movimiento();
                $movimiento->tipo_mov = 'NUEVO PRODUCTO';
                $movimiento->cantidad_mov = $request->input('cantidad_pro');
                $movimiento->fecha_mov = $fechaActual;#$fecha_mov capturar la fecha y guardarla 
                $movimiento->nombre_mov = $nombre_pal_producto;#debo agregar el campo nuevo
                $movimiento->users_id = auth()->user()->id;
                $movimiento->descripcion_mov = $descripcion_pal_movimiento;

                $movimiento->categorias_mov = $categorias->nombre_cat;
                $movimiento->marcas_mov = $marcas->nombre_mar;
                $movimiento->modelos_mov = $modelos->nombre_mod;
                $movimiento->save();

                return redirect()->route('productos.index')->with("success",'Producto creado de manera exitosa.');
            }else{
                print 'ACÁ SE HECHÓ A PERDER';
            }
    }
//-------------------------------------------------------------
    public function show($id_pro){
        $productos = Producto::find($id_pro);

        return view('productos.show', compact('productos'));
    }
//-------------------------------------------------------------
    public function edit($id_pro){
        $productos = Producto::find($id_pro);
        $categorias= Categoria::pluck('nombre_cat','id_cat');
        $marcas= Marca::pluck('nombre_mar','id_mar');
        $modelos= Modelo::pluck('nombre_mod','id_mod');
        return view('productos.edit', compact('productos','categorias','marcas','modelos'));
    }
//--------------------------------------------------------------
    public function update(Request $request, $id_pro)
    {   
        $validatedData = $request->validate([
            
            'nombre_pro' => 'required',
            'descripcion_pro' => 'required',
            'categorias_id_cat' => 'required|exists:categorias,id_cat',
            'marcas_id_mar' =>'required|exists:marcas,id_mar',
            'modelos_id_mod' =>'required|exists:modelos,id_mod'
        ]);

        $productos = Producto::find($id_pro);

        if (!$productos) {
            // Si el producto no se encuentra, redireccionar o mostrar un mensaje de error
            return redirect()->route('productos.index')->with('error', 'El producto no fue encontrado.');
        }else
        
        $nombre_anterior = $productos->nombre_pro;
        $descripcion_anterior = $productos->descripcion_pro;
        $categoria_anterior = $productos->categoria->nombre_cat;
        $marca_anterior = $productos->marca->nombre_mar;
        $modelo_anterior = $productos->modelo->nombre_mod;

        $productos->nombre_pro = $validatedData['nombre_pro']; //Obtención de los valores requeridos
        $productos->descripcion_pro = $validatedData['descripcion_pro'];
        $productos->cantidad_pro = $productos->cantidad_pro;
        $productos->categorias_id_cat = $validatedData['categorias_id_cat'];
        $productos->marcas_id_mar = $validatedData['marcas_id_mar'];
        $productos->modelos_id_mod = $validatedData['modelos_id_mod'];
                // Busca la categoría por su ID
        $productos->save();
        $fechaActual = date('d-m-y');
        

            #----------------- MOVIMIENTOS -----------------------
        $categorias = Categoria::findOrFail($request->input('categorias_id_cat'));
        $marcas = Marca::findOrFail($request->input('marcas_id_mar'));
        $modelos = Modelo::findOrFail($request->input('modelos_id_mod'));

        $movimiento = new Movimiento(); 
        $movimiento->tipo_mov = 'MODIFICACION';
        $movimiento->cantidad_mov = $productos-> cantidad_pro;
        $movimiento->fecha_mov = $fechaActual;
        $movimiento->nombre_mov = "Nombre Anterior: {$nombre_anterior}, Nombre Actual: {$productos-> nombre_pro}";
        $movimiento->users_id = auth()->user()->id;
        $movimiento->descripcion_mov = "Descripcion Anterior: {$descripcion_anterior}, Descripcion Actual: {$productos->descripcion_pro}";
                    
        $movimiento->categorias_mov = "Categoría anterior: {$categoria_anterior},
        Categoría nueva: {$categorias->nombre_cat}";
        $movimiento->marcas_mov = "Marca anterior: {$marca_anterior}, Marca nueva: {$marcas->nombre_mar}";
        $movimiento->modelos_mov = "Modelo anterior: {$modelo_anterior}, Modelo nuevo: {$modelos->nombre_mod}";

        $movimiento->save();
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    
    }
    
//----------------------------------------------------------------
    public function destroy($id_pro)
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

}
