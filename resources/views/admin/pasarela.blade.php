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
</style>
<div class="container">
    <div id="alert" class="row justify-content-center">
   
        <div class="col-md-8">
            <div class="card"> 
                @if(session('borrado'))
                    <div class="alert alert-success" role="alert">
                        Deuda borrada correctamente!
                    </div>
                    <script>
                        setTimeout(function(){
                    
                            $(".alert").fadeOut(100);
                            
                        },3000);
                        
                    </script>
                @endif
                <div class="card-header"><h5>Pasarela</h5></div>

                <div class="card-body">
                <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                
                                <th>Foto </th>
                                <th>Nombre</th>
                                <th>Deudas</th>
                                <th >&nbsp;</th>
                                <th >&nbsp;</th>
                                <th >&nbsp;</th>
                                
                                
                            </tr> 
                        </thead>
                    
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uniformes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Uniformes</h5>
                <button id="close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form id="form1" action="{{route('modelos.uniformeput',1)}}" method="post" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
                <div class="mb-3">
                    <label for="tipo">Descripción<i style="color:red ;">*</i></label>
                    <input class="form-control" type="text" name="tipo" id="tipo" placeholder=" ">
                    
                    

                </div>
                <div class=" mb-3">
                    <label for="exampleInputPassword1" >Precio <i style="color:red ;">*</i> </label>
                    <input class="form-control" type="number" name="precio" id="precio" placeholder=" ">
                    
                    
                    
                </div>

                <small style="color:orange ;">Si deja desmarcada la casilla "¿Abonar una parte?", se registrara el pago de la totalidad del monto.</small>

                <div class="form-check mb-3">
                    <input id="pago" class="form-check-input" type="checkbox" name="pago" value="true">
                    <label for="pago" class="form-check-label"><small>¿Abonar una parte?</small></label>
                </div>
                

                <div class="mb-3">
                    <label class="form-label" for="meses_pagados">Valor a abonar</label>
                    
                        <input class="form-control" type="number" name="abona" id="abona" disabled max="1" placeholder="$">
                           
                    
            
                </div>

                <div class="form-group row">
                            <label for="paga" class="col-sm-3 col-form-label">Medio de pago</label>

                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id">
                                    <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                        @foreach($medios as $medio)
                                            <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 

                

                

                <button id="guardar1" type="submit" class="float-end btn btn-primary" onclick="return confirm('¿Seguro: registrar venta de uniforme?')">Guardar</button>
            </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal pasarela-->
<div class="modal fade" id="pasarela" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Derecho a pasarela</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="form2" action="{{route('modelos.pasarelaput',1)}}" method="post" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
          

                <div class=" mb-3">
                    
                    <label for="floatingInput">Evento<i style="color:red ;">*</i></label>
                    <select class="form-select"  name="pasarela"  id="pasarela" aria-placeholder="pais" required>
                        <option value="">- Seleccione -</option>
                        @foreach($pasarelas as $pasarela)
                            <option value="{{ $pasarela['id'] }}">  <b>{{ $pasarela['nombre'] }};</b>&nbsp; $ {{$pasarela['valor']}}; &nbsp;  {{$pasarela['fecha']}}</option>
                        @endforeach
                    </select>

                </div>

                <small style="color:orange ;">Si deja desmarcada la casilla "¿Abonar una parte?", se registrara el pago de la totalidad del monto</small>

                <div class="form-check mb-3">
                    <input id="pago2" class="form-check-input" type="checkbox" name="pago2" value="true">
                    <label for="pago2" class="form-check-label"><small>¿Abonar una parte?</small></label>
                </div>
                

                <div class="mb-3">
                    <label class="form-label" for="meses_pagados">Valor a abonar</label>
                    
                    <input class="form-control" type="number" name="abona2" id="abona2" disabled placeholder="$" >
                    
            
                </div><br>

                <div class="form-group row">
                            <label for="medio_id" class="col-sm-3 col-form-label">Medio de pago</label>

                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" >
                                    <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                        @foreach($medios as $medio)
                                            <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 

                <button id="guardar2" type="submit" class="float-end btn btn-primary" onclick="return confirm('¿Seguro de agregar derecho a pasarela?')">Guardar</button>
            </form>


      </div>

    </div>
  </div>
</div>

<!-- Modal adeudos-->
<div class="modal fade" id="adeudos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adeudos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-strped  table-hover shadow-sm " id="tabladeudos">
                <thead>
                    <tr>
                        <th hidden>Id</th>
                        <th>Concepto</th>
                        <th>Valor</th>    
                        <th >&nbsp;</th>
                    </tr> 
                </thead>
                <tbody>
                    
                </tbody>
        </table>


      </div>
    </div>
  </div>
</div>


<!-- Modal edit-->
<div class="modal fade" id="editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"><b id="concepto"></b> <b id="debe"></b></h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
            
            <form id="formad" action="{{route('modelos.editad',1)}}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <fieldset style="border:solid #bcddff; border-radius:2%;  " class="form-group p-2">
                    <legend style="float:none ;" class="w-auto px-2">Abonar</legend>
                    
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="editarad">Valor</label>
                        <div class="col-sm-6">
                            <input class="form-control" type="number" name="editarad" id="editarad" required placeholder="$">
                        </div>
                    </div><br>
                    
                    <div class="form-group row">
                    <label for="medio_id" class="col-sm-4 col-form-label">Medio de pago</label>

                        <div class="col-sm-4">
                            <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" >
                            <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                @foreach($medios as $medio)
                                    <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <button id="submitad" type="submit" class="float-end btn btn-primary" onclick="return confirm('¿Seguro de editar adeudo?')" >Guardar</button>

            
                
                
                </fieldset>
            </form>

            <form id="formdel" action="{{route('modelos.delad',1)}}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <fieldset style="border:solid #bcddff; border-radius:2%;  " class="form-group p-2">
                    <legend style="float:none ;" class="w-auto px-2">Saldar</legend>
                    
                    <div class="form-group row">
                    <label for="medio_id" class="col-sm-4 col-form-label">Medio de pago</label>

                        <div class="col-sm-4">
                            <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" >
                            <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                @foreach($medios as $medio)
                                    <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <button id="submitad" type="submit" class="float-end btn btn-primary" onclick="return confirm('¿Seguro de saldar el adeudo?')" >Guardar</button>

            
                
                
                </fieldset>
            </form>


      </div>

    </div>
  </div>
</div>


<script>
    const adeudos = @json($adeudos);
    const pasarelas = @json($pasar);

    $(function() {
        $('#medio').bootstrapToggle({});
    })

  $("#medio").val("on");
  
    $("#medio").change(function(){
        
        if ($("#medio").val()=="on") {
            $("#medio").val("off")
            
        } else if($("#medio").val()=="off"){
            $("#medio").val("on")
            
        }
   
})

$(function() {
        $('#medio2').bootstrapToggle({});
    })

  $("#medio2").val("on");
  
    $("#medio2").change(function(){
        
        if ($("#medio2").val()=="on") {
            $("#medio2").val("off")
            
        } else if($("#medio2").val()=="off"){
            $("#medio2").val("on")
            
        }
   
})

$(function() {
        $('#medio3').bootstrapToggle({});
    })

  $("#medio3").val("on");
  
    $("#medio3").change(function(){
        
        if ($("#medio3").val()=="on") {
            $("#medio3").val("off")
            
        } else if($("#medio3").val()=="off"){
            $("#medio3").val("on")
            
        }
   
})

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

    $("#pago2").val("false");
    $("#pago2").change(function(){
        if ($("#pago2").val()=='true') {
            $("#pago2").val("false");
            $( "#abona2" ).prop( "disabled", true );
            $( "#abona2" ).prop('required',true);

        }
        else if ($("#pago2").val()=='false'){
            $("#pago2").val("true");
            $( "#abona2" ).prop( "disabled", false );
        }

        const pago= $("#pago2").val();
        console.log(pago)
        
    })




        var table=$('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":"{{url('api/datatable4')}}",
               
                "columns":[
                    {data:'imagen'},
                    {data:'nombre'},
                    {data:'deudas'},
                    
                    {defaultContent: '<button id="modalu" type="button" class="uniforme btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uniformes"><svg width="22px" height="22px" viewBox="0 0 16 16" version="1.1"><g id="surface1"><path style=" stroke:none;fill-rule:nonzero;fill:rgb(87.843137%,13.72549%,10.588235%);fill-opacity:1;" d="M 15.925781 7.136719 L 15.304688 6.058594 L 15.035156 5.589844 C 14.886719 5.332031 14.554688 5.242188 14.296875 5.390625 C 12.722656 6.296875 13.308594 5.960938 11.679688 6.902344 C 11.417969 7.050781 11.332031 7.382812 11.480469 7.640625 L 12.375 9.1875 C 12.523438 9.445312 12.851562 9.535156 13.113281 9.386719 L 15.730469 7.875 C 15.988281 7.726562 16.078125 7.394531 15.925781 7.136719 Z M 15.925781 7.136719 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(95.294118%,18.039216%,15.686275%);fill-opacity:1;" d="M 8 3.863281 C 6.902344 3.863281 6.578125 3.132812 5.488281 1.648438 C 5.226562 1.289062 5.484375 0.785156 5.925781 0.785156 L 10.074219 0.785156 C 10.515625 0.785156 10.773438 1.289062 10.511719 1.648438 C 9.414062 3.140625 9.09375 3.863281 8 3.863281 Z M 8 3.863281 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(87.843137%,13.72549%,10.588235%);fill-opacity:1;" d="M 10.074219 0.785156 L 8 0.785156 L 8 3.863281 C 9.09375 3.863281 9.414062 3.140625 10.511719 1.648438 C 10.773438 1.289062 10.515625 0.785156 10.074219 0.785156 Z M 10.074219 0.785156 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(95.294118%,18.039216%,15.686275%);fill-opacity:1;" d="M 2.886719 9.386719 L 0.269531 7.875 C 0.0117188 7.726562 -0.078125 7.394531 0.0742188 7.136719 L 0.964844 5.589844 C 1.113281 5.332031 1.445312 5.242188 1.703125 5.390625 L 4.320312 6.902344 C 4.582031 7.050781 4.667969 7.382812 4.519531 7.640625 L 3.625 9.1875 C 3.476562 9.445312 3.148438 9.535156 2.886719 9.386719 Z M 2.886719 9.386719 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,25.882353%,23.921569%);fill-opacity:1;" d="M 15.304688 6.058594 L 15.035156 5.589844 L 12.878906 1.855469 C 12.496094 1.195312 11.789062 0.785156 11.023438 0.785156 L 10.074219 0.785156 C 9.902344 0.785156 9.738281 0.867188 9.636719 1.007812 C 8.472656 2.59375 8.433594 2.78125 8 2.78125 C 7.566406 2.78125 7.53125 2.601562 6.363281 1.007812 C 6.261719 0.867188 6.097656 0.785156 5.925781 0.785156 L 4.976562 0.785156 C 4.210938 0.785156 3.5 1.195312 3.121094 1.855469 L 0.964844 5.589844 L 0.695312 6.058594 C 0.910156 6.183594 3.035156 7.410156 3.511719 7.683594 L 3.511719 14.671875 C 3.511719 14.972656 3.753906 15.214844 4.050781 15.214844 L 11.949219 15.214844 C 12.246094 15.214844 12.488281 14.972656 12.488281 14.671875 L 12.488281 7.683594 C 12.96875 7.40625 15.09375 6.179688 15.304688 6.058594 Z M 15.304688 6.058594 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(95.294118%,18.039216%,15.686275%);fill-opacity:1;" d="M 15.035156 5.589844 L 12.878906 1.855469 C 12.496094 1.195312 11.789062 0.785156 11.023438 0.785156 L 10.074219 0.785156 C 9.902344 0.785156 9.738281 0.867188 9.636719 1.007812 C 8.472656 2.59375 8.433594 2.78125 8 2.78125 L 8 15.214844 L 11.949219 15.214844 C 12.246094 15.214844 12.488281 14.972656 12.488281 14.671875 L 12.488281 7.683594 C 12.96875 7.40625 15.09375 6.179688 15.304688 6.058594 Z M 15.035156 5.589844 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(95.294118%,18.039216%,15.686275%);fill-opacity:1;" d="M 8.535156 5.476562 C 8.535156 5.773438 8.296875 6.011719 8 6.011719 C 7.703125 6.011719 7.464844 5.773438 7.464844 5.476562 C 7.464844 5.183594 7.703125 4.945312 8 4.945312 C 8.296875 4.945312 8.535156 5.183594 8.535156 5.476562 Z M 8.535156 5.476562 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(95.294118%,18.039216%,15.686275%);fill-opacity:1;" d="M 8.535156 7.492188 C 8.535156 7.789062 8.296875 8.027344 8 8.027344 C 7.703125 8.027344 7.464844 7.789062 7.464844 7.492188 C 7.464844 7.199219 7.703125 6.960938 8 6.960938 C 8.296875 6.960938 8.535156 7.199219 8.535156 7.492188 Z M 8.535156 7.492188 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(95.294118%,18.039216%,15.686275%);fill-opacity:1;" d="M 8.535156 7.492188 C 8.535156 7.789062 8.296875 8.027344 8 8.027344 C 7.703125 8.027344 7.464844 7.789062 7.464844 7.492188 C 7.464844 7.199219 7.703125 6.960938 8 6.960938 C 8.296875 6.960938 8.535156 7.199219 8.535156 7.492188 Z M 8.535156 7.492188 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(87.843137%,13.72549%,10.588235%);fill-opacity:1;" d="M 8.535156 5.476562 C 8.535156 5.183594 8.296875 4.945312 8 4.945312 L 8 6.011719 C 8.296875 6.011719 8.535156 5.773438 8.535156 5.476562 Z M 8.535156 5.476562 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(87.843137%,13.72549%,10.588235%);fill-opacity:1;" d="M 8.535156 7.492188 C 8.535156 7.199219 8.296875 6.960938 8 6.960938 L 8 8.027344 C 8.296875 8.027344 8.535156 7.789062 8.535156 7.492188 Z M 8.535156 7.492188 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(87.843137%,13.72549%,10.588235%);fill-opacity:1;" d="M 8.535156 7.492188 C 8.535156 7.199219 8.296875 6.960938 8 6.960938 L 8 8.027344 C 8.296875 8.027344 8.535156 7.789062 8.535156 7.492188 Z M 8.535156 7.492188 "/></g></svg></button>'},
                    {defaultContent: '<button id="modalu" type="button" class="pasarela btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#pasarela"><svg width="22px" height="22px" viewBox="0 0 16 16" version="1.1"><g id="surface1"><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,88.235294%,0%);fill-opacity:1;" d="M 1.871094 14.277344 L 0.800781 14.277344 C 0.800781 14.011719 0.800781 13.183594 0.800781 12.941406 C 0.800781 12.488281 0.773438 12.007812 0.746094 11.554688 C 0.722656 10.644531 0.667969 9.710938 0.585938 8.800781 C 0.535156 8.027344 0.453125 7.226562 0.375 6.449219 C 0.265625 5.648438 0.160156 4.6875 0.453125 3.914062 C 0.722656 3.246094 1.175781 2.683594 1.710938 2.175781 C 1.816406 2.097656 1.898438 1.988281 2.003906 1.910156 C 2.296875 1.640625 2.75 1.667969 3.019531 1.960938 C 3.578125 2.523438 4.488281 3.617188 5.074219 5.089844 C 5.398438 5.890625 5.742188 6.664062 6.089844 7.464844 C 6.464844 8.265625 6.839844 9.042969 7.1875 9.871094 C 7.402344 10.351562 7.667969 10.886719 8.09375 11.207031 C 8.523438 11.527344 9.03125 11.632812 9.539062 11.632812 C 10.019531 11.632812 10.5 11.527344 10.925781 11.367188 C 10.925781 11.367188 15.042969 12.78125 15.683594 13.503906 C 16.324219 14.25 11.382812 14.304688 11.382812 14.304688 L 8.042969 14.304688 C 7.265625 14.304688 6.546875 14.011719 6.011719 13.449219 C 5.371094 12.78125 4.113281 9.175781 4.035156 9.015625 C 3.875 8.613281 3.714844 8.242188 3.5 7.894531 C 3.339844 7.625 3.125 7.253906 2.804688 7.144531 C 2.351562 7.011719 2.109375 7.574219 2.03125 7.921875 C 1.816406 8.667969 1.871094 8.933594 1.871094 9.738281 C 1.871094 11.046875 1.871094 14.277344 1.871094 14.277344 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 1.363281 12.941406 C 1.363281 12.488281 1.335938 12.007812 1.308594 11.554688 C 1.28125 10.644531 1.230469 9.710938 1.148438 8.800781 C 1.09375 8.027344 1.015625 7.226562 0.933594 6.449219 C 0.828125 5.648438 0.722656 4.6875 1.015625 3.914062 C 1.28125 3.246094 1.738281 2.683594 2.269531 2.175781 C 2.378906 2.097656 2.457031 1.988281 2.566406 1.910156 C 2.617188 1.855469 2.699219 1.800781 2.777344 1.773438 C 2.511719 1.695312 2.21875 1.722656 2.003906 1.910156 C 1.921875 1.988281 1.816406 2.097656 1.710938 2.175781 C 1.203125 2.65625 0.722656 3.246094 0.453125 3.914062 C 0.160156 4.6875 0.265625 5.648438 0.375 6.449219 C 0.480469 7.226562 0.535156 8 0.585938 8.800781 C 0.667969 9.710938 0.722656 10.644531 0.75 11.554688 C 0.773438 12.007812 0.800781 12.488281 0.800781 12.941406 C 0.800781 13.183594 0.800781 14.011719 0.800781 14.277344 L 1.335938 14.277344 C 1.363281 14.011719 1.363281 13.183594 1.363281 12.941406 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,65.882353%,0%);fill-opacity:1;" d="M 15.789062 13.476562 C 15.148438 12.730469 11.035156 11.339844 11.035156 11.339844 C 10.792969 11.417969 10.527344 11.5 10.257812 11.554688 C 11.40625 11.980469 13.945312 12.941406 14.453125 13.503906 C 15.09375 14.25 10.152344 14.304688 10.152344 14.304688 L 11.488281 14.304688 C 11.488281 14.277344 16.429688 14.226562 15.789062 13.476562 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" d="M 11.40625 14.546875 L 8.042969 14.546875 C 7.214844 14.546875 6.386719 14.199219 5.824219 13.609375 C 5.421875 13.183594 4.753906 11.714844 3.847656 9.230469 C 3.820312 9.148438 3.792969 9.09375 3.792969 9.09375 C 3.605469 8.640625 3.445312 8.292969 3.285156 8 C 3.152344 7.785156 2.964844 7.4375 2.75 7.359375 C 2.726562 7.359375 2.726562 7.359375 2.699219 7.359375 C 2.566406 7.359375 2.40625 7.597656 2.324219 7.945312 C 2.109375 8.535156 2.136719 8.800781 2.136719 9.335938 C 2.136719 9.46875 2.136719 9.578125 2.136719 9.738281 C 2.136719 11.019531 2.136719 14.039062 2.136719 14.277344 C 2.136719 14.4375 2.03125 14.546875 1.871094 14.546875 L 0.800781 14.546875 C 0.640625 14.546875 0.535156 14.4375 0.535156 14.277344 L 0.535156 13.929688 C 0.535156 13.582031 0.535156 13.101562 0.535156 12.941406 C 0.535156 12.621094 0.507812 12.328125 0.507812 12.007812 L 0.480469 11.554688 C 0.453125 10.644531 0.402344 9.710938 0.320312 8.800781 C 0.265625 7.972656 0.1875 7.226562 0.105469 6.476562 L 0.105469 6.449219 C 0 5.59375 -0.105469 4.632812 0.214844 3.804688 C 0.453125 3.191406 0.882812 2.578125 1.523438 1.988281 C 1.628906 1.882812 1.738281 1.800781 1.84375 1.722656 C 2.03125 1.5625 2.246094 1.453125 2.484375 1.453125 C 2.75 1.453125 3.019531 1.5625 3.207031 1.773438 C 3.742188 2.308594 4.703125 3.457031 5.316406 4.980469 C 5.609375 5.730469 5.929688 6.476562 6.332031 7.332031 L 6.625 7.945312 C 6.894531 8.535156 7.1875 9.121094 7.425781 9.738281 C 7.613281 10.191406 7.855469 10.671875 8.253906 10.964844 C 8.574219 11.207031 9.003906 11.339844 9.484375 11.339844 L 9.539062 11.339844 C 9.9375 11.339844 10.367188 11.257812 10.847656 11.074219 C 10.898438 11.046875 10.953125 11.046875 11.007812 11.074219 C 11.433594 11.207031 15.203125 12.515625 15.871094 13.289062 C 16.054688 13.503906 16.003906 13.691406 15.949219 13.769531 C 15.734375 14.359375 13.359375 14.519531 11.40625 14.546875 Z M 2.671875 6.796875 C 2.75 6.796875 2.804688 6.796875 2.886719 6.824219 C 3.3125 6.957031 3.554688 7.386719 3.714844 7.679688 C 3.902344 8 4.085938 8.375 4.273438 8.855469 C 4.273438 8.882812 4.300781 8.933594 4.328125 9.015625 C 5.476562 12.195312 5.984375 13.023438 6.199219 13.210938 C 6.679688 13.742188 7.347656 14.011719 8.042969 14.011719 L 11.40625 14.011719 C 13.0625 13.984375 14.960938 13.824219 15.441406 13.582031 C 14.855469 13.074219 12.503906 12.140625 10.953125 11.605469 C 10.445312 11.765625 9.992188 11.847656 9.5625 11.875 L 9.511719 11.875 C 8.921875 11.875 8.363281 11.714844 7.960938 11.394531 C 7.480469 11.046875 7.214844 10.484375 6.972656 9.949219 C 6.707031 9.363281 6.4375 8.75 6.171875 8.1875 L 5.878906 7.574219 C 5.476562 6.71875 5.15625 5.941406 4.835938 5.195312 C 4.246094 3.753906 3.339844 2.683594 2.832031 2.175781 C 2.671875 1.960938 2.378906 1.960938 2.191406 2.121094 C 2.082031 2.203125 2.003906 2.28125 1.898438 2.390625 C 1.308594 2.925781 0.910156 3.457031 0.695312 3.992188 C 0.425781 4.6875 0.535156 5.59375 0.613281 6.371094 L 0.613281 6.398438 C 0.722656 7.144531 0.773438 7.917969 0.828125 8.746094 C 0.910156 9.65625 0.960938 10.589844 0.988281 11.527344 L 1.015625 11.980469 C 1.042969 12.300781 1.070312 12.621094 1.070312 12.941406 C 1.070312 13.101562 1.070312 13.582031 1.070312 13.957031 L 1.070312 14.011719 L 1.601562 14.011719 C 1.601562 13.210938 1.601562 10.832031 1.601562 9.738281 C 1.601562 9.601562 1.601562 9.46875 1.601562 9.335938 C 1.601562 8.800781 1.578125 8.453125 1.761719 7.785156 C 1.84375 7.492188 2.082031 6.796875 2.671875 6.796875 Z M 2.671875 6.796875 "/></g></svg></button>'},
                    {defaultContent:'<button type="button" class="adeudos btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#adeudos"><svg width="22px" height="22px" viewBox="0 0 16 16" version="1.1"><g id="surface1"><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 5.738281 5.199219 L 2.195312 5.199219 C 2.148438 5.726562 1.726562 6.148438 1.199219 6.195312 L 1.199219 9.804688 C 1.726562 9.851562 2.148438 10.273438 2.195312 10.800781 L 5.738281 10.800781 C 4.921875 10.140625 4.398438 9.132812 4.398438 8 C 4.398438 6.867188 4.921875 5.859375 5.738281 5.199219 Z M 5.738281 5.199219 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 10.261719 10.800781 L 13.804688 10.800781 C 13.851562 10.273438 14.273438 9.851562 14.800781 9.804688 L 14.800781 6.195312 C 14.273438 6.148438 13.851562 5.726562 13.804688 5.199219 L 10.261719 5.199219 C 11.078125 5.859375 11.601562 6.867188 11.601562 8 C 11.601562 9.132812 11.078125 10.140625 10.261719 10.800781 Z M 10.261719 10.800781 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(42.745098%,64.705882%,26.666667%);fill-opacity:1;" d="M 8 4 L 8 4.980469 L 8.273438 4.980469 L 8.273438 5.628906 C 8.550781 5.65625 8.816406 5.71875 9.058594 5.816406 C 9.304688 5.914062 9.515625 6.015625 9.695312 6.121094 L 9.234375 6.996094 C 9.21875 6.976562 9.183594 6.949219 9.121094 6.910156 C 9.058594 6.875 8.980469 6.832031 8.882812 6.785156 C 8.785156 6.742188 8.679688 6.699219 8.558594 6.65625 C 8.441406 6.617188 8.324219 6.585938 8.203125 6.570312 L 8.203125 7.445312 L 8.410156 7.496094 C 8.628906 7.558594 8.824219 7.625 9 7.695312 C 9.175781 7.765625 9.328125 7.851562 9.449219 7.957031 C 9.570312 8.0625 9.664062 8.191406 9.730469 8.339844 C 9.796875 8.492188 9.832031 8.671875 9.832031 8.882812 C 9.832031 9.125 9.789062 9.335938 9.703125 9.507812 C 9.617188 9.679688 9.503906 9.820312 9.359375 9.929688 C 9.214844 10.039062 9.050781 10.121094 8.863281 10.175781 C 8.675781 10.230469 8.480469 10.265625 8.273438 10.273438 L 8.273438 11.019531 L 8 11.019531 L 8 12 L 16 12 L 16 4 Z M 10.261719 5.199219 L 13.804688 5.199219 C 13.851562 5.726562 14.273438 6.148438 14.800781 6.195312 L 14.800781 9.804688 C 14.273438 9.851562 13.851562 10.273438 13.804688 10.800781 L 10.261719 10.800781 C 11.078125 10.140625 11.601562 9.132812 11.601562 8 C 11.601562 6.867188 11.078125 5.859375 10.261719 5.199219 Z M 10.261719 5.199219 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(42.745098%,64.705882%,26.666667%);fill-opacity:1;" d="M 8.699219 8.984375 C 8.699219 8.875 8.652344 8.785156 8.5625 8.722656 C 8.472656 8.664062 8.351562 8.605469 8.203125 8.554688 L 8.203125 9.328125 C 8.535156 9.3125 8.699219 9.199219 8.699219 8.984375 Z M 8.699219 8.984375 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(56.862745%,86.27451%,35.294118%);fill-opacity:1;" d="M 7.449219 6.9375 C 7.449219 7.042969 7.488281 7.128906 7.5625 7.191406 C 7.636719 7.253906 7.75 7.308594 7.898438 7.355469 L 7.898438 6.5625 C 7.601562 6.589844 7.449219 6.714844 7.449219 6.9375 Z M 7.449219 6.9375 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(56.862745%,86.27451%,35.294118%);fill-opacity:1;" d="M 8 11.019531 L 7.828125 11.019531 L 7.828125 10.265625 C 7.53125 10.242188 7.238281 10.179688 6.949219 10.085938 C 6.660156 9.992188 6.398438 9.867188 6.167969 9.710938 L 6.632812 8.792969 C 6.648438 8.8125 6.695312 8.847656 6.769531 8.898438 C 6.84375 8.949219 6.941406 9 7.054688 9.050781 C 7.171875 9.105469 7.304688 9.15625 7.449219 9.207031 C 7.59375 9.257812 7.746094 9.292969 7.898438 9.3125 L 7.898438 8.457031 L 7.589844 8.367188 C 7.378906 8.300781 7.199219 8.234375 7.042969 8.15625 C 6.890625 8.082031 6.761719 7.996094 6.660156 7.898438 C 6.558594 7.796875 6.484375 7.683594 6.433594 7.554688 C 6.386719 7.425781 6.359375 7.277344 6.359375 7.105469 C 6.359375 6.882812 6.398438 6.683594 6.476562 6.507812 C 6.554688 6.335938 6.660156 6.1875 6.789062 6.0625 C 6.921875 5.9375 7.074219 5.839844 7.253906 5.769531 C 7.429688 5.699219 7.625 5.652344 7.828125 5.628906 L 7.828125 4.980469 L 8 4.980469 L 8 4 L 0 4 L 0 12 L 8 12 Z M 5.738281 10.800781 L 2.195312 10.800781 C 2.148438 10.273438 1.726562 9.851562 1.199219 9.804688 L 1.199219 6.195312 C 1.726562 6.148438 2.148438 5.726562 2.195312 5.199219 L 5.738281 5.199219 C 4.921875 5.859375 4.398438 6.867188 4.398438 8 C 4.398438 9.132812 4.921875 10.140625 5.738281 10.800781 Z M 5.738281 10.800781 "/><path style=" stroke:none;fill-rule:nonzero;fill:rgb(100%,100%,100%);fill-opacity:1;" d="M 7.828125 5.628906 C 7.625 5.652344 7.429688 5.699219 7.253906 5.769531 C 7.074219 5.839844 6.921875 5.9375 6.789062 6.0625 C 6.660156 6.1875 6.554688 6.335938 6.476562 6.507812 C 6.398438 6.683594 6.359375 6.882812 6.359375 7.105469 C 6.359375 7.277344 6.386719 7.425781 6.433594 7.554688 C 6.484375 7.683594 6.558594 7.796875 6.660156 7.898438 C 6.761719 7.996094 6.890625 8.082031 7.042969 8.15625 C 7.199219 8.234375 7.378906 8.300781 7.589844 8.367188 L 7.898438 8.457031 L 7.898438 9.3125 C 7.746094 9.292969 7.59375 9.257812 7.449219 9.207031 C 7.304688 9.15625 7.171875 9.105469 7.058594 9.050781 C 6.941406 9 6.84375 8.949219 6.769531 8.898438 C 6.695312 8.847656 6.648438 8.8125 6.632812 8.792969 L 6.167969 9.710938 C 6.398438 9.867188 6.660156 9.992188 6.949219 10.085938 C 7.238281 10.179688 7.535156 10.242188 7.828125 10.265625 L 7.828125 11.019531 L 8.273438 11.019531 L 8.273438 10.273438 C 8.480469 10.265625 8.675781 10.230469 8.863281 10.175781 C 9.050781 10.121094 9.214844 10.039062 9.359375 9.929688 C 9.503906 9.820312 9.617188 9.679688 9.703125 9.507812 C 9.789062 9.335938 9.832031 9.125 9.832031 8.882812 C 9.832031 8.671875 9.796875 8.492188 9.730469 8.339844 C 9.664062 8.191406 9.570312 8.0625 9.449219 7.957031 C 9.328125 7.851562 9.175781 7.765625 9 7.695312 C 8.824219 7.625 8.628906 7.558594 8.410156 7.496094 L 8.203125 7.445312 L 8.203125 6.570312 C 8.324219 6.585938 8.441406 6.617188 8.558594 6.65625 C 8.679688 6.699219 8.785156 6.742188 8.882812 6.785156 C 8.980469 6.832031 9.058594 6.875 9.121094 6.910156 C 9.183594 6.949219 9.21875 6.976562 9.234375 6.996094 L 9.695312 6.121094 C 9.515625 6.015625 9.304688 5.917969 9.058594 5.816406 C 8.816406 5.71875 8.550781 5.65625 8.273438 5.628906 L 8.273438 4.980469 L 7.828125 4.980469 Z M 8.203125 8.554688 C 8.351562 8.605469 8.472656 8.664062 8.5625 8.722656 C 8.652344 8.785156 8.699219 8.875 8.699219 8.984375 C 8.699219 9.199219 8.535156 9.3125 8.203125 9.328125 Z M 7.898438 7.355469 C 7.75 7.308594 7.636719 7.253906 7.5625 7.191406 C 7.488281 7.128906 7.449219 7.042969 7.449219 6.9375 C 7.449219 6.714844 7.601562 6.589844 7.898438 6.5625 Z M 7.898438 7.355469 "/></g></svg></button>'},

                    
                ],

                'responsive': true,
                'autoWidth': false,

                "language": {
                    "lengthMenu": "_MENU_ resultados por página",
                    "zeroRecords": "Sin resultados :(",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(Filtrado de _MAX_ registros totales)",
                    "search":"Buscar:",
                    "paginate":{
                        'next':'Siguiente',
                        'previous':'Anterior'
                    }
                
            }}
            
        );
uniformefcn("#tabla tbody",table)
adeudosfcn("#tabla tbody",table)
pasarelafcn("#tabla tbody",table)


        function uniformefcn(tbody, table){
            $(tbody).on("click","button.uniforme", function(){

                $("#form1").validate({
                                rules: {
                                    tipo : {
                                        required: true,
                                        
                                    },
                                    precio : {
                                        required: true,
                                        
                                    },
                                    abona:{
                                        max:100000000,
                                        required:true,
                                        
                                    },
                                    medio_id:{
                                        required:true,
                                    }

                                },
                                messages:{
                                    tipo:{required:"Campo requerido"},
                                    precio:{required:"Campo requerido"},
                                    abona:{required:"Campo requerido",
                                        max:"Cifra demasiado alta"
                                    },
                                    medio_id:{required:"Campo requerido"}
                                }
                            })




                var data=table.row($(this).parents("tr")).data();
                var id=data['id']
                var url ="{{route('modelos.uniformeput',1)}}"
                url = url.replace('1', id);
                $('#form1').attr('action',url);
                $("#form1")[0].reset();

                $("#pago").val("false");
                $( "#abona" ).prop( "disabled", true );
                $("#precio").change(function(){
                    var a= $( "#precio" ).val();
                    console.log(a)
                    $('#abona').attr('max',a);
                    

                })

                
                



            })
        }

        function adeudosfcn(tbody, table){
            $(tbody).on("click","button.adeudos", function(){
                var data=table.row($(this).parents("tr")).data();
                var id=data['id']
                console.log(adeudos)
                var adeudosm =  adeudos.filter(function(modelo) {
                    return modelo.modelo_id == id;
                });
                
                $("#tabladeudos > tbody").empty();
                if (adeudosm.length==0) {

                                    var a= '<tr>'+
                                    '<td> </td>'+
                                    '<td>Sin elementos...</td>'+
                                    '<td></td>'+
                                    '<td></td>'+
                                    '</tr>';

                                    console.log(a)
                                    $("#tabladeudos").append(a);
                                }
                var d = ''
                const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
        
    
        
                
                for (var i = 0; i < adeudosm.length; i++) {
                d+= '<tr>'+
                '<td hidden>'+adeudosm[i].id+'</td>'+
                '<td>'+adeudosm[i].tipo+'</td>'+
                '<td>'+f.format( adeudosm[i].monto)+'</td>'+
/*                 '<td>'+'<button id="borrar'+adeudosm[i].id+'" class="btn btn-outline-danger btn-sm" >Saldar</button>'+'</td>'+*/
                '<td>'+'<button id="editar'+adeudosm[i].id+'" class="btn btn-outline-warning  btn-sm" data-bs-toggle="modal" data-bs-target="#editar" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16"><path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/></svg></button>'+'</td>'+
                
                '</tr>';
                }
                $("#tabladeudos").append(d);
                
                var id='a'
                    $(document).on('click', 'button', function() {
/*                         if (this.id.slice(0,6)=='borrar') {
                            if (confirm('¿Pagar completamente la deuda ?')==true) {
                                let idb = this.id;
                            var id=idb.slice(6);
                            var url="{{route('modelos.borrarad', 1)}}";
                            url = url.replace('1', id);
                            console.log(url)
                            window.location.href = url;

                            setTimeout(function(){
                                window.location.href = 'http://localhost/modelo/public/pasarela'; //Will take you to Google.
                                console.log('reload')
                            }, 4000);
                            }
                            
                            

                            
                        } */
                        if(this.id.slice(0,6)=='editar'){
                            console.log('editar')
                            let idb = this.id;
                            var id=idb.slice(6);
                            var deuda =  adeudos.filter(function(deuda) {
                                return deuda.id == id;
                            });
                            $("#concepto").text(''+deuda['0']['tipo']+':');
                            const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
                            var debe=f.format(deuda['0']['monto'])
                            $("#debe").text(''+debe);
                            var url ="{{route('modelos.editad',1)}}"
                            url = url.replace('1', id);
                            $('#formad').attr('action',url);

                            var urldel ="{{route('modelos.delad',1)}}"
                            urldel = urldel.replace('1', id);
                            $('#formdel').attr('action',urldel);
                            

                            $("#formad").validate({
                                rules: {
                                    editarad : {
                                        required: true,
                                        max:deuda['0']['monto']-100,
                                    },
                                    medio_id:{required:true}

                                },
                                messages:{
                                    editarad:{required:"Campo requerido", 
                                    max:"El valor abonado no puede superar el monto total"},
                                    medio_id:{required:"Campo requerido"}
                                }
                            })


                            $("#formdel").validate({
                                rules: {
                                    
                                    medio_id:{required:true}

                                },
                                messages:{
                                    
                                    medio_id:{required:"Campo requerido"}
                                }
                            })
                            
                            

                        }

                        
                    });

                
        

            })
        }

        function pasarelafcn(tbody, table){
            $(tbody).on("click","button.pasarela", function(){
                var data=table.row($(this).parents("tr")).data();
                var id=data['id']
                var a=0
                $("#pasarela").change(function(){
                    idp=$('select[name=pasarela').val()
                    idp = parseInt(idp)
                    console.log(pasarelas,idp)
                    var pasarela =  pasarelas.filter(function(pasarela) {
                        return pasarela.id == idp;
                    });
                    a=pasarela[0]['valor']

                    $("#form2").validate({
                    rules: {
                        abona2 : {required: true,max:a-100,},
                        medio_id:{required:true},
                    },
                    messages:{
                        abona2:{required:"Campo requerido", 
                            max:"El valor abonado no puede superar el monto total"},
                        medio_id:{required:"Campo requerido"},
                    }
                })
                    
                    
                });
                
                
                var url ="{{route('modelos.pasarelaput',1)}}"
                url = url.replace('1', id);
                $('#form2').attr('action',url);
                $("#form2")[0].reset();

                $("#pago2").val("false");
                $( "#abona2" ).prop( "disabled", true );
                console.log(id,)

                
               
                            })
        }



   
    
    </script>

@endsection
