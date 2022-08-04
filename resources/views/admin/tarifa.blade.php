@extends('layouts.app')

@section('content')

<div id="enter" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Tarifas de servicios</h5></div>

                <div class="card-body">
                   
                   <h5>Suscripción mensual</h5>
                   <br>

                   <p id="mesanterior"></p>

                 
                    <form  action="{{ url('/tarifaMes')}}" name="formulario" method="post" enctype='multipart/form-data' onKeyPress="if(event.keyCode == 13) event.returnValue = false;">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text"> $</span>
                            <input  name="tarifaMes" id="tarifaMes"required type="number"  class="form-control"  autocomplete="off">
                            <button type="buton onclick" value="enviar" class=" btn btn-outline-success" onclick="
                                const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
                                var v=document.getElementById('tarifaMes').value
                                var a=f.format(v);
                                return confirm('¿Establecer tarifa mensual en '+ a + '?')"  >Enviar</button>
              
                        </div>
                        <br>

                    </form>
                </div>
            </div>
                
                <div class="card">
                    <div class="card-body">
                    <h5>Pasarela</h5>
                   <br>
                   <div class="container" style="border:solid #bcddff; border-radius: 20px;">
                   <p><b>Nuevo evento:</b></p>
                        <form  action="{{ url('/tarifaP')}}" name="formulario" method="post" enctype='multipart/form-data' onKeyPress="if(event.keyCode == 13) event.returnValue = false;">
                            @csrf
                                <label for="nombre">Nombre del evento *</label>
                                <input class="form-control" type="text" name="nombre" id="nombre" required autocomplete="off">
                                <br>
                                <label for="nombre">Fecha *</label>
                                <input class="form-control" type="date" name="fecha" id="fecha" required autocomplete="off">
                                <br>
                                <label for="valor">Valor *</label>
                                <input class="form-control" type="number" name="valor" id="valor" required autocomplete="off">
                                <br>
                                <button type="submit" class="btn btn-primary" onclick="return confirm('¿Seguro de agregar evento?')">Guardar</button><br>
                                <br>

                        </form>
                    </div>
                    <br>
                    <h5>Lista de eventos</h5><br>
                    

                    <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                
                                <th>Nombre </th>
                                <th>Valor</th>
                                <th>Fecha</th>
                                <th >&nbsp;</th>

                                
                                
                            </tr> 
                        </thead>
                    
                        
                    </table>

                    </div>
                </div>
                
            
        </div>
    </div>
</div>

<script>


    $(document).ready(function(){

        
var table=$('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":"{{url('api/pasarela')}}",
               
                "columns":[
                    {data:'nombre'},
                    {data:'valor'},
                    {data:'fecha'},
                    {data:'btn',className: "text-center"},
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
        
        

        const mes = @json($mes);

        const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
        
    
        var a=f.format(mes);
        document.getElementById('mesanterior').innerHTML ='Precio actual establecido en: '+ a;

     
        
        
      
    });
</script>


@endsection
