<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\TarifaController;
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
Route::get('/empleado/ingreso', [App\Http\Controllers\EmpleadoController::class, 'ingreso'])->name('empleado.ingreso');
Route::post('/empleado/ingreso', [App\Http\Controllers\EmpleadoController::class, 'estore'])->name('empleado.estore');
Route::post('/empleado/salida', [App\Http\Controllers\EmpleadoController::class, 'salida'])->name('empleado.salida');
Route::post('perfil', [App\Http\Controllers\EmpleadoController::class, 'perfilpost'])->name('empleado.perfilpost');




Route::resource('modelos',ModeloController::class);
Route::get('modelos/{modelo}/renovar',[App\Http\Controllers\ModeloController::class, 'renovar'])->name('modelos.renovar');
Route::get('modelos/{modelo}/borrar',[App\Http\Controllers\ModeloController::class, 'borrar'])->name('modelos.borrar');
Route::get('modelos/pdf',[App\Http\Controllers\ModeloController::class, 'pdf'])->name('modelos.pdf');
Route::put('modelos/renovar/{modelo}', 'App\Http\Controllers\ModeloController@renovarpost')->name('modelos.renovarpost');
Route::put('modelos/uniforme/{modelo}', 'App\Http\Controllers\ModeloController@uniformeput')->name('modelos.uniformeput');
Route::put('modelos/pasarela/{modelo}', [App\Http\Controllers\ModeloController::class, 'pasarelaput'])->name('modelos.pasarelaput');
Route::get('modelos/{adeudo}/borrarad',[App\Http\Controllers\ModeloController::class, 'borrarad'])->name('modelos.borrarad');
Route::get('modelos/{adeudo}/editarad',[App\Http\Controllers\ModeloController::class, 'editarad'])->name('modelos.editarad');
Route::put('modelos/editad/{adeudo}', [App\Http\Controllers\ModeloController::class, 'editad'])->name('modelos.editad');


Route::get('pasarela',[App\Http\Controllers\ModeloController::class, 'pasarela'])->name('modelos.pasarela');
Route::get('caja',[App\Http\Controllers\ModeloController::class, 'caja'])->name('modelos.caja');
Route::post('caja', [App\Http\Controllers\ModeloController::class, 'cajapost'])->name('modelos.cajapost');
Route::get('estadisticas',[App\Http\Controllers\ModeloController::class, 'estadisticas'])->name('modelos.estadisticas');
Route::put('update/{usuario}',[App\Http\Controllers\ModeloController::class, 'update'])->name('update');
Route::put('modelos/deuda/{modelo}', 'App\Http\Controllers\ModeloController@deudaput')->name('modelos.deudaput');


Route::get('tarifa', 'App\Http\Controllers\AdminController@tarifa')->name('modelos.tarifa');
Route::post('tarifaMes', 'App\Http\Controllers\AdminController@tarifaMes')->name('modelos.tarifaMes');
Route::post('tarifaP', 'App\Http\Controllers\AdminController@tarifaP')->name('modelos.tarifaP');
Route::get('admin/{tarifa}/borrarp',[App\Http\Controllers\AdminController::class, 'borrarp'])->name('admin.borrarp');


Route::resource('admin',AdminController::class);
Route::get('admin/{admin}/borrar',[App\Http\Controllers\AdminController::class, 'borrar'])->name('admin.borrar');
Route::get('ingresos',[App\Http\Controllers\AdminController::class, 'ingresos'])->name('admin.ingresos');
Route::get('ingresose',[App\Http\Controllers\AdminController::class, 'ingresose'])->name('admin.ingresose');
