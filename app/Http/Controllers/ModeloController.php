<?php

namespace App\Http\Controllers;

use App\Models\modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:modelos.create')->only('create');
    }

    public function index()
    {
        //
    }

    
    public function create()
    {
        return view('admin.Registrar');
    }

   
    public function store(Request $request)
    {
        $modelos=$request->all();

        if($foto=$request->file('foto')){
            $rutaGimg='images/modelos';
            $imgP=date('YmdHis').".".$foto->getClientOriginalExtension();
            $foto->move($rutaGimg, $imgP);
            $modelos['foto']="$imgP";
        }
        modelo::create($modelos);
        
        return view('admin.Registrar');
    }

    public function show(modelo $modelo)
    {
        //
    }

 
    public function edit(modelo $modelo)
    {
        //
    }

  
    public function update(Request $request, modelo $modelo)
    {
        //
    }


    public function destroy(modelo $modelo)
    {
        //
    }
}
