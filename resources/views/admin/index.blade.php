@extends('layouts.app')

@section('content')


<div class="container">


            <div class="card">
                <div class="card-header"><h5>Renovar suscripción</h5></div>

                <div class="card-body">
                    <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre </th>
                                <th>Identificación</th>
                                <th>Suscripción</th>
                                <th >&nbsp;</th>
                                
                                
                            </tr> 
                        </thead>
                    
                        
                    </table>
                </div>
            </div>
        
</div>
<script>
    
        $('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":"{{url('api/datatable')}}",

                "columnDefs": [
                 { 'searchable': false, 
                    'targets': [0,4] }
                ],
                
                "columns":[
                    {data:'imagen'},
                    {data:'nombre'},
                    {data:'nid'},
                    {data:'estado'},
                    
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
@section('js')
    
@endsection