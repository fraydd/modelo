@extends('layouts.app')

@section('content')

<div class="container">
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
            <div class="card">
                <div class="card-header"><h5>Registrar</h5></div>

                <div class="card-body">

                <form  action="{{ url('/modelos')}}" method="post" enctype='multipart/form-data'>
                @csrf
                <input type="text" name="nombre" id="nombre">
                <label for="nombre">nombre</label>
                <br>

                <input type="text" name="nid" id="nid">
                <label for="nid">nid</label>
                <br>

                <input type="text" name="expedido" id="expedido">
                <label for="expedido">expedido</label>
                <br>
                
                <input type="text" name="fechan" id="fechan">
                <label for="fechan">fechan</label>
                <br>
                
                <input type="text" name="direccion" id="direccion">
                <label for="direccion">direccion</label>
                <br>
                
                <input type="text" name="telefono" id="telefono">
                <label for="telefono">telefono</label>
                <br>
                

                <input type="text" name="estatura" id="estatura">
                <label for="estatura">estatura</label>
                <br>
                
                <input type="text" name="busto" id="busto">
                <label for="busto">busto</label>
                <br>
                
                <input type="text" name="cintura" id="cintura">
                <label for="cintura">cintura</label>
                <br>
                
                <input type="text" name="cadera" id="cadera">
                <label for="cadera">cadera</label>
                <br>
                
                <input type="text" name="cabello" id="cabello">
                <label for="cabello">cabello</label>
                <br>
                
                <input type="text" name="ojos" id="ojos">
                <label for="ojos">ojos</label>
                <br>
                
                <input type="text" name="piel" id="piel">
                <label for="piel">piel</label>
                <br>
                
                <input type="text" name="pantalon" id="pantalon">
                <label for="pantalon">pantalon</label>
                <br>
                
                <input type="text" name="camisa" id="camisa">
                <label for="camisa">camisa</label>
                <br>
                
                <input type="text" name="calzado" id="calzado">
                <label for="calzado">calzado</label>
                <br>
                

                <input type="text" name="facebook" id="facebook">
                <label for="facebook">facebook</label>
                <br>
                
                <input type="text" name="instagram" id="instagram">
                <label for="instagram">instagram</label>
                <br>
                
                <input type="text" name="twitter" id="twitter">
                <label for="twitter">twitter</label>
                <br>
                
                <input type="text" name="tiktok" id="tiktok">
                <label for="tiktok">tiktok</label>
                <br>
                
                <input type="text" name="otro" id="otro">
                <label for="otro">otro</label>
                <br>
                

                <input type="text" name="nombre_acudiente" id="nombre_acudiente">
                <label for="nombre_acudiente">nombre_acudiente</label>
                <br>
                
                <input type="text" name="nid_acudiente" id="nid_acudiente">
                <label for="nid_acudiente">nid_acudiente</label>
                <br>
                
                <input type="text" name="expedido_acudiente" id="expedido_acudiente">
                <label for="expedido_acudiente">expedido_acudiente</label>
                <br>
                
                <input type="text" name="parentezco" id="parentezco">
                <label for="parentezco">parentezco</label>
                <br>
                
                <input type="text" name="direccion_acudiente" id="direccion_acudiente">
                <label for="direccion_acudiente">direccion_acudiente</label>
                <br>
                
                <input type="text" name="telefono_acudiente" id="telefono_acudiente">
                <label for="telefono_acudiente">telefono_acudiente</label>
                <br>

                <input type="number" name="meses_pagados" id="meses_pagados">
                <label for="meses_pagados">Cantidad de meses</label>
                <br>

                <input type="text" name="fecha_pago" id="fecha_pago">
                <label for="fecha_pago">Fecha de inicio</label>
                <br>

                <label for="foto">Fotografía</label>
                <input  type="file" name="foto" id="foto">

                <input id="registrar" type="submit" value="Registrar" class="float-end btn btn-outline-success">
                
                </form>
                </div>
                
            </div>

            <script>
                            $(document).ready(function(){
                                
                                var a="hola"
                                document.getElementById("registrar").onclick = function() {myFunction()};

                                function myFunction() {
                                    setTimeout(function(){
                                        location.reload();
                                    },300);
                                    
                                }

                            })
            </script>
        
</div>
@endsection