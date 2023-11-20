<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::orderBy('created_at','desc')->paginate(20);

        return view('categorias.index', compact('categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = new Categoria();
        return view('categorias.create', compact('categorias'));
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
            'nombre_cat' => 'required|unique:categorias'
        ]);

        $categorias = Categoria::create($request->all());

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_cat)
    {
        $categorias = Categoria::find($id_cat);

        return view('categorias.show', compact('categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_cat)
    {
        $categorias = Categoria::find($id_cat);

        return view('categorias.edit', compact('categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_cat)
    {
        {
            $request->validate([
                'nombre_cat' => 'required|unique:categorias'
            ]);
    
            $nombre_cat = $request->input('nombre_cat');// Obtén el nuevo nombre de la categoría del formulario

             // Busca la categoría por su ID
            $categorias = Categoria::find($id_cat);
            if ($categorias) {
                $categorias->nombre_cat = $nombre_cat;
                $categorias->save();
    
                return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
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
    public function destroy($id_cat)
    {
        $categorias = Categoria::find($id_cat)->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria deleted successfully');
    }

    // ESTE CONTROLADOR LO HIZE YO

}
