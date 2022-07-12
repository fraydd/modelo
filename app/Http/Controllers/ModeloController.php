<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\modelo;
use App\Models\Tarifa;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Boolean;

use function PHPUnit\Framework\isNull;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:modelos.create')->only('create','index','borrar','tarifa');
        //$this->middleware('can:modelos')->only('index');
    }

    public function index()
    {
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
        return view('admin.Registrar');
    }

   
    public function store(Request $request)
    {
        
        $modelos=$request->except('_token');
        

        if($foto=$request->file('foto')){
            $rutaGimg='images/modelos';
            $imgP=date('YmdHis').".".$foto->getClientOriginalExtension();
            $foto->move($rutaGimg, $imgP);
            $modelos['foto']="$imgP";
        }
        $modelos['estado']=true;
        
        $guardar = new modelo($modelos);
        //$guardar->nombre= $modelos['estado'];
        $guardar->save();
        //modelo::create($modelos);
        
       

        $pdf = Pdf::loadView('pdf.pago', ['modelo'=>$modelos]);

       

        return $pdf->download('pago.pdf');
    
    }

    public function show(modelo $modelo){}
    public function edit(modelo $modelo){}
    public function update(Request $request, modelo $modelo){}
    public function renovar(modelo $modelo)
    {
        
        echo 'hola';
    }


    public function destroy(modelo $modelo){}

    public function borrar(modelo $modelo)
    {

        $modelo->delete();

        $modelos=modelo::all();
        
        return redirect('modelos')->with('modelos', $modelos);
       

        
    }

    public function tarifa(){
        $anterior = Tarifa::all();
        $mes=$anterior['0']->tarifaMes;
        $pasarela=$anterior['0']->tarifaP;

        $mes=json_encode($mes);
        $pasarela=json_encode($pasarela);
        
        
        return view('admin.tarifa')
        ->with('pasarela',$pasarela)
        ->with('mes', $mes);
    }

    public function tarifaMes(Request $request){
        

        $tarifa=$request->except('_token');


        $registro =Tarifa::findOrFail(1);
        $registro->tarifaMes=intval($request->input('tarifaMes')) ;
        $registro->save();

        $anterior = Tarifa::all();
        $mes=$anterior['0']->tarifaMes;
        $pasarela=$anterior['0']->tarifaP;

        $mes=json_encode($mes);
        $pasarela=json_encode($pasarela);
        
        
        return view('admin.tarifa')
        ->with('pasarela',$pasarela)
        ->with('mes', $mes);
    }

    public function tarifaP(Request $request){
        
        $tarifa=$request->except('_token');


        $registro =Tarifa::findOrFail(1);
        $registro->tarifaP=intval($request->input('tarifaP')) ;
        
        $registro->save();

        $anterior = Tarifa::all();
        $mes=$anterior['0']->tarifaMes;
        $pasarela=$anterior['0']->tarifaP;

        $mes=json_encode($mes);
        $pasarela=json_encode($pasarela);
        
        
        return view('admin.tarifa')
        ->with('pasarela',$pasarela)
        ->with('mes', $mes);
        
    }
}
