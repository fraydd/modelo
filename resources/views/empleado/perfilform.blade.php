@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Perfil de usuario.</h5></div>

                <div class="card-body">
                   
                <form  action="{{ url('/perfil')}}" method="post" enctype='multipart/form-data'>
                @csrf
                
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
            



@endsection
