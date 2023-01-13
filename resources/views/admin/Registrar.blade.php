@extends('layouts.app')

@section('content')



<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->





@if (session('error'))
    <div class="des">
        <div class=" alert alert-danger" role="alert">
        
        Error al registrar!
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
<div class="container">
<div class="card">
    <div class="card-header">

        <h5>Registrar</h5>
    </div>

                    
<div class="card-body">
    <h2>Datos personales.</h2><br>
    <form id="formul" action="{{ url('/modelos')}}" method="post" enctype='multipart/form-data'>
        @csrf
        
        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nombre">Nombre completo *</label>
            <div class="col-sm-6">
                <input class="form-control"  type="text" autocomplete="off" name="nombre" value="{{old('nombre')}}" id="nombre">
                @error('nombre')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nid">Número de identificación*</label>
            <div class="col-sm-6">
                <input class="form-control" type="number"  autocomplete="off" name="nid" value="{{old('nid')}}" id="nid" min="0">
                @error('nid')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
        <label class="control-label col-sm-3 d-flex justify-content-end" for="identification_id">Tipo de documento*</label>

            <div class="col-sm-6">
            <select class="form-select"  name="identification_id"  id="identification_id" aria-placeholder="pais">
                <option value="{{old('identification_id')}}">- Seleccione -</option>
                @foreach($identifications as $identification)
                    <option value="{{ $identification['id'] }}">  {{ $identification['desc'] }}  </option>
                @endforeach
            </select>
            @error('identification_id')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="expedido">Lugar de expedición*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="expedido" value="{{old('expedido')}}" id="expedido">  
                @error('expedido')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="fechan">Fecha de nacimiento*</label> 
            <div class="col-sm-6">
                <input class="form-control" type="date" name="fechan" value="{{old('fechan')}}" id="fechan">
                @error('fechan')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="sex_id">Sexo*</label>
            <div class="col-sm-6">
                <select class="form-select"  name="sex_id"  id="sex_id" aria-placeholder="pais">
                    <option value="{{old('sex_id')}}">- Seleccione -</option>
                    @foreach($sexes as $sexe)
                        <option value="{{ $sexe['id'] }}">  {{ $sexe['tipo'] }}  </option>
                    @endforeach
                </select>
                @error('sex_id')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror 
            </div>
        </div><br>
        
        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="rh_id">G.S. RH*</label>
            <div class="col-sm-6">
                <select class="form-select"  name="rh_id" id="rh_id" aria-placeholder="pais">
                    <option  value="{{old('rh_id')}}">- Seleccione -</option>
                    @foreach($rhs as $rh)
                        <option value="{{ $rh['id'] }}">  {{ $rh['tipo'] }}  </option>
                    @endforeach
                </select>
                @error('rh_id')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="direccion">Dirección*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="direccion" value="{{old('direccion')}}" id="direccion">  
                @error('direccion')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="telefono">Teléfono*</label>
            <div class="col-sm-6">
                <input class="form-control" type="tel" autocomplete="off" name="telefono" value="{{old('telefono')}}" id="telefono">  
                @error('telefono')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="correo">E-Mail*</label>
            <div class="col-sm-6">
                <input class="form-control" type="email" autocomplete="off" name="correo" value="{{old('correo')}}" id="correo">  
                @error('correo')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="foto">Fotografía *</label>
            <div class="col-sm-6">
                <input class="form-control" type="file" name="foto" value="{{old('foto')}}" id="foto" accept="image/*">
                @error('foto')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br><hr><br>





<h2>Datos comerciales.</h2><br>
        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="estatura">Estatura*</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" autocomplete="off" placeholder="En metros ej. 1,70" min="0" step=".01" name="estatura" value="{{old('estatura')}}" id="estatura">
                @error('estatura')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="busto">Busto*</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" autocomplete="off" min="0" name="busto" value="{{old('busto')}}" id="busto">
                @error('busto')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="cintura">Cintura*</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" autocomplete="off" min="0" name="cintura" value="{{old('cintura')}}" id="cintura">
                @error('cintura')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="cadera">Cadera*</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" autocomplete="off" min="0" name="cadera" value="{{old('cadera')}}" id="cadera">
                @error('cadera')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="cabello">Cabello*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="cabello" value="{{old('cabello')}}" id="cabello">
                @error('cabello')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="ojos">Ojos*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="ojos" value="{{old('ojos')}}" id="ojos">
                @error('ojos')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="piel">Piel*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="piel" value="{{old('piel')}}" id="piel">
                @error('piel')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="pantalon">Pantalón*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="pantalon" value="{{old('pantalon')}}" id="pantalon">
                @error('pantalon')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="camisa">Camisa*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="camisa" value="{{old('camisa')}}" id="camisa">
                @error('camisa')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="calzado">calzado*</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="calzado" value="{{old('calzado')}}" id="calzado">
                @error('calzado')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="facebook">facebook</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off"  placeholder="ejemplo.123" name="facebook" value="{{old('facebook')}}" id="facebook">

            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="instagram">Instagram</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off"  placeholder="ejemplo.123" name="instagram" value="{{old('instagram')}}" id="instagram">   
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="twitter">twitter</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input class="form-control" type="text" autocomplete="off"  placeholder="ejemplo12" name="twitter" value="{{old('twitter')}}" id="twitter">
                    
                </div>
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="tiktok">tiktok</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-text"  id="basic-addon1">@</span>
                    <input class="form-control" type="text" autocomplete="off"  placeholder="ejemplo12" name="tiktok" value="{{old('tiktok')}}" id="tiktok">
                </div>
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="otro">Otro</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off"  placeholder="Red social, cuenta" name="otro" value="{{old('otro')}}" id="otro">
            </div>
        </div><br> <hr> <br>

<h2>Datos de acudiente.</h2><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nombre_acudiente">Nombre completo *</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="nombre_acudiente" value="{{old('nombre_acudiente')}}" id="nombre_acudiente">
                @error('nombre_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br> 

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nid_acudiente">Número de identificación *</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" autocomplete="off" min="0" name="nid_acudiente" value="{{old('nid_acudiente')}}" id="nid_acudiente">
                @error('nid_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="expedido_acudiente">Lugar de expedición *</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="expedido_acudiente" value="{{old('expedido_acudiente')}}" id="expedido_acudiente">
                @error('expedido_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="parentezco">Parentezco *</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="parentezco" value="{{old('parentezco')}}" id="parentezco">
                @error('parentezco')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="direccion_acudiente">Dirección *</label>
            <div class="col-sm-6">
                <input class="form-control" type="text" autocomplete="off" name="direccion_acudiente" value="{{old('direccion_acudiente')}}" id="direccion_acudiente">
                @error('direccion_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="telefono_acudiente">Teléfono *</label>
            <div class="col-sm-6">
                <input class="form-control" type="tel" autocomplete="off" name="telefono_acudiente" value="{{old('telefono_acudiente')}}" id="telefono_acudiente">
                @error('telefono_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br> <hr> <br>

    <h2>Suscripción inicial.</h2> <br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="meses_pagados">Número de meses *</label>
            <div class="col-sm-6">
                <input class="form-control" type="number" autocomplete="off" min="0" max="999" name="meses_pagados" value="{{old('meses_pagados')}}" id="meses_pagados">
                @error('meses_pagados')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

    
        <div class="form-group row">
        <label class="control-label col-sm-3 d-flex justify-content-end" for="meses_pagados"></label>

            <div class="form-check col-sm-6">
                <input id="pago" class="form-check-input" type="checkbox" name="pago" value="true">
                <label for="pago" class="form-check-label"><small>¿Abonar una parte?</small></label>
            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="meses_pagados">Valor a abonar</label>
            <div class="col-sm-6">
            <input class="form-control" type="number" name="abona" id="abona" disabled placeholder="Valor en pesos">
                @error('abona')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        
        <div class="form-group row">
            <label for="medio_id" class="control-label col-sm-3 d-flex justify-content-end">Medio de pago</label>
            <div class="col-sm-3">
                <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" >
                <option  value="{{old('medio_id')}}">- Seleccione -</option>
                    @foreach($medios as $medio)
                        <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                    @endforeach
                </select>
                @error('medio_id')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="fecha_pago">Fecha de entrada en vigencia *</label>
            <div class="col-sm-6">
                <input class="form-control" type="date" autocomplete="off" name="fecha_pago" value="{{old('fecha_pago')}}" id="fecha_pago">
                @error('fecha_pago')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="observaciones">Observaciones</label>
            <div class="col-sm-6">
                <textarea class="form-control" style="width:100% ;" name="observaciones" id="observaciones" rows="3">{{old('observaciones')}}</textarea>

            </div>
        </div><br>
            
            <div class="col">
                
              <input id="registrar" type="submit" value="Registrar" class="float-end btn btn-outline-success">
            </div>



    


    </form>

</div>
</div>
</div>


<script>

$(document).ready(function(){
  

document.getElementById("formul").reset();
$( "#nombre" ).focus();

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

        function myFunction() {
            console.log('j')
        }
})

</script>
        

@endsection