<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('/welcome');
});

Auth::routes();

Route::resource('categorias', App\Http\Controllers\CategoriaController::class)->middleware('auth');
Route::resource('marcas', App\Http\Controllers\MarcaController::class)->middleware('auth');
Route::resource('modelos', App\Http\Controllers\ModeloController::class)->middleware('auth');
Route::resource('productos', App\Http\Controllers\ProductoController::class)->middleware('auth');
Route::resource('movimientos', App\Http\Controllers\MovimientoController::class)->middleware('auth');

Route::get('productos/{producto}/edit2', [ProductoController::class, 'aumentarStock'])->middleware('auth')->name('productos.editstockmas');
Route::get('productos/{producto}/edit3', [ProductoController::class, 'disminuirStock'])->middleware('auth')->name('productos.editstockmenos');
//Route::get('/ruta',[ProductoController::class, 'aumentarStock']);
//Route::get('productos/{id_pro}/aumentar', 'Controllers\ProductoController@aumentarStock')->name('productos.editstockmas')->middleware('auth');
//Route::get('productos/{id_pro}/disminuir', 'Controllers\ProductoController@disminuirStock')->name('productos.editstockmenos')->middleware('auth');

//Route::get('productos/{id_pro}/aumentarform', 'Controllers\ProductoController@aumentarStock')->name('productos.formupdatemas');
//Route::get('productos/{id_pro}/disminuirform', 'Controllers\ProductoController@disminuirStock')->name('productos.formupdatemenos');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
