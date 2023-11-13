<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Movimiento;
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
        return view('productos.create', compact('productos','categorias','marcas'));
    }
//------------------------------------------------------------
    public function store(Request $request){ //DEBO HACER LO MISMO EN EL STORE DE MOVIMIENTOS PERO SOLO CON "retiro"
        $request->validate([
            'nombre_pro' => 'required|unique:productos',
            'descripcion_pro' => 'required',
            'cantidad_pro' => 'required|numeric',
            'categorias_id_cat' => 'required',
            'marcas_id_mar' =>'required'
        ]);

        $fechaActual = date('d-m-y');
        $productos = Producto::create($request->all());

        if($productos){
            $nombre_pal_producto = $productos->nombre_pro;
            $movimiento = new Movimiento();
            $movimiento->tipo_mov = 'INGRESO';
            $movimiento->cantidad_mov = $request->input('cantidad_pro');
            $movimiento->fecha_mov = $fechaActual;#$fecha_mov capturar la fecha y guardarla 
            $movimiento->nombre_mov = $nombre_pal_producto;#debo agregar el campo nuevo
            $movimiento->users_id = auth()->user()->id;
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
        return view('productos.edit', compact('productos','categorias','marcas'));
    }
//--------------------------------------------------------------
    public function update(Request $request, $id_pro)
    {   
            {$request->validate([
                'nombre_pro' => 'required|unique:productos',
                'descripcion_pro' => 'required',
                'cantidad_pro' => 'required|numeric',
                'categorias_id_cat' => 'required',
                'marcas_id_mar' =>'required'
            ]);

            $productos = Producto::find($id_pro);

            $nombre_pro = $request->input('nombre_pro'); //Obtención de los valores requeridos
            $descripcion_pro = $request->input('descripcion_pro');
            $cantidad_pro = $request->input('cantidad_pro');
            $categorias_id_cat = $request->input('categorias_id_cat');
            $marcas_id_mar = $request->input('marcas_id_mar');
                // Busca la categoría por su ID
            $fechaActual = date('d-m-y');
            if ($productos) {
                $nombre_pal_producto = $productos->nombre_pro;

                $productos->nombre_pro = $nombre_pro;
                $productos->descripcion_pro = $descripcion_pro;
                $productos->cantidad_pro = $cantidad_pro;
                $productos->categorias_id_cat = $categorias_id_cat;
                $productos->marcas_id_mar = $marcas_id_mar;
                $productos->save();

                $productos = Producto::find($id_pro)->all();
                $categorias = Categoria::all();
                $marcas = Marca::all();

                if($productos){

                    $movimiento = new Movimiento();
                    $movimiento->tipo_mov = 'MODIFICACION';
                    $movimiento->cantidad_mov = $request->input('cantidad_pro');
                    $movimiento->fecha_mov = $fechaActual;#$fecha_mov capturar la fecha y guardarla 
                    $movimiento->nombre_mov = $nombre_pal_producto;#debo agregar el campo nuevo
                    $movimiento->users_id = auth()->user()->id;
                    $movimiento->save();
                }

                    
                return view('productos.index', compact('productos', 'categorias', 'marcas'))->with('success', 'Producto actualizado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se pudo encontrar el Producto con el ID proporcionado.');
            }
        }
    }
//----------------------------------------------------------------
    public function destroy($id_pro)
    {   
        {
            $request = request();
            $fechaActual = date('d-m-y');
            $productos = Producto::find($id_pro);

            if ($productos){
                $nombre_pal_producto = $productos->nombre_pro;
                $productos->delete();
                $movimiento = new Movimiento();
                $movimiento->tipo_mov = 'RETIRO';
                $movimiento->cantidad_mov = $request->has('cantidad_pro');
                $movimiento->fecha_mov = $fechaActual;
                $movimiento->nombre_mov = $nombre_pal_producto;
                $movimiento->users_id = auth()->user()->id;
                $movimiento->save();

                return redirect()->route('productos.index')
                    ->with('success', 'producto deleted successfully');
            } else {
                return redirect()->route('productos.index')
                    ->with('error', 'Producto no Encontrado');


            }   
        }
    }
    

}