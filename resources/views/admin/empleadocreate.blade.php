@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Registrar empleado.</h5></div>

                <div class="card-body">
                    <p>Los empleados que se registren con este formulario aplicaran para la funcionalidad de ingreso y salida pero <b>NO</b> tendrán una cuenta en la plataforma.</p>
                   
                    <form  action="{{ url('admin')}}"  method="post" enctype='multipart/form-data'>
                        @csrf


                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="nombre">Nombre completo *</label>
                            <div class="col-sm-6">
                                <input class="form-control"  type="text" autocomplete="off" required="required" name="nombre" id="nombre" required="required">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="cedula">Número de identidad *</label>
                            <div class="col-sm-6">
                                <input class="form-control"  type="number" autocomplete="off" required="required" name="cedula" id="cedula">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="direccion">Dirección *</label>
                            <div class="col-sm-6">
                                <input class="form-control"  type="text" autocomplete="off" required="required" name="direccion" id="direccion">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="telefono">Teléfono *</label>
                            <div class="col-sm-6">
                                <input class="form-control"  type="number" autocomplete="off" required="required" name="telefono" id="telefono">
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label class="control-label col-sm-3 d-flex justify-content-end" for="ingreso">Fecha de contratación *</label>
                            <div class="col-sm-6">
                                <input class="form-control"  type="date" autocomplete="off" required="required" name="ingreso" id="ingreso">
                            </div>
                        </div><br>


                        <input id="registrar" type="submit" value="Registrar" class="float-end btn btn-outline-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
