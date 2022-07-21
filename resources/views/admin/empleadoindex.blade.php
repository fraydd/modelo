@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>lista de empleados</h5></div>

                <div class="card-body">
                <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                
                                <th>Nombre </th>
                                <th>Identificación</th>
                                <th>Fecha de Contratación</th>
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
    
        $('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":"{{url('api/datatable2')}}",
               
                "columns":[
                    {data:'nombre'},
                    {data:'cedula'},
                    {data:'ingreso'},
                    
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
    
    </script>

@endsection
