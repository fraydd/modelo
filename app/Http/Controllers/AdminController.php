<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Eingreso;
use App\Models\Ingreso;
use App\Models\modelo;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:root')->only('create','index','tarifa','ingresos');

    }

    public function tarifa(){
        $anterior = Tarifa::all();
        
        
        $mes=$anterior['0']->valor;
        
        $pasarela=$anterior['1']->valor;
        
        $mes=json_encode($mes);
        $pasarela=json_encode($pasarela);
        
        
        return view('admin.tarifa')
        ->with('pasarela',$pasarela)
        ->with('mes', $mes);
    }

    public function tarifaMes(Request $request){
        

        $tarifa=$request->except('_token');


        $registro =Tarifa::findOrFail(1);
        $registro->valor=intval($request->input('tarifaMes')) ;
       
        $registro->save();

        $anterior = Tarifa::all();
        $mes=$anterior['0']->valor;
        $pasarela=$anterior['1']->valor;

        $mes=json_encode($mes);
        $pasarela=json_encode($pasarela);
        
        
        return view('admin.tarifa')
        ->with('pasarela',$pasarela)
        ->with('mes', $mes);
    }

    public function tarifaP(Request $request){
        
        $registro =Tarifa::findOrFail(2);
        $registro->valor=intval($request->input('tarifaP')) ;
        
        $registro->save();

        $anterior = Tarifa::all();
        $mes=$anterior['0']->valor;
        $pasarela=$anterior['1']->valor;

        $mes=json_encode($mes);
        $pasarela=json_encode($pasarela);
        
        
        return view('admin.tarifa')
        ->with('pasarela',$pasarela)
        ->with('mes', $mes);
        
    }

    public function index()
    {

        return view('admin.empleadoindex');
    }

    public function create()
    {
        return view('admin.empleadocreate');
    }


    public function store(Request $request)
    {
        $empleado=$request->except('_token');
  
        $guardar = new Admin($empleado);
        
        $guardar->save();
 
         return view('admin.empleadocreate');
       
    }

 
    public function show(Admin $admin)
    {

        
       return view('admin.perfile',compact('admin'));
    }

   
    public function edit(Admin $admin)
    {
        
        return view('admin.empleadoeedit',compact('admin'));
    }


    public function update(Request $request, Admin $admin)
    {
        
        $admin->nombre=$request->nombre;
        $admin->cedula=$request->cedula;
        $admin->direccion=$request->direccion;
        $admin->telefono=$request->telefono;
        $admin->ingreso=$request->ingreso;

        $admin->save();
        return view('admin.empleadoindex');
       
    }

  
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.empleadoindex');
    }

    public function borrar(Admin $admin)
    {
        
        $admin->delete();

        return view('admin.empleadoindex');
    }

    public function ingresos(){
/*     $ingresos=Ingreso::all();
    $colec=collect([]);
    $nombre=[];
    $i=1;
    foreach ($ingresos as $ingreso ) {
        $modelo=modelo::findOrFail($ingreso->modelo_id);
        $nombre=$modelo->nombre;
        $create=$ingreso->created_at;
        
        $data=new Ingreso();
        $data->nombre=$nombre;
        $data->create=$create->format('Y-m-d');
        $dat[$i]=$data;
        $colec->push($dat[$i]);
        $i++;
    

        
    }

    dd($nombre, $create,$ingresos,$colec,$data); */
    
        return view('admin.ingresos');
    }
    public function ingresose(){

/*         $ingresos=Eingreso::all();
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
            $data->create=$create->format('Y-m-d h:i:s');
            $data->update=$update;
            $dat[$i]=$data;
            $colec->push($dat[$i]);
            $i++;
    
        }
dd($colec);   */          
            
                return view('admin.ingresose');
            }
}
