<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\Eingreso;
use App\Models\identification;
use App\Models\modelo;
use App\Models\rh;
use App\Models\sex;
use Carbon\Carbon;
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

        //Recuperación de variables
        $Nombre=$modelo["0"]->nombre;
        $Foto=$modelo["0"]->foto;
        $id=$modelo["0"]->id;
        $Estado=$modelo["0"]->estado;

        $Fecha_pago=$modelo["0"]->fecha_pago;
        $Meses=$modelo["0"]->meses_pagados;
        $Fecha_v=$modelo["0"]->fecha_vence;

        
        // Codificacion de variables
        $estado=json_encode($Estado);
        $data= json_encode($Nombre);
        $foto= json_encode($Foto);
        $fecha_v=json_encode($Fecha_v);
        


        //Almacenando ingreso
        $ingreso = new Ingreso();
        $ingreso->modelo_id=$id;
        $ingreso->save();
       
        
        //Enviando información a la vista
        



        return redirect('empleado')
        ->with('foto', $foto)
        ->with('data', $data)
        ->with('estado',$estado)
        ->with('fecha_v',$fecha_v);
        }
    }

    public function perfil(){
        

        return view('empleado.perfilform');
    }

    public function perfilpost(Request $request ){
        $cc=$request->all();
        $id=DB::table('modelos')->where('nid','=',$cc["di"])->get()->toArray();
        if(empty($id)){
            session()->flash('error');
           return view('empleado.perfilform');
       } else{
            $modelo=modelo::find($id["0"]->id);
            

            
            $now =new Carbon( Carbon::now()->format('Y-m-d'));
            $modelo->edad=$now->diffInYears($modelo->fechan);
            $facebook=json_encode($modelo->facebook);
            $instagram=json_encode($modelo->instagram);
            $tiktok=json_encode($modelo->tiktok);
            $twitter=json_encode($modelo->twitter);
            $id=identification::find($modelo->identification_id);
            $sex=sex::find($modelo->sex_id);
            $rh=rh::find($modelo->rh_id);
        
            return view('empleado.perfil',compact('modelo','id','sex','rh'))
            ->with('instagram',$instagram)
            ->with('tiktok',$tiktok)
            ->with('twitter',$twitter)
            ->with('facebook',$facebook);
       }
        
        
    }

    public function ingreso(){

        return view('empleado.ingresoe');
    }

    public function salida(Request $request){
        /* dd($request->di); */
        $cc=$request->all();

        

        $empleado=DB::table('admins')->where('cedula','=',$cc["di"])->get()->toArray();
         if(empty($empleado)){
             session()->flash('error');
            return view('empleado.ingresoe');
        } 
        else{
            //Recuperación de variables
            $Nombre=$empleado["0"]->nombre;
            $id=$empleado["0"]->id;
            $ingreso=DB::table('eingresos')->where('empleado_id','=',$id)->get();

            
            $l=count($ingreso)-1;
            //dd($ingreso[$l]->id);
            
            /* $l=count($ingreso)-1;
            echo($ingreso[$l]); */
            $idr=$ingreso[$l]->id;
        
            
            $registro =Eingreso::findOrFail($idr);

            $current_date_time = Carbon::now()->toDateTimeString();
            
            $registro->salida=$current_date_time;
            $registro->save();
            

            // Codificacion de variables
            $nombre= json_encode($Nombre);
            
        
            
            //Enviando información a la vista
            return redirect('empleado/ingreso')
                ->with('nombre', $nombre);
        }
        
    }

    public function estore(Request $request){
        

        $cc=$request->all();
       
        //
        $empleado=DB::table('admins')->where('cedula','=',$cc["di"])->get()->toArray();
         if(empty($empleado)){
             session()->flash('error');
            return view('empleado.ingresoe');
        } 
        else{

                //Recuperación de variables
                $Nombre=$empleado["0"]->nombre;
                $id=$empleado["0"]->id;

                // Codificacion de variables
                $data= json_encode($Nombre);
                
                //Almacenando ingreso
                $ingreso = new Eingreso();
                $ingreso->empleado_id=$id;
                $ingreso->save();
            
                
                //Enviando información a la vista
                return redirect('empleado/ingreso')
                    ->with('data', $data);
            }
        return view('empleado.ingresoe');
    }
}
