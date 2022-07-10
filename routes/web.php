<?php

use App\Http\Controllers\ModeloController;
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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/empleado', [App\Http\Controllers\EmpleadoController::class, 'index'])->name('empleado.index');
Route::post('/empleado', [App\Http\Controllers\EmpleadoController::class, 'store'])->name('empleado.store');
Route::get('/empleado/perfil', [App\Http\Controllers\EmpleadoController::class, 'perfil'])->name('empleado.perfil');
Route::resource('modelos',ModeloController::class);
Route::get('modelos/{modelo}/renovar',[App\Http\Controllers\ModeloController::class, 'renovar'])->name('modelos.renovar');
Route::get('modelos/{modelo}/borrar',[App\Http\Controllers\ModeloController::class, 'borrar'])->name('modelos.borrar');
Route::get('modelos/pdf',[App\Http\Controllers\ModeloController::class, 'pdf'])->name('modelos.pdf');
