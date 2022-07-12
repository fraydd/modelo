@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">crear empleado</div>

                <div class="card-body">
                   
                    <form  action="{{ url('admin')}}"  method="post" enctype='multipart/form-data'>
                        @csrf
                        <input type="text" name="nombre" id="nombre" required>
                        <label for="nombre">Nombre completo</label>
                        <br>

                        <input type="number" name="cedula" id="cedula" required>
                        <label for="cedula">Número de identidad</label>
                        <br>

                        <input type="text" name="direccion" id="direccion" required>
                        <label for="direccion">Dirección</label>
                        <br>

                        <input type="number" name="telefono" id="telefono" required >
                        <label for="telefono">Teléfono</label>
                        <br>

                        <input  type="text" name="ingreso" id="ingreso" >
                        <label for="ingreso">Fecha de contratación</label>
                        <br>

                        <input id="registrar" type="submit" value="Registrar" class="float-end btn btn-outline-success">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
