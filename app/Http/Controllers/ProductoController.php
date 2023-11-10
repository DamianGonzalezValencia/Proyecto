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

        $movimiento = new Movimiento();
        $movimiento->tipo_mov = 'ingreso';
        $movimiento->cantidad_mov = $request->input('cantidad_pro');
        $movimiento->fecha_mov = $fechaActual;#$fecha_mov capturar la fecha y guardarla 
        $movimiento->productos_id_pro = $productos->id_pro;
        $movimiento->users_id = auth()->user()->id;
        $movimiento->save();

        return redirect()->route('productos.index')->with("success",'Producto creado de manera exitosa.');
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
        {
            $productos = Producto::find($id_pro);

            $nombre_pro = $request->input('nombre_pro'); //Obtención de los valores requeridos
            $descripcion_pro = $request->input('descripcion_pro');
            $cantidad_pro = $request->input('cantidad_pro');
            $categorias_id_cat = $request->input('categorias_id_cat');
            $marcas_id_mar = $request->input('marcas_id_mar');
                // Busca la categoría por su ID

            if ($productos) {

                $productos->nombre_pro = $nombre_pro;
                $productos->descripcion_pro = $descripcion_pro;
                $productos->cantidad_pro = $cantidad_pro;
                $productos->categorias_id_cat = $categorias_id_cat;
                $productos->marcas_id_mar = $marcas_id_mar;
                $productos->save();

                $productos = Producto::find($id_pro)->all();
                $categorias = Categoria::all();
                $marcas = Marca::all();
                    
                return view('productos.index', compact('productos', 'categorias', 'marcas'))->with('success', 'Producto actualizado correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se pudo encontrar el Producto con el ID proporcionado.');
            }
        }
    }
//----------------------------------------------------------------
    public function destroy($id_pro)//AGREGUÉ EL "Request $request"
    {
        $request = request();
        $fechaActual = now();
        $productos = Producto::find($id_pro);
        if ($productos){
            $productos->delete();
            $movimiento = new Movimiento();
            $movimiento->tipo_mov = 'retiro';
            $movimiento->cantidad_mov = $request->has('cantidad_pro') ? $request->input('cantidad_pro') : 0;
            $movimiento->fecha_mov = $fechaActual;
            $movimiento->productos_id_pro = $productos->id_pro;
            $movimiento->users_id = auth()->user()->id;
            $movimiento->save();

            return redirect()->route('productos.index')
                ->with('success', 'Categoria deleted successfully');
        } else {
            return redirect()->route('productos.index')
                ->with('error', 'Producto no Encontrado');


        }   
    }

}