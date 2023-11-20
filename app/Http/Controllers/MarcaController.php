<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

/**
 * Class MarcaController
 * @package App\Http\Controllers
 */
class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::orderBy('created_at','desc')->paginate(20);

        return view('marcas.index', compact('marcas'))
            ->with('i', (request()->input('page', 1) - 1) * $marcas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = new Marca();
        return view('marcas.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_mar' => 'required|unique:marcas'
        ]);

        $marcas = Marca::create($request->all());

        return redirect()->route('marcas.index')
            ->with('success', 'Marca created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_mar)
    {
        $marcas = Marca::find($id_mar);

        return view('marcas.show', compact('marcas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_mar)
    {
        $marcas = Marca::find($id_mar);

        return view('marcas.edit', compact('marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Marca $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_mar)
    {
        {
            $request->validate([
                'nombre_mar' => 'required|unique:marcas'
            ]);
    
            $nombre_mar = $request->input('nombre_mar');// Obtén el nuevo nombre de la categoría del formulario

             // Busca la categoría por su ID
            $marcas = Marca::find($id_mar);
            if ($marcas) {
                $marcas->nombre_mar = $nombre_mar;
                $marcas->save();
    
                return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente.');
            } else {
                return redirect()->back()->with('error', 'No se pudo encontrar la categoría con el ID proporcionado.');
            }
        }    
    }
    
    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id_mar)
    {
        $marcas = Marca::find($id_mar)->delete();

        return redirect()->route('marcas.index')
            ->with('success', 'Marca deleted successfully');
    }
}
