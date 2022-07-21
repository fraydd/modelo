@extends('layouts.app')

@section('content')



<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header">

        <h5>Registro de turnos de empleados.</h5>
    </div>

                    
    <div class="card-body">
    <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ingreso</th>
                                <th>Salida</th>
                            </tr> 
                        </thead>
                    
                        
                    </table>
    </div>
</div>
</div>
</div>
</div>
<script>
    const link="{{url('api/datatable6')}}"
    console.log(link);
    
        $('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":link,

                "columnDefs": [
                 { 'searchable': false, 
                    'targets': [] }
                ],
                
                "columns":[
                    {data:'nombre'},
                    {data:'create'},
                    {data:'update'},
                    

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
    
    </script>
                  

@endsection