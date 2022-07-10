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
                <div class="card-header">Registro de ingreso</div>

                <div class="card-body">
                   
                <form  action="{{ url('/empleado')}}" method="post" enctype='multipart/form-data'>
                @csrf
                <label for="di">Ingrese su clave </label> 
                <input type="password" name="di" id="di">
                
                </form>
                </div>
            </div>

                

                @if (session('error'))
                <br>
                <div class="des">
                    <div class=" alert alert-danger" role="alert">
                    
                    Usuario no encontrado!
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
                    <h1>Bienvenido {{$data=json_decode(session('data'))}}!</h1><br>
                    <div class=" d-flex justify-content-center">
                        <img class="d-flex justify-content-center imagen" src="{{ asset('images/modelos/'.json_decode(session('foto'))) }}"  >
                    </div>
                    <br>
                    <h5 id="estado"></h5> 
                        
                        
                       
                    </div>
                </div>



                <div style="display: none">
                    {{$foto=json_decode(session('foto'))}}
                    {{$estado=json_decode(session('estado'))}}
                    {{$fecha_v=json_decode(session('fecha_v'))}}
                </div>
                    

                    <script>
                        $(document).ready(function(){
                            const estado = @json($estado);
                            const fecha_v = @json($fecha_v);
                            if(estado==1){
                                var fondo = document.getElementById('fondo');
                                fondo.style.backgroundColor = '#d4edda';
                                
                                document.getElementById('estado').innerHTML ='Suscripción vigente hasta el: '+ fecha_v;
                            }else{
                                var fondo = document.getElementById('fondo');
                                fondo.style.backgroundColor = '#ffeaec';
                                document.getElementById('estado').innerHTML ='Suscripción vencida';
                            }
                           

                            setTimeout(function(){
                               
                                $(".des").fadeOut(100);
                            },3000);  
                        })
                        
                        
                    </script>
                    
   

                @endif

            
        </div>
    </div>
    <div>
    


    
</div>
</div>





@endsection
