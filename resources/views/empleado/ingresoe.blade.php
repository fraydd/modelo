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
            </div>
            
                <div class="alert alert-warning" role="alert">
                <svg  width="32px" height="32px" viewBox="0 0 16 16">
                    <g id="surface1">
                    <path style=" stroke:none;fill-rule:nonzero;fill:#7f4713;fill-opacity:1;" d="M 8.015625 8.148438 Z M 1.535156 14 C 1.34375 14 1.199219 13.917969 1.101562 13.75 C 1 13.582031 1 13.417969 1.101562 13.25 L 7.566406 2.082031 C 7.667969 1.917969 7.8125 1.832031 8 1.832031 C 8.1875 1.832031 8.332031 1.917969 8.433594 2.082031 L 14.898438 13.25 C 15 13.417969 15 13.582031 14.898438 13.75 C 14.800781 13.917969 14.65625 14 14.464844 14 Z M 8.066406 6.464844 C 7.921875 6.464844 7.804688 6.515625 7.707031 6.609375 C 7.613281 6.703125 7.566406 6.820312 7.566406 6.964844 L 7.566406 9.699219 C 7.566406 9.84375 7.613281 9.964844 7.707031 10.058594 C 7.804688 10.152344 7.921875 10.199219 8.066406 10.199219 C 8.210938 10.199219 8.332031 10.152344 8.425781 10.058594 C 8.519531 9.964844 8.566406 9.84375 8.566406 9.699219 L 8.566406 6.964844 C 8.566406 6.820312 8.519531 6.703125 8.425781 6.609375 C 8.332031 6.515625 8.210938 6.464844 8.066406 6.464844 Z M 8.066406 12.050781 C 8.210938 12.050781 8.332031 12.003906 8.425781 11.910156 C 8.519531 11.8125 8.566406 11.695312 8.566406 11.550781 C 8.566406 11.40625 8.519531 11.285156 8.425781 11.191406 C 8.332031 11.097656 8.210938 11.050781 8.066406 11.050781 C 7.921875 11.050781 7.804688 11.097656 7.707031 11.191406 C 7.613281 11.285156 7.566406 11.40625 7.566406 11.550781 C 7.566406 11.695312 7.613281 11.8125 7.707031 11.910156 C 7.804688 12.003906 7.921875 12.050781 8.066406 12.050781 Z M 2.398438 13 L 13.601562 13 L 8 3.332031 Z M 2.398438 13 "/>
                    </g>
                </svg>
                 Registrar la salida cada vez que finaliza el turno, en caso de olvidar registrar el ingreso abstenerse de registrar la salida.
               
            </div>
            <div class="card">
                <div class="card-body">
                    <p>Ingreso</p>
                    <form  action="{{ url('/empleado/ingreso')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">Ingrese su clave: </span>
                            <input placeholder=" " autocomplete="off" type="text" class="form-control" name="di" id="di" aria-label="Recipient's username" aria-describedby="button-addon2">
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
                            <input placeholder=" " autocomplete="off" type="text" class="form-control" name="di" id="di" aria-label="Recipient's username" aria-describedby="button-addon2">
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
