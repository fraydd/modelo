@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="grid-block" style="background-image: url('http://localhost/modelo/public/images/fondo.png'); height: 100vh; min-height: 1000px; background-position: center; background-repeat: no-repeat; background-size: cover;">
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-transparent">
                <div  class="card-header"><h4 style="color:white ;">Perfil de usuario.</h4></div>

                <div class="card-body">
                   
                <form  action="{{ url('/perfil')}}" method="post" enctype='multipart/form-data'>
                @csrf
                
                <div class="input-group mb-3">
                    <span style="color:white ;" class="input-group-text bg-transparent">Ingrese su clave: </span>
                    
                    <input placeholder=" " autocomplete="off" type="text" style="color:white ;" class="form-control bg-transparent" name="di" id="di" aria-label="Recipient's username" aria-describedby="button-addon2">
                    
                    <input type="submit" style="color:white; border-color:white;" class="btn btn-outline-secondary" id="button-addon2">

                </div>

                
                    
                    
                
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
                </div>
           
</body>
</html>
 



@endsection
