<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\modelo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Session;

class EmpleadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:empleado.index')->only('index','store');
        $this->middleware('can:empleado.index')->only('perfil');
        
    }
    public function index()
    {
        return view('empleado.ingreso');
    }

    public function store(Request $request)
    {
        $cc=$request->all();
       

        //
        $modelo=DB::table('modelos')->where('nid','=',$cc["di"])->get()->toArray();
         if(empty($modelo)){
             session()->flash('error');
            return view('empleado.ingreso');
        } else{

        $nombreModelo=$modelo["0"]->nombre;
        $fotoModelo=$modelo["0"]->foto;
        $array=array('nombre'=>$nombreModelo,
                    'foto'=>$fotoModelo);

        $Nombre=$modelo["0"]->nombre;
        $Foto=$modelo["0"]->foto;
        $id=$modelo["0"]->id;
        
        
        $data= json_encode($Nombre);
        $foto= json_encode($Foto);
        
        $ingreso = new Ingreso();
        $ingreso->modelo_id=$id;
        
        $ingreso->save();
        //Ingreso::create($ingreso);
        
        return redirect('empleado')->with('data', $data)->with('foto', $foto);
        }
    }

    public function perfil(){
        return view('empleado.perfil');
    }
}
