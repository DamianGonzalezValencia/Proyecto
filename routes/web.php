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
Route::patch('productos/{id_pro}/añadir-mas-stock', [StockController::class, 'añadirMasProductos'])->name('productos.añadirMasProductos')->middleware('auth');
Route::get('productos/{id_pro}/aumentar-stock', [StockController::class, 'aumentarStock'])->name('productos.aumentarStock')->middleware('auth');
Route::patch('productos/{id_pro}/aumentar-stock', [StockController::class, 'añadirMasProductos'])->name('productos.añadirMasProductos')->middleware('auth');

Route::get('productos/{id_pro}/retirar-stock', [StockController::class, 'retirarProductos'])->name('productos.retirarProductos')->middleware('auth');
Route::get('productos/{id_pro}/disminuir-stock', [StockController::class, 'disminuirStock'])->name('productos.disminuirStock')->middleware('auth');
Route::patch('productos/{id_pro}/disminuir-stock', [StockController::class, 'retirarProductos'])->name('productos.retirarProductos')->middleware('auth');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
