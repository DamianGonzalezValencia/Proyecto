<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categorias = Categoria::withCount('productos')->get();
        $marcas = Marca::withCount('productos')->get();
        $stockProductos = Producto::where('cantidad_pro', '<=', 3)->get();

        return view('home', compact('categorias','marcas','stockProductos'));
    }
}
