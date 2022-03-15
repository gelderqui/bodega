<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('contenido.contenido');
});

Route::get('/producto', 'App\Http\Controllers\ProductoController@index');
Route::post('/producto/registrar', 'App\Http\Controllers\ProductoController@store');
Route::put('/producto/actualizar', 'App\Http\Controllers\ProductoController@update');
Route::put('/producto/desactivar', 'App\Http\Controllers\ProductoController@desactivar');
Route::put('/producto/activar', 'App\Http\Controllers\ProductoController@activar');

Route::get('/proveedor', 'App\Http\Controllers\ProveedorController@index');
Route::post('/proveedor/registrar', 'App\Http\Controllers\ProveedorController@store');
Route::put('/proveedor/actualizar', 'App\Http\Controllers\ProveedorController@update');
Route::put('/proveedor/desactivar', 'App\Http\Controllers\ProveedorController@desactivar');
Route::put('/proveedor/activar', 'App\Http\Controllers\ProveedorController@activar');

Route::get('/usuario', 'App\Http\Controllers\UsuarioController@index');
Route::post('/usuario/registrar', 'App\Http\Controllers\UsuarioController@store');
Route::put('/usuario/actualizar', 'App\Http\Controllers\UsuarioController@update');
Route::put('/usuario/desactivar', 'App\Http\Controllers\UsuarioController@desactivar');
Route::put('/usuario/activar', 'App\Http\Controllers\UsuarioController@activar');
Route::get('/rol/selectRol', 'App\Http\Controllers\UsuarioController@selectRol');