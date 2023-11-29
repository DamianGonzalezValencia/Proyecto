<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();

Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('marcas', App\Http\Controllers\MarcaController::class)->middleware('auth');
Route::resource('modelos', App\Http\Controllers\ModeloController::class)->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('movimientos', App\Http\Controllers\MovimientoController::class)->middleware('auth');


#-------------------- CONTROLADOR DE STOCK ---------------------------------------------------------
Route::get('productos/{id_pro}/aumentar-stock', [StockController::class, 'aumentarStock'])->name('productos.aumentarStock')->middleware('auth');
Route::patch('productos/{id_pro}/aumentar-stock', [StockController::class, 'añadirMasProductos'])->name('productos.añadirMasProductos')->middleware('auth');

Route::get('productos/{id_pro}/disminuir-stock', [StockController::class, 'disminuirStock'])->name('productos.disminuirStock')->middleware('auth');
Route::patch('productos/{id_pro}/disminuir-stock', [StockController::class, 'retirarProductos'])->name('productos.retirarProductos')->middleware('auth');

Route::get('productos/{id_pro}/prestamos-stock', [StockController::class, 'prestamosShow'])->name('productos.prestamosShow')->middleware('auth');
Route::patch('productos/{id_pro}/prestamos-stock', [StockController::class, 'prestamosProductos'])->name('productos.prestamosProductos')->middleware('auth');
#---------------------------------------------------------------------------------------------------

//Route::patch('productos/{id_pro}/generarPrestamo', [StockControlador::class, 'prestamosProductos'])->name('productos.prestamosProductos')->middleware('auth');






Route::delete('productos/{id_pro}/(', [StockController::class, 'retirarProductos'])->name('productos.eliminar')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

#NO PUEDEN HABER 2 FUNCIONES ULITIZANDO EL MISMO MÉTODO EN LA MISMA VISTA