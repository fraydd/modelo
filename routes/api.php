<?php

use App\Models\Admin;
use App\Models\Caja;
use App\Models\Eingreso;
use App\Models\Ingreso;
use App\Models\modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\medio;


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

            foreach ($modelos as $modelo ) {
                $b=$modelo->busto;
                $ci=$modelo->cintura;
                $ca=$modelo->cadera;
                $array=strval($b).'/'.strval($ci).'/'.strval($ca);
                $modelo->fac=$array;
                
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

Route::get('datatable3',function(){
    $cajas=Caja::all();
    foreach($cajas as $caja)
    {
        $caja->valor=number_format($caja->valor,0);
    }

    return datatables()
    ->of($cajas)
    ->toJson();
});

Route::get('cajaroot',function(){
    $cajas=Caja::all();
    
    foreach($cajas as $caja)
    {
        $caja->valor=number_format($caja->valor,0);
        if ($caja->medio_id==1) {
            $caja->medio_id='Efectivo';
        }elseif ($caja->medio_id==2) {
            $caja->medio_id='Transferencia';

            
        }else{
            $caja->medio_id='NA';

        }
    }

    return datatables()
    ->of($cajas)
    ->addColumn('btn','actioncajaroot')
    ->rawColumns(['btn'])
    ->toJson();

});

Route::get('datatable4',function(){

    $modelos=modelo::all();
    
    
    foreach ($modelos as $modelo ) {
        $deudas=DB::table('adeudos')->where('modelo_id','=',$modelo->id)->get();
        $d='';
        foreach ($deudas as $deuda ) {
            $d=$d.'; '.$deuda->tipo;
            
            
        }
        $d=substr($d, 2);
        $modelo->deudas=$d;
        
        
    }
    
    

    return datatables()
    ->of($modelos)
    
    
    ->addColumn('imagen','foto')
    ->rawColumns(['imagen'])
    ->toJson();
});

Route::get('datatable5',function(){
    $ingresos=Ingreso::all();
    $colec=collect([]);
    $nombre=[];
    $i=1;
    foreach ($ingresos as $ingreso ) {
        $modelo=modelo::findOrFail($ingreso->modelo_id);
        $nombre=$modelo->nombre;
        $create=$ingreso->created_at;
        
        $data=new Ingreso();
        $data->nombre=$nombre;
        $data->create=$create->format('Y-m-d h:i:s');
        $dat[$i]=$data;
        $colec->push($dat[$i]);
        $i++;
    

        
    }

    return datatables()
    ->of($colec)
    ->toJson();
});

Route::get('datatable6',function(){

    $ingresos=Eingreso::all();
    $colec=collect([]);
    $nombre=[];
    $i=1; 
    
    foreach ($ingresos as $ingreso ) {
        $empleado=Admin::findOrFail($ingreso->empleado_id);
        $nombre=$empleado->nombre;
        $create=$ingreso->created_at;
        $update=$ingreso->salida;
        
        $data=new Ingreso();
        $data->nombre=$nombre;
        $data->create=$create->format('Y-m-d H:i:s');
        $data->update=$update;
        $dat[$i]=$data;
        $colec->push($dat[$i]);
        $i++;

    }

    return datatables()
    ->of($colec)
    ->toJson();
});

Route::get('pasarela',function(){
    $pasarela=DB::table('tarifas')->where('tipo','=',"pasarela");

    return datatables()
    ->of($pasarela)
    ->addColumn('btn','actionborrarp')
    ->rawColumns(['btn'])
    ->toJson();
});
