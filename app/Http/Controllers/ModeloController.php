<?php

namespace App\Http\Controllers;

use App\Exports\CajasExport;
use App\Models\Adeudo;
use App\Models\Admin;
use App\Models\Caja;
use App\Models\identification;
use App\Models\medio;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\modelo;
use App\Models\rh;
use App\Models\sex;
use App\Models\Tarifa;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Hamcrest\Core\HasToString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use NumberFormatter;
use phpDocumentor\Reflection\Types\Boolean;
use App\Exports;
use Illuminate\Validation\Rules\Exists;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\isNull;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:modelos.create')->only('create','index','borrar','pasarela','caja');
        //$this->middleware('can:modelos')->only('index');
        //$this->middleware('can:root')->only('create','index','borrar','tarifa','pasarela','caja');

    }

    public function index()
    {

        $reload= new HomeController;
        $ejecutar=$reload->reload();
        
        $modelos=modelo::all();
       
       
        foreach($modelos as $modelo)
            {
                if($modelo->estado==1){
                    $modelo->estado='Activo';
                }elseif($modelo->estado==0){
                    $modelo->estado='Caducado';
                }
            
            }
        $array=$modelo->getAttributes();
        return view('admin.index');
    }

    
    public function create()
    {
        
        $sexes=sex::all();
        $identifications=identification::all();
        $rhs=rh::all();
        $medios=medio::all();
        
        return view('admin.Registrar',compact('sexes','identifications','rhs','medios'));
    }

   public function pdf(){
    $recu =modelo::all()->sortByDesc('created_at')->take(1)->toArray();
    
    $modelo=new modelo(reset($recu));
    

    $recucaja=Caja::all()->sortByDesc('created_at')->take(1)->toArray();
    
    
    // PDF
    $pdf = Pdf::loadView('pdf.pago', ['modelo'=>$modelo]);
    $pdf->render('pago.pdf');
    $pdf->stream();
   }

    public function store(Request $request)
    {
        
        
       
        $request->validate([
            'nombre'=>'required',
            'nid'=>'required|integer|between:0,10000000000',
            'expedido'=>'required',
            'fechan'=>'required|date',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required|email:rfc,dns',
            'estatura'=>'required|numeric|between:0,3',
            'busto'=>'required|integer|between:0,1000',
            'cintura'=>'required|integer|between:0,1000',
            'cadera'=>'required|integer|between:0,1000',
            'cabello'=>'required',
            'ojos'=>'required',
            'piel'=>'required',
            'pantalon'=>'required',
            'camisa'=>'required',
            'calzado'=>'required',
            'nombre_acudiente'=>'required',
            'nid_acudiente'=>'required|integer|between:0,10000000000',
            'expedido_acudiente'=>'required',
            'parentezco'=>'required',
            'direccion_acudiente'=>'required',
            'telefono_acudiente'=>'required',
            'foto'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:12000',
            'sex_id'=>'required',
            'rh_id'=>'required',
            'identification_id'=>'required',
            'meses_pagados'=>'required|integer|between:0,24',
            'fecha_pago'=>'required|date',
            'abona'=>'integer|gt:0',
            'medio_id'=>'required',
        ]);
        
        
       
        $modelo=$request->except('_token','abona','pago','medio');
        

        if($foto=$request->file('foto')){
            $rutaGimg='images/modelos';
            $imgP='images/modelos/'.date('YmdHis').".".$foto->getClientOriginalExtension();
           
            $foto->move($rutaGimg, $imgP);
            $modelo['foto']="$imgP";
        }
        $modelo['estado']=true;
        
        
        $modelo['fecha_vence']=date("Y-m-d",strtotime($request->fecha_pago."+".$request->meses_pagados."month"));
        
        if (empty($request->pago)) {
            $modelo['deuda']=0;
            $modelo = new modelo($modelo);
            $modelo->save();

            

            // Registrando en caja
            $registro =Tarifa::findOrFail(1);
            $valor=intval($modelo->meses_pagados)*$registro->valor;
            $cajero= new HomeController;
            $ejecutar=$cajero->cajero($registro->tipo, $valor, $modelo->nombre,intval($request->medio_id),$request->observaciones);

            $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
            $fechafac=$fechafac->format('Y-m-d');
            $modelo->fechafac=$fechafac;
            $valor=Tarifa::find(1)->valor;
            $tipo=Tarifa::find(1)->tipo;
            $modelo->cantidad=$modelo->meses_pagados;
            $modelo->valor=$valor;
            $modelo->tipo=$tipo;
            $modelo->total=$valor*$modelo->cantidad;
            $modelo->importe=$valor*$modelo->cantidad;

            $medio=medio::find($request->medio_id);
            $modelo->medio=$medio->medio;

            


        } else{
            $registro =Tarifa::findOrFail(1);

            $modelo['deuda']=0;
            $modelo = new modelo($modelo);
            $modelo->save();

            $adeudo=new Adeudo();
            $adeudo->tipo='Mensualidad';
            $adeudo->monto= intval( $registro->valor)*intval($modelo->meses_pagados)-intval($request->abona);
            $adeudo->modelo_id=$modelo->id;
            $adeudo->save();

            

            // Registrando en caja
            $registro =Tarifa::findOrFail(1);
            $valor=$request->abona;
            $cajero= new HomeController;
            $ejecutar=$cajero->cajero('Abono '.$registro->tipo, $valor, $modelo->nombre,intval($request->medio_id),$request->observaciones);

            $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
            $fechafac=$fechafac->format('Y-m-d');
            $modelo->fechafac=$fechafac;
            $valor=Tarifa::find(1)->valor;
            $tipo=Tarifa::find(1)->tipo;
            $modelo->cantidad=$modelo->meses_pagados;
            $modelo->valor=$valor;
            $modelo->tipo=$tipo;
            $modelo->total=$request->abona;
            $modelo->importe= $request->abona;
            $modelo->saldo=$valor*intval($modelo->meses_pagados)-$request->abona;

            $medio=medio::find($request->medio_id);
            $modelo->medio=$medio->medio;

            

        }
        $modelo->obs=$request->observaciones;
        $pdf = Pdf::loadView('pdf.pago', ['modelo'=>$modelo]);
        return $pdf->stream("Sus_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$fechafac).".pdf", array("Attachment" => false));

        //return $pdf->download('pago.pdf');
        
        
        //return view('admin.descarga');

        
    
    }

    public function show(modelo $modelo){

        $now =new Carbon( Carbon::now()->format('Y-m-d'));
        $modelo->edad=$now->diffInYears($modelo->fechan);
        $facebook=json_encode($modelo->facebook);
        $instagram=json_encode($modelo->instagram);
        $tiktok=json_encode($modelo->tiktok);
        $twitter=json_encode($modelo->twitter);
        $id=identification::find($modelo->identification_id);
        $sex=sex::find($modelo->sex_id);
        $rh=rh::find($modelo->rh_id);

        $deuda=$modelo->deuda;
        if (!empty($deuda)) {
            session()->flash('deuda');
            

        }
        
            


       
        return view('empleado.perfil',compact('modelo','id','sex','rh'))
        ->with('instagram',$instagram)
        ->with('tiktok',$tiktok)
        ->with('twitter',$twitter)
        
        ->with('facebook',$facebook);
    }
    public function edit(modelo $modelo){
        
        $sexes=sex::all();
        $identifications=identification::all();
        $rhs=rh::all();

        $identificacion=identification::find($modelo->identification_id);
        $sex=sex::find($modelo->sex_id);
        $rh=rh::find($modelo->rh_id);


        
        
        return view('admin.edit',compact('sexes','identifications','rhs','modelo','identificacion','sex','rh'));
    }
    public function update(Request $request, modelo $modelo){
        
        $request->validate([
            'nombre'=>'required',
            'nid'=>'required|integer|between:0,10000000000',
            'expedido'=>'required',
            'fechan'=>'required|date',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
            'estatura'=>'required|numeric|between:0,3',
            'busto'=>'required|integer|between:0,1000',
            'cintura'=>'required|integer|between:0,1000',
            'cadera'=>'required|integer|between:0,1000',
            'cabello'=>'required',
            'ojos'=>'required',
            'piel'=>'required',
            'pantalon'=>'required',
            'camisa'=>'required',
            'calzado'=>'required',
            'nombre_acudiente'=>'required',
            'nid_acudiente'=>'required',
            'expedido_acudiente'=>'required',
            'parentezco'=>'required',
            'direccion_acudiente'=>'required',
            'telefono_acudiente'=>'required',
            'foto'=>'image|mimes:jpeg,png,jpg,gif,svg|max:12000'

            
        ]);
        

        if (!empty( $request->file('foto'))) {
                unlink($modelo->foto);
                if($foto=$request->file('foto')){
                $rutaGimg='images/modelos';
                $imgP='images/modelos/'.date('YmdHis').".".$foto->getClientOriginalExtension();
                $foto->move($rutaGimg, $imgP);
                $request->foto="$imgP";
                $modelo->foto=$request->foto;
            }
        }
        

    

        $modelo->nombre=$request->nombre;
        $modelo->nid=$request->nid;
        
        $modelo->expedido=$request->expedido;
        $modelo->fechan=$request->fechan;
        $modelo->direccion=$request->direccion;
        $modelo->telefono=$request->telefono;
        $modelo->correo=$request->correo;
        $modelo->estatura=$request->estatura;
        $modelo->busto=$request->busto;
        $modelo->cintura=$request->cintura;
        $modelo->cadera=$request->cadera;
        $modelo->cabello=$request->cabello;
        $modelo->ojos=$request->ojos;
        $modelo->piel=$request->piel;
        $modelo->pantalon=$request->pantalon;
        $modelo->camisa=$request->camisa;
        $modelo->calzado=$request->calzado;
        $modelo->facebook=$request->facebook;
        $modelo->instagram=$request->instagram;
        $modelo->twitter=$request->twitter;
        $modelo->tiktok=$request->tiktok;
        $modelo->otro=$request->otro;
        $modelo->nombre_acudiente=$request->nombre_acudiente;
        $modelo->nid_acudiente=$request->nid_acudiente;
        $modelo->direccion_acudiente=$request->direccion_acudiente;
        $modelo->expedido_acudiente=$request->expedido_acudiente;
        $modelo->parentezco=$request->parentezco;
        $modelo->telefono_acudiente=$request->telefono_acudiente;
        $modelo->sex_id =$request->sex_id;
        $modelo->identification_id=$request->identification_id;
        $modelo->rh_id =$request->rh_id ;
       
        $modelo->save();
        return view('admin.index');
    }

    public function renovar(modelo $modelo)
    {
        $tarifa =Tarifa::findOrFail(1);
        $valor=$tarifa->valor;
        $nombre=$modelo->nombre;
        $id=$modelo->id;
        $vence=$modelo->fecha_vence;
        $medios=medio::all();
       
        return view('admin.renovar',compact('medios'))->with('nombre', $nombre)->with('id',$id)->with('vence',$vence)->with('valor',$valor);
    }

    public function renovarpost(Request $request , modelo $modelo){


        
        
        $now =new Carbon( Carbon::now()->format('Y-m-d'));
        $inicio=new Carbon($modelo->fecha_pago);
        $inicion=new Carbon($request->fecha_pago);
        
        $vence=new Carbon($modelo->fecha_vence);
        $mes=intval( $request->meses_pagados);
        $modelo->meses_pagados=$mes; 

       



        
        if($now->lte($vence)&& $inicion->lte($vence)){
            $diff = $vence->diffInDays($now);
            $modelo->fecha_pago=date_format($now,"Y-m-d");
            $vmm=date("Y-m-d",strtotime($now."+".$mes."month"));
            $vmm2=date("Y-m-d",strtotime($vmm."+".$diff."day"));
            
            $modelo->fecha_vence=$vmm2;
             
            $modelo->save();
           
            //dd($inicio,$inicion, $now,$vence,$vencen,$mes,$diff,$modelo);
        }elseif($now->gt($vence)&& $inicion->lte($vence)){
            $modelo->fecha_pago=date_format($inicion,"Y-m-d");
            $vmm=date("Y-m-d",strtotime($inicion."+".$mes."month"));

            $diff = $vence->diffInDays($inicion);
            $vmm2=date("Y-m-d",strtotime($vmm."+".$diff."day"));
            
            $modelo->fecha_vence=$vmm2;
            $modelo->save();
          
            
        }elseif($now->lte($vence)&& $inicion->gt($vence)){
            $diff = $inicion->diffInDays($now);
            $modelo->fecha_pago=date_format($now,"Y-m-d");
            $vmm=date("Y-m-d",strtotime($inicion."+".$mes."month"));
            $vmm2=date("Y-m-d",strtotime($vmm."+".$diff."day"));
            $modelo->fecha_vence=$vmm;
            
            $modelo->save();
           
            

        }else{
            $modelo->fecha_pago=date_format($inicion,"Y-m-d");
            $vmm=date("Y-m-d",strtotime($inicion."+".$mes."month"));
            $modelo->fecha_vence=$vmm;
            
            $modelo->save();
           
        }

        // Registrando en caja
        
        if(empty($request->pago)){
            $tarifa =Tarifa::findOrFail(1);
            
            $valor=intval($mes)*$tarifa->valor;
            
            $cajero= new HomeController;
            $ejecutar=$cajero->cajero($tarifa->tipo, $valor,$modelo->nombre,intval($request->medio_id),$request->observaciones);

            $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
            $fechafac=$fechafac->format('Y-m-d');
            $modelo->fechafac=$fechafac;
            $valor=Tarifa::find(1)->valor;
            $tipo=Tarifa::find(1)->tipo;
            $modelo->cantidad=$mes;
            $modelo->valor=$valor;
            $modelo->tipo=$tipo;
            $modelo->total=$valor*$mes;
            $modelo->importe=$valor*$mes;

            $medio=medio::find($request->medio_id);
            $modelo->medio=$medio->medio;

            
           
            

        }else{
            
            $tarifa =Tarifa::findOrFail(1);
            $valor=$request->abona;
            $cajero= new HomeController;
            $ejecutar=$cajero->cajero('Abono '.$tarifa->tipo, $valor,$modelo->nombre,intval($request->medio_id),$request->observaciones);

            $adeudo=new Adeudo();
            $adeudo->tipo='Mensualidad';
            $adeudo->monto= intval( $tarifa->valor)*$mes-intval($request->abona);
            $adeudo->modelo_id=$modelo->id;
            $adeudo->save();



            $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
            $fechafac=$fechafac->format('Y-m-d');
            $modelo->fechafac=$fechafac;
            $valor=Tarifa::find(1)->valor;
            $tipo=Tarifa::find(1)->tipo;

            $modelo->cantidad=$mes;
            $modelo->valor=$valor;
            $modelo->tipo=$tipo;
            $modelo->total=$request->abona;
            $modelo->importe=$request->abona;
            $modelo->saldo=$valor*$mes-$request->abona;
            $medio=medio::find($request->medio_id);
            $modelo->medio=$medio->medio;
        }

        



        $modelo->obs=$request->observaciones;
        $pdf = Pdf::loadView('pdf.pago', ['modelo'=>$modelo]);
        return $pdf->stream("Men_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$fechafac).".pdf", array("Attachment" => false));
        
        
    }

    

    public function destroy(modelo $modelo){}

    public function borrar(modelo $modelo)
    {
        if (file_exists($modelo->foto)) {
            unlink($modelo->foto);
            
        }
        $modelo->delete();
        

        $modelos=modelo::all();
        
        return redirect('modelos')->with('modelos', $modelos);
       

        
    }


    public function caja(){
        $medios=medio::all();
        
        return view('admin.caja',compact('medios'));
    }

    public function cajapost(Request $request){
        
        $modelo=new modelo();
        $modelo->nombre=$request->paga;
        $modelo->correo=$request->paga;
       
         // Registrando en caja
         $cajero= new HomeController;
         

         $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
         $fechafac=$fechafac->format('Y-m-d');
         $modelo->fechafac=$fechafac;
         $valor=$request->valor;
         $tipo=$request->concepto;
         $modelo->cantidad=1;
         $modelo->valor=$valor;
         $modelo->tipo=$tipo;
         $modelo->total=$valor;
         $modelo->importe=$valor;
         $modelo->obs=$request->observaciones;

         $ejecutar=$cajero->cajero($request->concepto,intval($request->valor), $request->paga, intval( $request->medio_id),$request->observaciones);
         $medio=medio::find($request->medio_id);
         $modelo->medio=$medio->medio;
         
         
 
         // PDF
         $pdf = Pdf::loadView('pdf.pago', ['modelo'=>$modelo]);
         //return $pdf->download('pago.pdf');

         
        return $pdf->stream("Ingreso_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$fechafac).".pdf", array("Attachment" => false));


        
    }
    public function cajapostegreso(Request $request){
        
        $caja['observaciones']=$request->observaciones;
        $caja['estado']=0;
        $caja['concepto']=$request->concepto;
        $caja['valor']=$request->valor;
        $caja['paga']=Auth::user()->name;
        $caja['recibe']=$request->paga;
        $caja['medio_id']=intval( $request->medio_id);

        
        
        $modelo=new modelo();
        $modelo->retira=Auth::user()->name;
        $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
         $fechafac=$fechafac->format('Y-m-d');
         $modelo->fechafac=$fechafac;
         $modelo->cantidad=1;
         $modelo->valor=$request->valor;
         $modelo->tipo=$request->concepto;
         $modelo->total=$modelo->valor;
         $modelo->importe=$modelo->valor;
         $modelo->paga=$request->paga;
         $modelo->obs=$request->observaciones;

        $medio=medio::find( intval( $request->medio_id));
         $modelo->medio=$medio->medio;

        
        
        $caja=new Caja($caja);
        $caja->save();

        $pdf = Pdf::loadView('pdf.retiro', ['modelo'=>$modelo]);
        //return $pdf->download('pago.pdf');

        
       return $pdf->stream("Retiro_".str_replace(" ","",ucwords($modelo->retira))."_".str_replace("-","",$fechafac).".pdf", array("Attachment" => false));


        
    }

    public function cierreCaja(Request $request){
        $inicio=new Carbon($request->inicio);
        //$inicio=$inicio->format('Y-m-d');
        $fin=new Carbon($request->fin);
        //$fin=$fin->format('Y-m-d');

        if ($request->ingresos=='on') {
            $cajas=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',1)->select(['paga','recibe','concepto','medio_id'])->get();
            $valor=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',1)->select(['valor'])->get();
            $fecha=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',1)->select(['created_at'])->get();

          

        }elseif($request->egresos=='on'){
            $cajas=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',0)->select(['paga','recibe','concepto','medio_id'])->get();
            $valor=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',0)->select(['valor'])->get();
            $fecha=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',0)->select(['created_at'])->get();


        }
        $i=0;
        foreach ($cajas as $caja ) {
            $caja->valor=$valor[$i]->valor;
            $caja->fecha=$fecha[$i]->created_at->format('Y-m-d h:i:s');
            $i++;
            if($caja->medio_id==1){
                $caja->medio_id='Efectivo';
            }elseif($caja->medio_id==2){
                $caja->medio_id='Transferencia';
            }else{
                $caja->medio_id='NA';
            }
        }
        
        $headings=["PAGA","RECIBE","CONCEPTO","MEDIO DE PAGO","VALOR","FECHA Y HORA"];

        $now =Carbon::now()->format('Y-m-d');
        
        return Excel::download(new CajasExport($cajas,$headings),str_replace( " ","",'Cierre'.$now.'.xlsx'));
        
    }

    public function cierreCajaPdf(Request $request){
        $inicio=new Carbon($request->inicio);
        $ini=$inicio->format('Y/m/d');
        $fin=new Carbon($request->fin);
        $fi=$fin->format('Y/m/d');
        $rango=$ini.' - '.$fi;

        if ($request->ingresos=='on') {
            $estado='ingresos';

            $cajas=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',1)->select(['paga','recibe','concepto','medio_id'])->get();
            $valor=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',1)->select(['valor'])->get();
            $fecha=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',1)->select(['created_at'])->get();

          

        }elseif($request->egresos=='on'){
            $cajas=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',0)->select(['paga','recibe','concepto','medio_id'])->get();
            $valor=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',0)->select(['valor'])->get();
            $fecha=Caja::whereBetween('created_at', [$inicio, $fin])->where('estado',0)->select(['created_at'])->get();
            $estado='egresos';


        }
        $i=0;
        $suma=0;
        setlocale(LC_MONETARY,"es_CO");
        foreach ($cajas as $caja ) {
            $aux=$valor[$i]->valor+$suma;
            $suma=$aux;
            $caja->valor='$ '.number_format( $valor[$i]->valor);
            $caja->fecha=$fecha[$i]->created_at->format('Y-m-d h:i:s');
            $i++;
            if($caja->medio_id==1){
                $caja->medio_id='Efectivo';
            }elseif($caja->medio_id==2){
                $caja->medio_id='Transferencia';
            }else{
                $caja->medio_id='NA';
            }
        }
        $suma='$ '.number_format($suma);
        $now =Carbon::now()->format('Y-m-d');

        
        $pdf = Pdf::loadView('pdf.cierrepdf', compact('cajas','now','suma','estado','rango'));
        return $pdf->download(str_replace(" ","","cierre_".$now.".pdf"));
        
    }


    public function estadisticas(){
        $usuarios=modelo::all();

        $now =new Carbon( Carbon::now()->format('Y-m-d'));
        

        $data=[];
        $yedad=[0,0,0,0,0,0];
        $yestatura=[0,0,0,0,0,0,0,0];
        $rangoses=['<0.8', '0.8 - 1','1 - 1.2','1.2 - 1.4','1.4 - 1.6', '1.6 - 1.8', '1.8 - 2', '>2'];
        $rangos=['0-5','6-11', '12-18', '19-26','27-59','>60'];
        
        
        foreach ($usuarios as $usuario){
            $data['edad'][]=$now->diffInYears($usuario->fechan);;
            $data['estatura'][]=$usuario->estatura;
            $data['sexo'][]=$usuario->sex_id;
            $data['busto'][]=$usuario->busto;
            $data['cintura'][]=$usuario->cintura;
            $data['cadera'][]=$usuario->cadera;
        }
        
        $promedio=round(array_sum( $data['edad'])/count($data['edad']),2);
        $promb=round(array_sum( $data['busto'])/count($data['busto']),2);
        $promci=round(array_sum( $data['cintura'])/count($data['cintura']),2);
        $promca=round(array_sum( $data['cadera'])/count($data['cadera']),2);
       
        for ($i=0;$i<count($data['estatura']); $i++){
            if($data['estatura'][$i]>=0 && $data['estatura'][$i]<=0.8){
                $yestatura[0]++;
            }
             if($data['estatura'][$i]>0.8 && $data['estatura'][$i]<=1){
                $yestatura[1]++;
            }
             if($data['estatura'][$i]>1 && $data['estatura'][$i]<=1.2){
                $yestatura[2]++;
            }
             if($data['estatura'][$i]>1.2 && $data['estatura'][$i]<=1.4){
                $yestatura[3]++;
            }
             if($data['estatura'][$i]>1.4 && $data['estatura'][$i]<=1.6){
                $yestatura[4]++;
            }
            if($data['estatura'][$i]>1.6 && $data['estatura'][$i]<=1.8){
                $yestatura[5]++;
            }
            if($data['estatura'][$i]>1.8 && $data['estatura'][$i]<=2){
                $yestatura[6]++;
            }
             if($data['estatura'][$i]>2 ){
                $yestatura[7]++;
            }
        }
        

        for ($i=0;$i<count($data['edad']); $i++){
            if($data['edad'][$i]>=0 && $data['edad'][$i]<=5){
                $yedad[0]++;
            }
             if($data['edad'][$i]>5 && $data['edad'][$i]<=11){
                $yedad[1]++;
            }
             if($data['edad'][$i]>11 && $data['edad'][$i]<=18){
                $yedad[2]++;
            }
             if($data['edad'][$i]>18 && $data['edad'][$i]<=26){
                $yedad[3]++;
            }
             if($data['edad'][$i]>26 && $data['edad'][$i]<=59){
                $yedad[4]++;
            }
             if($data['edad'][$i]>60 ){
                $yedad[5]++;
            }
        }
        
        

        $longitud = count($yedad);
        for ($i = 0; $i < $longitud; $i++) {
            for ($j = 0; $j < $longitud - 1; $j++) {
                if ($yedad[$j] < $yedad[$j + 1]) {
                    $temporal = $yedad[$j];
                    $temporal2 = $rangos[$j];
                    $yedad[$j] = $yedad[$j + 1];
                    $rangos[$j] = $rangos[$j + 1];
                    $yedad[$j + 1] = $temporal;
                    $rangos[$j + 1] = $temporal2;
                }
            }
        }

        $longitud = count($yestatura);
        for ($i = 0; $i < $longitud; $i++) {
            for ($j = 0; $j < $longitud - 1; $j++) {
                if ($yestatura[$j] < $yestatura[$j + 1]) {
                    $temporal = $yestatura[$j];
                    $temporal2 = $rangoses[$j];
                    $yestatura[$j] = $yestatura[$j + 1];
                    $rangoses[$j] = $rangoses[$j + 1];
                    $yestatura[$j + 1] = $temporal;
                    $rangoses[$j + 1] = $temporal2;
                }
            }
        }

        
        $cajas=caja::all();
        $valor=[];
        
        foreach ($cajas as $caja ) {
            $data['fecha'][]=substr( $caja->created_at->toDateString(),0,-3);
            

        }
        
        $fechas=array_values(array_unique($data['fecha']));
        
        for ($i=0; $i < count($fechas); $i++) {
             $mes=intval( substr($fechas[$i],5));
             $anio=intval( substr($fechas[$i],0,4));
             
            $fil = caja::whereYear('created_at', '=', $anio)->whereMonth('created_at', '=', $mes)->get();
            $valori[$i]=0;
            $valoro[$i]=0;

            foreach ($fil as $fi ) {
                if ($fi->estado==1) {
                    
                    $aux=$fi->valor;
                    $valori[$i]=$valori[$i]+$aux;
                    
                }
                if ($fi->estado==0) {
                    
                    $aux=$fi->valor;
                    $valoro[$i]=$valoro[$i]+$aux;
                }
                
            }


            /*if ($fil->estado==1) {
                $valori[$i]=0;
                foreach ($fil as $fi ) {
                    $aux=$fi->valor;
                    $valori[$i]=$valori[$i]+$aux;
                    
                } 
            } 
            */

           
            
            
            
           
           
        }
       

        $data['fecha']=$fechas;
        $data['valori']=$valori;
        $data['valoro']=$valoro;
        
        
        $empleados=Admin::all();
        $nempleados=$empleados->count();
        $nregistros=count($data['edad']);
        
        
        
        $data['edad']=$yedad;
        $data['rangos']=$rangos;
        $data['estatura']=$yestatura;
        $data['rangoses']=$rangoses;
        $data['sexo']=array_count_values($data['sexo']);
        $data['data']=json_encode($data);
        //$data['rangos']=json_encode($rangos);

        return view('admin.estadisticas',$data)->with('nregistros',$nregistros)
        ->with('nempleados',$nempleados)
        ->with('promb',$promb)
        ->with('promci',$promci)
        ->with('promca',$promca)
        ->with('promedio',$promedio);
    }
    public function pasarela(){

        
        $medios=medio::all();

        $adeudos=Adeudo::all();
        $tipo='pasarela';
        $pasarelas=Tarifa::all();
        $pasar=Tarifa::all();
        $pasarelas = $pasarelas->filter(function ($item) {
            if ($item->tipo == 'pasarela') {
                return $item;
            }
        });
        
        
        foreach ($pasarelas as $pasarela ) {
            $pasarela->valor=number_format($pasarela->valor,0,".");
        }
            
        

       
    
        
        
        return view('admin.pasarela',compact('pasarelas','medios'))
        ->with('adeudos',$adeudos)
        ->with('pasar',$pasar);

    }
    public function pasarelaput(Request $request , modelo $modelo){
        
        
        $consepto =Tarifa::findOrFail($request->pasarela);

        /* Datos generales para pdf */
        $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
        $modelo->fechafac=$fechafac->format('Y-m-d');
        $modelo->valor=Tarifa::find($request->pasarela)->valor;
        $modelo->cantidad=1;

        $medio=medio::find($request->medio_id);
        $modelo->medio=$medio->medio;


        if (empty($request->pago2)) {
            /* paga todo */
            
            
            $cajero= new HomeController;
            $ejecutar=$cajero->cajero($consepto->tipo.' '.$consepto->nombre, $consepto->valor,$modelo->nombre,intval($request->medio_id),$request->observaciones);
            
            /* Datos particulares para pdf */
            $modelo->tipo=Tarifa::find($request->pasarela)->tipo.' '.Tarifa::find($request->pasarela)->nombre;
            $modelo->total=$modelo->valor;
            $modelo->importe=$modelo->valor;

            // PDF
            $modelo->saldo=0;

            if (empty($request->medio2)) {
                $modelo->medio="Transferencia";
            } else{
                $modelo->medio="Efectivo";
                
            }
            $modelo->obs=$request->observaciones;

            $pdf = Pdf::loadView('pdf.pago', compact('modelo'));
            return $pdf->stream("Pas_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$modelo->fechafac).".pdf", array("Attachment" => false));


        }else{
            /* Abona */

            $adeudo=new Adeudo();
            $adeudo->tipo=$consepto->tipo.' '.$consepto->nombre;
            $adeudo->monto= intval( $consepto->valor)-intval($request->abona2);
            $adeudo->modelo_id=$modelo->id;
            $adeudo->save();

            // Registrando en caja
            $cajero= new HomeController;
            $a=$consepto->tipo.' '.$consepto->nombre;
            $ejecutar=$cajero->cajero('Abono inicial '.$a,$request->abona2,$modelo->nombre,intval($request->medio_id),$request->observaciones);

            /* Datos particulares para pdf */
            $modelo->tipo='Abono '.Tarifa::find($request->pasarela)->tipo.' '.Tarifa::find($request->pasarela)->nombre;
            $modelo->total=$request->abona2;
            $modelo->importe=$request->abona2;

            // PDF
            $modelo->saldo=$modelo->valor-$request->abona2;
            
       
            $modelo->obs=$request->observaciones;
            $pdf = Pdf::loadView('pdf.pago', compact('modelo'));
            return $pdf->stream("Pas_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$modelo->fechafac).".pdf", array("Attachment" => false));

           
        }

    }
    public function uniformeput(Request $request , modelo $modelo){

        /* Datos generales para pdf */
        
        $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
        $modelo->fechafac=$fechafac->format('Y-m-d');
        $modelo->valor=$request->precio;
        $modelo->cantidad=1;

        $medio=medio::find($request->medio_id);
        $modelo->medio=$medio->medio;
        

        if (empty($request->pago)) {
            /* paga todo */
            $cajero= new HomeController;
            
            $ejecutar=$cajero->cajero($request->tipo,$request->precio,$modelo->nombre,intval($request->medio_id),$request->observacionesu);

            /* Datos particulares para pdf */
            $modelo->tipo=$request->tipo;
            $modelo->total=$modelo->valor;
            $modelo->importe=$modelo->valor;

            // PDF
            $modelo->saldo=0;

            
            $modelo->obs=$request->observacionesu;

            $pdf = Pdf::loadView('pdf.pago', compact('modelo'));
            return $pdf->stream("Uni_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$modelo->fechafac).".pdf", array("Attachment" => false));

        }else{
            $adeudo=new Adeudo();
            $adeudo->tipo=$request->tipo;
            $adeudo->monto= intval( $request->precio)-intval($request->abona);
            $adeudo->modelo_id=$modelo->id;
            $adeudo->save();

            // Registrando en caja
            $cajero= new HomeController;
            $a=$request->tipo;
            $ejecutar=$cajero->cajero('Abono inicial '.$a,$request->abona,$modelo->nombre,intval($request->medio_id),$request->observacionesu);

            /* Datos particulares para pdf */
            $modelo->tipo='Abono '.$request->tipo;
            $modelo->total=$request->abona;
            $modelo->importe=$request->abona;

            // PDF
            $modelo->saldo=$modelo->valor-$request->abona;
            
            $modelo->obs=$request->observacionesu;
            $pdf = Pdf::loadView('pdf.pago', ['modelo'=>$modelo]);
            return $pdf->stream("Uni_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$modelo->fechafac).".pdf", array("Attachment" => false));

           
        }

       
        
        
    }
    public function delad(Request $request ,Adeudo $adeudo){
        
        if ($adeudo->delete()) {

            $modelo=modelo::findOrFail($adeudo->modelo_id);

            /* Datos generales para pdf */
        
            $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
            $modelo->fechafac=$fechafac->format('Y-m-d');
            $modelo->valor='NA';
            $modelo->cantidad=1;

            $cajero= new HomeController;
            $ejecutar=$cajero->cajero('Abono '.$adeudo->tipo, $adeudo->monto,$modelo->nombre, intval($request->medio_id), $request->observaciones_salda);

            /* Datos particulares para pdf */
            $modelo->tipo='Abono '.$adeudo->tipo;
            $modelo->total=$adeudo->monto;
            $modelo->importe=$adeudo->monto;
            $medio=medio::find($request->medio_id);
            $modelo->medio=$medio->medio;

            // PDF
            $modelo->saldo=0;
            

            session()->flash('borrado');

        }
        $modelo->obs=$request->observaciones_salda;
        $pdf = Pdf::loadView('pdf.pago', compact('modelo'));
        return $pdf->download("Borrar_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$modelo->fechafac).".pdf");

    }

    

    public function editad(Request $request ,Adeudo $adeudo){
        

        
        $modelo=modelo::findOrFail($adeudo->modelo_id);
        
         // Registrando en caja
         $cajero= new HomeController;
         
         $ejecutar=$cajero->cajero('Abono '.$adeudo->tipo,$request->editarad,$modelo->nombre,intval($request->medio_id), $request->observaciones_abona);
        

        /* Datos generales para pdf */
        
        $fechafac=new Carbon( Carbon::now()->format('Y-m-d'));
        $modelo->fechafac=$fechafac->format('Y-m-d');
        $modelo->valor='NA';
        $modelo->cantidad=1;

         /* Datos particulares para pdf */
         $modelo->tipo='Abono '.$adeudo->tipo;
         $modelo->total=$request->editarad;
         $modelo->importe=$request->editarad;


         // PDF
         $modelo->saldo=$adeudo->monto-$request->editarad;

         $adeudo->monto=$adeudo->monto-$request->editarad;
        $adeudo->save();

        
        $medio=medio::find($request->medio_id);
            $modelo->medio=$medio->medio;
        $modelo->obs= $request->observaciones_abona;
        $pdf = Pdf::loadView('pdf.pago', compact('modelo'));
        return $pdf->stream("Abo_".str_replace(" ","",ucwords($adeudo->tipo))."_".str_replace(" ","",ucwords($modelo->nombre))."_".str_replace("-","",$modelo->fechafac).".pdf", array("Attachment" => false));


    }
}
