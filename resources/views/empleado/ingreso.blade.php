@extends('layouts.app')

@section('content')

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
                <div class="des">
                    <div class=" alert alert-danger" role="alert">
                    
                    Usuario no encontrado!
                    </div>
                </div>
                <script>
                        $(document).ready(function(){
                            setTimeout(function(){
                                
                                $(".des").fadeOut(500);
                            },2000);  
                        })
                    </script>
                @endif
            

                @if(session('data'))
                <div class="des card">
                    
                <div class=" card-body">
                        <div class=" d-flex justify-content-center">
                            <img class="d-flex justify-content-center " src="{{ asset('images/modelos/'.json_decode(session('foto'))) }}"  height="150">
                        </div>
                        {{$data=json_decode(session('data'))}}
                    </div>
                </div>
                    

                    <script>
                        $(document).ready(function(){
                            setTimeout(function(){
                               
                                $(".des").fadeOut(1500);
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
