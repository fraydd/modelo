@extends('layouts.app')

@section('content')

<style>
.imagen{
    height: auto;
    width: auto;
    max-width: 200px;
    max-height: 200px;
    border-radius: 10%;
}

.instagram{
   color: #7e42ff; 

}

.instagram:hover {
    color: #5a2fb7;
}

.tik{
    color: #494949 ;
}
.tik:hover{
    color:black ;
}

.twi{
    color: #23c4f7;
}
.twi:hover{
    color: #1fb3e0;
}

</style>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    
                    <div class=" d-flex justify-content-center">
                    
                        
                    </div> 
                    <h3 class="d-flex justify-content-center "> <b>{{$admin->nombre}}</b></h3> 
                    <p class="d-flex justify-content-center "><b>CC:</b>{{$admin->cedula}} </p>
    

                        
                </div>

                <div class="card-body">
                    <h4>Datos personales.</h4>
                    <div class="row">
                        <div class="col d-flex justify-content-end"><p> <b>Nombre:</b> </p></div>
                        <div class="col d-flex justify-content-start"><p>{{$admin->nombre}}</p></div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end"><p> <b>Dirección:</b> </p></div>
                        <div class="col d-flex justify-content-start"><p>{{$admin->direccion}}</p></div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end"><p> <b>Teléfono:</b> </p></div>
                        <div class="col d-flex justify-content-start"><p>{{$admin->telefono}}</p></div>
                    </div>

                    <div class="row">
                        <div class="col d-flex justify-content-end"><p> <b>Fecha de contratación:</b> </p></div>
                        <div class="col d-flex justify-content-start"><p>{{$admin->ingreso}}</p></div>
                    </div>
                  
                    
                
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
