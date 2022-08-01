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

var table=$('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":"{{url('api/pasarela')}}",
               
                "columns":[
                    {data:'nombre'},
                    {data:'valor'},
                    {defaultContent: '<a id="borrar" title="Eliminar" href="" class="borrar btn btn-outline-danger btn-sm" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/></svg></a>'}

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
        
        borrarfcn("#tabla tbody",table)
        function borrarfcn(tbody, table){
            $(tbody).on("click","a.borrar", function(){
                var data=table.row($(this).parents("tr")).data();
                var id=data['id']
                var url="{{route('admin.borrarp', 1)}}"
                url = url.replace('1', id);
                $('#borrar').attr('href',url);
                console.log(id)
            })
        }

    $(document).ready(function(){
        const mes = @json($mes);

        const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
        
    
        var a=f.format(mes);
        document.getElementById('mesanterior').innerHTML ='Precio actual establecido en: '+ a;
        
        
      
    });
</script>


@endsection
