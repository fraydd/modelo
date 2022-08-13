<?php

namespace App\Http\Controllers;

use App\Models\modelo;
use App\Models\Caja;
use App\Models\Tarifa;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      
        $modelos=modelo::all();
        $i=0;
        foreach ($modelos as $modelo ) {
            
            $fotos[$i]=$modelo->foto;
            $i++;
        }
        $data['fotos']=$fotos;
        $data=json_encode($data);
        //dd($data);

       $reload= new HomeController;
       $ejecutar=$reload->reload();
        return view('home')->with('data',$data);
    }
    public function reload(){
        
         
        $now =new Carbon( Carbon::now()->format('Y-m-d'));
        
        $modelos=modelo::all();

        

        foreach($modelos as $modelo){
            $pago=new Carbon($modelo->fecha_pago);
            
            $Fecha_v=$modelo->fecha_vence;
            $Fecha_v= new Carbon($Fecha_v);
            //dd($pago, $Fecha_v, $now,$now->gte($pago), $now->lte($Fecha_v));
            if($now->gte($pago) && $now->lte($Fecha_v)){
                $modelo->estado=1;
                $modelo->save();
            }else{
                $modelo->estado=0;
                $modelo->save();
            } 
        }

    }

    public function cajero( $concepto,  $valor,  $paga ){
        $caja['estado']=1;
        $caja['concepto']=$concepto;
        $caja['valor']=$valor;
        $caja['paga']=$paga;
        $caja['recibe']=Auth::user()->name;
        
        $caja=new Caja($caja);
        $caja->save();
        
    }

  
    
}
