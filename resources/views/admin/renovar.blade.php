
@extends('layouts.app')

@section('content')

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Renovar suscripción de <b>{{$nombre}}</b>.</h5></div>

                <div class="card-body">

                    <p>La suscripción actual tiene vigencia hasta el {{$vence}}, ¿Desea prolongarla?</p>
                   
                 <form action="{{route('modelos.renovarpost',$id)}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <label for="fecha_pago">Fecha de entrada en vigencia</label>

                    <input class="form-control" type="date" name="fecha_pago" id="fecha_pago">
                    <br>
                    <label for="meses_pagados">Cantidad de meses</label>

                    <input class="form-control" min="0" type="number" name="meses_pagados" id="meses_pagados" autocomplete="off">
                    <br>
                    <input type="submit" id="registrar" value="Renovar" class="float-end btn btn-success">
                 </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        
        document.getElementById("registrar").onclick = function() {myFunction()};

        function myFunction() {
            setTimeout(function(){
                location.href="{{route('modelos.index')}}"
            },1000);
            
        }

    })
</script>


@endsection
