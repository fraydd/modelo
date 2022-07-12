<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:modelos.create')->only('create','index');

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
        
        $a=array('nombre'=>$admin->nombre);
        echo "perfil de {$a['nombre']}";
    }

   
    public function edit(Admin $admin)
    {
        $a=array('nombre'=>$admin->nombre);
        echo "editar {$a['nombre']}";
    }


    public function update(Request $request, Admin $admin)
    {
        //
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
}
