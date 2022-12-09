
@extends('layouts.app')

@section('content')

<style>
    label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}
input.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
}
.tarifa{
    border: solid;
    border-radius: 20px;
    text-align: center;
    border-color:#c8e9ea ;
}
</style>
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Renovar suscripción de <b>{{$nombre}}</b>.</h5></div>

                <div class="card-body">

                    <p>La suscripción actual tiene vigencia hasta el {{$vence}}, ¿Desea prolongarla?</p><br>
                    <p class="tarifa" >Tarifa actual: <b>$ {{$valor}}</b>  mensuales</p>
                   
                 <form id="form" action="{{route('modelos.renovarpost',$id)}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <label for="fecha_pago">Fecha de entrada en vigencia</label>

                    <input class="form-control" type="date" name="fecha_pago" id="fecha_pago" >
                    <br>
                    <label for="meses_pagados">Cantidad de meses</label>

                    

                    <input class="form-control" min="0" type="number" name="meses_pagados" id="meses_pagados" autocomplete="off" max="100000">
                    <br>
                <small style="color:orange ;">Si deja desmarcada la casilla "¿Abonar una parte?", se registrara el pago de la totalidad del monto.</small>

                    <div class="form-check ">
                        <input id="pago" class="form-check-input" type="checkbox"  name="pago" value="false">
                        <label for="pago" class="form-check-label">¿Abonar una parte?</label>
                    </div>

                    <br>

                    <input class="form-control" type="number" name="abona" id="abona" disabled placeholder="$">

                    <br>
                    <div class="form-group row">
                                <label for="paga" class="col-sm-3 col-form-label">Medio de pago</label>
                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" >
                                    <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                        @foreach($medios as $medio)
                                            <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>
                    <br>

                    <label for="observaciones">Observaciones</label>
                                
                    <textarea class="form-control" style="width:100% ;" name="observaciones" id="observaciones" rows="3">{{$modelo->observaciones}}</textarea>
                                    
                           <br>


                    <input type="submit" id="registrar" value="Renovar" class="float-end btn btn-success" onclick="return confirm('¿Estás seguro de renovar la suscripción?')">
                         
                        
                       
                    <br>
                 </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){


     


        $("#pago").val("false");
        $("#pago").change(function(){
            if ($("#pago").val()=='true') {
                $("#pago").val("false");
                $( "#abona" ).prop( "disabled", true );

            }
            else if ($("#pago").val()=='false'){
                $("#pago").val("true");
                $( "#abona" ).prop( "disabled", false );
            }

            const pago= $("#pago").val();
            console.log(pago)
        })

       
        
        document.getElementById("registrar").onclick = function() {myFunction()};

        

        $("#form").validate({
                                rules: {
                                    meses_pagados : {
                                        required: true,
                                        
                                    },
                                    fecha_pago:{
                                        required: true,

                                    },
                                    abona:{
                                        required: true,
                                    },
                                    medio_id:{
                                        required: true,
                                    }
                                },
                                messages:{
                                    meses_pagados:{required:"Campo requerido"},
                                    fecha_pago:{required:"Campo requerido"},
                                    abona:{required:"Campo requerido"},
                                    medio_id:{required:"Campo requerido"}
                                    
                                }
                            })

    })
    function myFunction() {
           
            
        }
</script>


@endsection
