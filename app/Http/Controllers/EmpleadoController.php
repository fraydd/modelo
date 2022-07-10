<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Models\modelo;
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
        $Fecha_v=date("Y-m-d",strtotime($Fecha_pago."+".$Meses."month"));

        
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
        return view('empleado.perfil');
    }
}
