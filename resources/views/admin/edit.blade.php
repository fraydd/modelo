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

        <h5>Editar datos de <b>{{$modelo->nombre}}</b></h5>
    </div>

                    
<div class="card-body">
    <h2>Datos personales.</h2><br>
    <form id="formul" action="{{ url('modelos',$modelo->id)}}" method="post" enctype='multipart/form-data'>
        @csrf
        @method('put')
        
        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nombre">Nombre completo *</label>
            <div class="col-sm-6">
                <input class="form-control"  type="text" autocomplete="off"  value="{{$modelo->nombre}}" name="nombre" id="nombre" >
                @error('nombre')
                    
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nid">Número de identificación*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->nid}}" class="form-control" type="number"  autocomplete="off" name="nid" id="nid" min="0" >
                @error('nid')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
        <label class="control-label col-sm-3 d-flex justify-content-end" for="identification_id">Tipo de documento*</label>

            <div class="col-sm-6">
            <select  class="form-select"  name="identification_id" id="identification_id" aria-placeholder="pais" onkeypress="return tabular(event,this)">
            <option value="{{$modelo->identification_id}}">{{$identificacion->tipo}}</option>
                @foreach($identifications as $identification)
                    <option value="{{ $identification['id'] }}">  {{ $identification['desc'] }}  </option>
                @endforeach
            </select>

            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="expedido">Lugar de expedición*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->expedido}}" class="form-control" type="text" autocomplete="off"  name="expedido" id="expedido" >  
                @error('expedido')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="fechan">Fecha de nacimiento*</label> 
            <div class="col-sm-6">
                <input value="{{$modelo->fechan}}" class="form-control" type="date" name="fechan" id="fechan" >
                @error('fechan')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="sex_id">Sexo*</label>
            <div class="col-sm-6">
                <select  class="form-select"  name="sex_id" id="sex_id"  onkeypress="return tabular(event,this)">
                <option value="{{$modelo->sex_id}}">{{$sex->tipo}}</option>

                    @foreach($sexes as $sexe)
                        <option value="{{ $sexe['id'] }}">  {{ $sexe['tipo'] }}  </option>
                    @endforeach
                </select> 
            </div>
        </div><br>
        
        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="expedido">G.S. RH*</label>
            <div class="col-sm-6">
                <select  class="form-select"  name="rh_id" id="rh_id" onkeypress="return tabular(event,this)">
                <option value="{{$modelo->rh_id}}">{{$rh->tipo}}</option>

                    @foreach($rhs as $rh)
                        <option value="{{ $rh['id'] }}">  {{ $rh['tipo'] }}  </option>
                    @endforeach
                </select>
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="direccion">Dirección*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->direccion}}" class="form-control" type="text" autocomplete="off"  name="direccion" id="direccion">  
                @error('direccion')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="telefono">Teléfono*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->telefono}}" class="form-control" type="tel" autocomplete="off"  name="telefono" id="telefono">  
                @error('telefono')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="correo">E-Mail*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->correo}}"v class="form-control" type="email" autocomplete="off"  name="correo" id="correo">  
                @error('correo')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>
<div class="col-sm-6"></div>
        <div class="form-group row">
            
            <label class="control-label col-sm-3 d-flex justify-content-end" for="foto">Fotografía *</label>
            <div class="col-sm-6">
                <input  class="form-control" type="file"  name="foto" id="foto" accept="image/*">
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
                <input value="{{$modelo->estatura}}" class="form-control" type="number" autocomplete="off"  placeholder="En metros ej. 1,70" min="0" step=".01" name="estatura" id="estatura">
                @error('estatura')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="busto">Busto*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->busto}}" class="form-control" type="number" autocomplete="off"  min="0" name="busto" id="busto">
                @error('busto')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="cintura">Cintura*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->cintura}}" class="form-control" type="number" autocomplete="off"  min="0" name="cintura" id="cintura">
                @error('cintura')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="cadera">Cadera*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->cadera}}" class="form-control" type="number" autocomplete="off"  min="0" name="cadera" id="cadera">
                @error('cadera')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>


        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="cabello">Cabello*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->cabello}}" class="form-control" type="text" autocomplete="off"  name="cabello" id="cabello">
                @error('cabello')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="ojos">Ojos*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->ojos}}" class="form-control" type="text" autocomplete="off"  name="ojos" id="ojos">
                @error('ojos')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="piel">Piel*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->piel}}" class="form-control" type="text" autocomplete="off"  name="piel" id="piel">
                @error('piel')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="pantalon">Pantalón*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->pantalon}}" class="form-control" type="text" autocomplete="off"  name="pantalon" id="pantalon">
                @error('pantalon')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="camisa">Camisa*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->camisa}}" class="form-control" type="text" autocomplete="off"  name="camisa" id="camisa">
                @error('camisa')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="calzado">calzado*</label>
            <div class="col-sm-6">
                <input value="{{$modelo->calzado}}" class="form-control" type="text" autocomplete="off"  name="calzado" id="calzado">
                @error('calzado')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="facebook">facebook</label>
            <div class="col-sm-6">
                <input value="{{$modelo->facebook}}" class="form-control" type="text" autocomplete="off"  placeholder="ejemplo.123" name="facebook" id="facebook">

            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="instagram">Instagram</label>
            <div class="col-sm-6">
                <input value="{{$modelo->instagram}}" class="form-control" type="text" autocomplete="off"  placeholder="ejemplo.123" name="instagram" id="instagram">   
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="twitter">twitter</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input value="{{$modelo->twitter}}" class="form-control" type="text" autocomplete="off"  placeholder="ejemplo12" name="twitter" id="twitter">
                    
                </div>
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="tiktok">tiktok</label>
            <div class="col-sm-6">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">@</span>
                    <input value="{{$modelo->tiktok}}" class="form-control" type="text" autocomplete="off"  placeholder="ejemplo12" name="tiktok" id="tiktok">
                </div>
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="otro">Otro</label>
            <div class="col-sm-6">
                <input value="{{$modelo->otro}}" class="form-control" type="text" autocomplete="off"  placeholder="Red social, cuenta" name="otro" id="otro">
            </div>
        </div><br> <hr> <br>

<h2>Datos de acudiente.</h2><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nombre_acudiente">Nombre completo *</label>
            <div class="col-sm-6">
                <input value="{{$modelo->nombre_acudiente}}" class="form-control" type="text" autocomplete="off"  name="nombre_acudiente" id="nombre_acudiente">
                @error('nombre_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br> 

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="nid_acudiente">Número de identificación *</label>
            <div class="col-sm-6">
                <input value="{{$modelo->nid_acudiente}}" class="form-control" type="number" autocomplete="off"  min="0" name="nid_acudiente" id="nid_acudiente">
                @error('nid_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="expedido_acudiente">Lugar de expedición *</label>
            <div class="col-sm-6">
                <input value="{{$modelo->expedido_acudiente}}"v class="form-control" type="text" autocomplete="off"  name="expedido_acudiente" id="expedido_acudiente">
                @error('expedido_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="parentezco">Parentezco *</label>
            <div class="col-sm-6">
                <input value="{{$modelo->parentezco}}" class="form-control" type="text" autocomplete="off"  name="parentezco" id="parentezco">
                @error('parentezco')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="direccion_acudiente">Dirección *</label>
            <div class="col-sm-6">
                <input value="{{$modelo->direccion_acudiente}}"  class="form-control" type="text" autocomplete="off"  name="direccion_acudiente" id="direccion_acudiente">
                @error('direccion_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br>

        <div class="form-group row">
            <label class="control-label col-sm-3 d-flex justify-content-end" for="telefono_acudiente">Teléfono *</label>
            <div class="col-sm-6">
                <input value="{{$modelo->telefono_acudiente}}" class="form-control" type="tel" autocomplete="off"  name="telefono_acudiente" id="telefono_acudiente">
                @error('telefono_acudiente')
                    <small style="color:brown ;" >*{{$message}}</small>
                    <br>
                @enderror
            </div>
        </div><br> 



            
            <div class="col">
                
              <input id="registrar" type="submit" value="Registrar" class="float-end btn btn-outline-success">
            </div>


    </form>

</div>
</div>
</div>

     
        

@endsection