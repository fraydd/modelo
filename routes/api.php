<?php

use App\Models\Admin;
use App\Models\modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('datatable',function(){
    $modelos=modelo::all();
    foreach($modelos as $modelo)
            {
                if($modelo->estado==1){
                    $modelo->estado='Activo';
                }elseif($modelo->estado==0){
                    $modelo->estado='Caducado';
                }
            
            }
    return datatables()
    ->of($modelos)
    
    ->addColumn('btn','actions')
    ->addColumn('imagen','foto')
    ->rawColumns(['btn','imagen'])
    ->toJson();
});

Route::get('datatable2',function(){
    $empleados=Admin::all();

    return datatables()
    ->of($empleados)
    
    ->addColumn('btn','actionsempleado')
    ->rawColumns(['btn'])
    ->toJson();
});
