@extends('layouts.app')

@section('content')
<style>
    .imagen{
        height: auto;
        width: auto;
        max-width: 300px;
        max-height: 300px;
        border-radius: 5% ;
        overflow: hidden;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Registro de turnos de empleados.</h5>
                </div>

                <div class="card-body">
                    <p>Ingreso</p>
                    <form  action="{{ url('/empleado/ingreso')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ingrese su clave: </span>
                            <input placeholder=" " type="text" class="form-control" name="di" id="di" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <input type="submit" class="btn btn-outline-secondary" id="button-addon2">
                        </div>
                    </form>
                </div>
            </div>
            <br>

            <div class="card">
                <div class="card-body">
                    <p>Salida</p>
                    <form action="{{ url('/empleado/salida')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                        <br>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ingrese su clave: </span>
                            <input placeholder=" " type="text" class="form-control" name="di" id="di" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <input type="submit" class="btn btn-outline-secondary" id="button-addon2">
                        </div>
                    </form>
                </div>
                
            </div>


                @if (session('error'))
                    <br>
                    <div class="des">
                        <div class=" alert alert-danger" role="alert">
                        
                            Empleado no encontrado!
                        </div>
                    </div>
                    <script>
                        $(document).ready(function(){
                            setTimeout(function(){
                                $(".des").fadeOut(100);
                            },2000);  
                        })
                    </script>
                @endif
            

                @if(session('data'))
                    <br>
                    <div class="des card" id="fondo">
                        <div class=" card-body">
                            <h3>Bienvenido {{$data=json_decode(session('data'))}}!</h3><br>
                            <p style="color:darkgreen" >Ingreso registrado sarisfactoriamente</p>
                            <br>
                        </div>
                    </div>
                        <script>
                            $(document).ready(function(){
                                var fondo = document.getElementById('fondo');
                                    fondo.style.backgroundColor = '#d4edda';

                                setTimeout(function(){
                                
                                    $(".des").fadeOut(100);
                                },3000);  
                            }) 
                        </script>
                @endif

                @if(session('nombre'))
                    <br>
                    <div class="des card" id="fondo">
                        <div class=" card-body">
                            <h3>Hasta pronto {{$nombre=json_decode(session('nombre'))}}!</h3><br>
                            <p style="color:darkgreen" >Salida registrada sarisfactoriamente</p>
                            <br>
                        </div>
                    </div>
                        <script>
                            $(document).ready(function(){
                                var fondo = document.getElementById('fondo');
                                    fondo.style.backgroundColor = '#d4edda';

                                setTimeout(function(){
                                
                                    $(".des").fadeOut(100);
                                },3000);  
                            }) 
                        </script>

                @endif
        </div>
    </div>
</div>
@endsection
