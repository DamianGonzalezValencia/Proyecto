<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(){
        $productos = Producto::paginate(20);

        return view('productos.index', compact('productos'))
            ->with('i', (request()->input('page', 1) - 1) * $productos->perPage());
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
        $request->validate([
            'nombre_pro' => 'required|unique:productos',
            'descripcion_pro' => 'required',
            'cantidad_pro' => 'required|numeric',
            'categorias_id_cat' => 'required',
            'marcas_id_mar' =>'required',
            'modelos_id_mod' =>''
        ]);

        $fechaActual = date('d-m-y');
        $productos = Producto::create($request->all());

        if($productos){
            $nombre_pal_producto = $productos->nombre_pro;
            $descripcion_pal_movimiento = $productos->descripcion_pro;

            $categorias = Categoria::findOrFail($request->input('categorias_id_cat'));
            $marcas = Marca::findOrFail($request->input('marcas_id_mar'));
            $modelos = Modelo::findOrFail($request->input('modelos_id_mod'));

            $movimiento = new Movimiento();
            $movimiento->tipo_mov = 'INGRESO';
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
            {$request->validate([
                'nombre_pro' => 'required|unique:productos',
                'descripcion_pro' => 'required',
                'cantidad_pro' => 'required|numeric',
                'categorias_id_cat' => 'required',
                'marcas_id_mar' =>'required',
                'modelos_id_mod' =>''
            ]);

            $nombre_pro = $request->input('nombre_pro'); //Obtención de los valores requeridos
            $descripcion_pro = $request->input('descripcion_pro');
            $cantidad_pro = $request->input('cantidad_pro');
            $categorias_id_cat = $request->input('categorias_id_cat');
            $marcas_id_mar = $request->input('marcas_id_mar');
            $modelos_id_mod = $request->input('modelos_id_mod');

            $productos = Producto::find($id_pro);
                // Busca la categoría por su ID
            $fechaActual = date('d-m-y');
            if ($productos) {

                $productos->nombre_pro = $nombre_pro;
                $productos->descripcion_pro = $descripcion_pro;
                $productos->cantidad_pro = $cantidad_pro;
                $productos->categorias_id_cat = $categorias_id_cat;
                $productos->marcas_id_mar = $marcas_id_mar;
                $productos->modelos_id_mod = $modelos_id_mod;
                $productos->save();

                $productos = Producto::with('categoria', 'marca', 'modelo')->find($id_pro);

                if($productos && $productos->categoria && $productos->marca && $productos->modelo){
                    $nombre_pal_producto = $productos->nombre_pro;
                    $descripcion_pal_movimiento = $productos->descripcion_pro;

                    $categoriaNombre = $productos->categoria->nombre_cat ?? null;
                    $marcaNombre = $productos->marca->nombre_mar ?? null;
                    $modeloNombre = $productos->modelo->nombre_mod ?? null;

                    $movimiento = new Movimiento();
                    $movimiento->tipo_mov = 'MODIFICACION';
                    $movimiento->cantidad_mov = $request->input('cantidad_pro');
                    $movimiento->fecha_mov = date('d-m-y');
                    $movimiento->nombre_mov = $productos->nombre_pro;
                    $movimiento->users_id = auth()->user()->id;
                    $movimiento->descripcion_mov = $productos->descripcion_pro;
                    
                    $movimiento->categorias_mov = $categoriaNombre;
                    $movimiento->marcas_mov = $marcaNombre;
                    $movimiento->modelos_mov = $modeloNombre;

                    $movimiento->save();
                    return view('productos.index', compact('productos'))->with('success', 'Producto actualizado correctamente.');
                }else{
                    return view('productos.index', compact('productos'))->with('error', 'No se pudo encontrar relaciones');
                }
            } else {
                return redirect()->back()->with('error', 'No se pudo encontrar el Producto con el ID proporcionado.');
            }
        }
    }
//----------------------------------------------------------------
    public function destroy($id_pro)
        {
            $request = request();
            $fechaActual = date('d-m-y');
            $productos = Producto::with('categoria', 'marca', 'modelo')->find($id_pro);

            if ($productos){
                $nombre_pal_producto = $productos->nombre_pro;
                $descripcion_pal_movimiento = $productos->descripcion_pro;

                $productos->delete();
                    $movimiento = new Movimiento();
                    $movimiento->tipo_mov = 'RETIRO';
                    $movimiento->cantidad_mov = $request->has('cantidad_pro');//marca 0 porque está el input y ahi no escribimos nada
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
    

}