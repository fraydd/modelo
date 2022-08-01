@extends('layouts.app')

@section('content')
<style>
    .activ{
        background-color:#ABEBC6;
        text-align: center;
        border: black;
        border-radius: 20px;
        color: black;

    }
    .caduc{
        background-color:#E74C3C;
        text-align: center;
        border: black;
        border-radius: 20px;
        color: white;
        
    }
</style>

<div class="container">


            <div class="card">
                <div class="card-header"><h5>Lista de usuarios.</h5></div>

                <div class="card-body">
                    <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nombre </th>
                                <th>Identificación</th>
                                <th>Medidas</th>
                                <th>Suscripción</th>
                                <th>Vigencia</th>
                                <th >&nbsp;</th>
                                
                                
                            </tr> 
                        </thead>
                    
                        
                    </table>
                </div>
            </div>
        
</div>
<script>
    const link="{{url('api/datatable')}}"
    console.log(link);
    
        var tabla=$('#tabla').DataTable(
            {
                "serverSide": true,
                
                "ajax":link,

                "columnDefs": [
                 { 'searchable': false, 
                    'targets': [0,6] }
                ],
                
                "columns":[
                    {data:'imagen'},
                    {data:'nombre'},
                    {data:'nid'},
                    {data:'fac'},
                    {data:'estado'},
                    {data:'fecha_vence'},
                    
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
                
            }
        });

             tabla.on("init",function(){
            console.log('listo')
            for (let j = 0; j < tabla.rows().count(); j++) {
                 var cell=tabla.cell(j,4)
                 var estado=cell.data();

                 if (estado=='Activo') {
                    
                    $(cell.node()).text("")
                    $(cell.node()).append("<p class='activ'>Activo</p>")
                 }else{
                    $(cell.node()).text("")
                    $(cell.node()).append("<p class='caduc'>Caducado</p>")
                 }
                console.log(cell.node())
            }
           
            


            
        });
       
       
    
    </script>
@endsection
@section('js')
    
@endsection