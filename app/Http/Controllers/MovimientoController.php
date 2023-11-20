<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movimientos = Movimiento::orderBy('created_at','desc')->paginate(20);

        return view('movimientos.index', compact('movimientos'))
        ->with('i', (request()->input('page',1) - 1) * $movimientos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $movimientos = new Movimiento();
        return view('movimientos.index', compact('movimientos','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        { //DEBO HACER LO MISMO EN EL STORE DE MOVIMIENTOS PERO SOLO CON "retiro"
            /*$request->validate([
                'nombre_pro' => 'required|unique:productos',
                'descripcion_pro' => 'required',
                'cantidad_pro' => 'required|numeric',
                'categorias_id_cat' => 'required',
                'marcas_id_mar' =>'required'
            ]);
    
            $productos = Producto::create($request->all());
    
            $movimiento = new Movimiento();
            $movimiento->tipo_mov = 'ingreso';
            $movimiento->cantidad_mov = $request->input('cantidad_pro');
            $movimiento->productos_id_pro = $productos->id_pro;
            $movimiento->users_id = auth()->user()->id;
            $movimiento->save();
    
            return redirect()->route('productos.index')->with("success",'Producto creado de manera exitosa.');
            */
            return view('movimientos.index', compact('movimientos','productos'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id_mov)
    {
        $movimientos = Movimiento::find($id_mov);
        $productos = Producto::find($movimientos->producto_id_pro);

        return view('movimientos.show', compact('movimientos', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_mov)
    {
        return view('movimientos.index', compact('movimientos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movimientos $movimientos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movimientos $movimientos)
    {
        //
    }
}
