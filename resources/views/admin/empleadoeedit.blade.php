@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar datos de .</div>

                <div class="card-body">
                   
                    <form  action="{{ url('admin',$admin->id)}}"  method="post" enctype='multipart/form-data'>
                        @csrf
                        @method('put')


                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="nombre">Nombre completo *</label>
                            <div class="col-sm-6">
                                <input value="{{$admin->nombre}}" class="form-control"  type="text" autocomplete="off" required="required" name="nombre" id="nombre" required="required">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="cedula">Número de identidad *</label>
                            <div class="col-sm-6">
                                <input value="{{$admin->cedula}}" class="form-control"  type="number" autocomplete="off" required="required" name="cedula" id="cedula">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="direccion">Dirección *</label>
                            <div class="col-sm-6">
                                <input value="{{$admin->direccion}}" class="form-control"  type="text" autocomplete="off" required="required" name="direccion" id="direccion">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="telefono">Teléfono *</label>
                            <div class="col-sm-6">
                                <input value="{{$admin->telefono}}" class="form-control"  type="number" autocomplete="off" required="required" name="telefono" id="telefono">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="ingreso">Fecha de contratación *</label>
                            <div class="col-sm-6">
                                <input value="{{$admin->ingreso}}" class="form-control"  type="date" autocomplete="off" required="required" name="ingreso" id="ingreso">
                            </div>
                        </div><br>


                        <input id="registrar" type="submit" value="Guardar" class="float-end btn btn-outline-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
