@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Caja</h5></div>

                <div class="card-body">
                   
                 <p>Nuevo ingreso</p>

                 <form  action="{{ url('/caja')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group row">
                        <label for="concepto" class="col-sm-2 col-form-label">Concepto</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="concepto" id="concepto" placeholder="Concepto">
                        </div>
                    </div>
                    <br>

                    <div class="form-group row">
                        <label for="valor" class="col-sm-2 col-form-label">Valor</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="valor" id="valor" placeholder="Valor en pesos">
                            </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="paga" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="paga" id="paga" placeholder="Persona que paga">
                            </div>
                    </div><br>

                    <input id="Guardar" type="submit" value="Guardar" class="float-end btn btn-outline-success">
                   
                </form>


                


                </div>
            </div>

<br>
            <div class="card">
                <div class="card-header"><b>Registros de caja</b></div>

                <div class="card-body">
                <table class="table table-strped  table-hover shadow-sm " id="tabla">
                        <thead>
                            <tr>
                                
                                <th>Concepto </th>
                                <th>Paga</th>
                                <th>Recibe</th>
                                <th >Valor</th>
                                <th >Timestamp</th>
                                
                                
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
                
                "ajax":"{{url('api/datatable3')}}",
               
                "columns":[
                    {data:'concepto'},
                    {data:'paga'},
                    {data:'recibe'},
                    {data:'valor'},
                    {data:'created_at'},

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
