<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelo::orderBy('created_at','desc')->paginate(20);

        return view('modelos.index', compact('modelos'))
            ->with('i', (request()->input('page', 1) - 1) * $modelos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modelos = new Modelo();
        return view('modelos.create', compact('modelos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_mod' => 'required|unique:modelos'
        ]);

        $modelos = Modelo::create($request->all());

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Modelo $id_mod)
    {
        $modelos = Modelo::find($id_mod);

        return view('modelos.show', compact('modelos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_mod)
    {
        $modelos = Modelo::find($id_mod);

        return view('modelos.edit', compact('modelos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_mod)
    {
        {
            $request->validate([
                'nombre_mod' => 'required|unique:modelos'
            ]);
    
            $nombre_mod = $request->input('nombre_mod');// Obtén el nuevo nombre de la categoría del formulario

             // Busca la categoría por su ID
            $modelos = Modelo::find($id_mod);
            if ($modelos) {
                $modelos->nombre_mod = $nombre_mod;
                $modelos->save();
    
                return redirect()->route('modelos.index')->with('success', 'Modelo actualizada correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se pudo encontrar el Modelo');
            }
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_mod)
    {
        $modelos = Modelo::find($id_mod)->delete();

        return redirect()->route('modelos.index')
            ->with('success', 'Modelo deleted successfully');
    }
}
