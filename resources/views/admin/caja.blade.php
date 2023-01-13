@extends('layouts.app')

@section('content')

<style>
    .nav-tabs .nav-link.active,.show>.nav-tabs .nav-link{
    color:#0eaacb !important
}
.nav-tabs .nav-link,.show>.nav-tabs .nav-link{
    color:#505050 !important
}
.obs{
    color: #dedede;
    background-color: orange;
    border-style: none;
    border-radius: 10%;
    cursor:help;
}
</style>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5>Caja</h5></div>

                <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Nuevo ingreso</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Nuevo egreso</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <br>
                        <form id="Formulario1" name="Formulario1"  action="{{ url('/caja')}}" method="post" enctype='multipart/form-data'>
                            @csrf
                            <div class="form-group row">
                                <label for="concepto" class="col-sm-2 col-form-label">Concepto</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off"  type="text" class="form-control" name="concepto" id="concepto" placeholder="Concepto" required>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="valor" class="col-sm-2 col-form-label">Valor</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off" type="number" class="form-control" name="valor" id="valor" placeholder="$" required>
                                    </div>
                            </div><br>

                            <div class="form-group row">
                                <label for="paga" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off" type="text" class="form-control" name="paga" id="paga" placeholder="Persona que paga" required>
                                    </div>
                            </div><br>


                            <div class="form-group row">
                            <label for="paga" class="col-sm-2 col-form-label">Medio de pago</label>

                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" required>
                                    <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                        @foreach($medios as $medio)
                                            <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <br>

            


                            <div class="form-group row">
                                <label for="observaciones">Observaciones</label>
                                <div >
                                    <textarea class="form-control" name="observaciones" id="observaciones" ></textarea>
                                            
                                </div>
                            </div> 
                            <br>
                            <input id="Guardar" type="submit" value="Guardar" class="float-end btn btn-outline-success" onclick="return confirm('¿Estás seguro de agragar un nuevo ingreso?')" >
                        
                        </form>
                        <!-- Egresos -->
                        
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <br>
                        <form id="Formulario2" name="Formulario2" action="{{ url('/cajaegreso')}}" method="post" enctype='multipart/form-data'>
                            @csrf

                            <div class="form-group row">
                                <label for="concepto" class="col-sm-2 col-form-label">Concepto</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off" type="text" class="form-control" name="concepto" id="concepto" placeholder="Concepto" required>
                                </div>
                            </div>
                            <br>

                            <div class="form-group row">
                                <label for="valor" class="col-sm-2 col-form-label">Valor</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off" type="number" class="form-control" name="valor" id="valor" placeholder="$" required>
                                    </div>
                            </div><br>

                            <div class="form-group row">
                                <label for="paga" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input autocomplete="off" type="text" class="form-control" name="paga" id="paga" placeholder="Persona a quien se paga" required>
                                    </div>
                            </div><br>

                            <div class="form-group row">
                                <label for="paga" class="col-sm-2 col-form-label">Medio de pago</label>
                                <div class="col-sm-4">
                                    <select class="form-select" aria-label="Default select example"  name="medio_id" id="medio_id" required>
                                    <option  value="{{old('medio_id')}}">- Seleccione -</option>
                                        @foreach($medios as $medio)
                                            <option value="{{ $medio['id'] }}">  {{ $medio['medio'] }}  </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><br>

                            <div class="form-group row">
                                <label for="observaciones">Observaciones</label>
                                <div >
                                    <textarea class="form-control" name="observaciones" id="observaciones" ></textarea>
                                            
                                </div>
                            </div> 
                            <br>
                            <input id="Guardar" type="submit" value="Guardar" class="float-end btn btn-outline-success" onclick="return confirm('¿Estás seguro de agragar un nuevo egreso?')">
                        </form>
                    </div>
                    
                </div>

            </div>
        </div><br>



            
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
                                <th>&nbsp;</th>
                            </tr> 
                        </thead>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>
<script>
$(document).ready( function () {
        var tabla=$('#tabla').DataTable({

            "rowCallback": function( row, data, index) {
                A=data['valor']
                if(data['estado']==1){
                    
                    $('td:eq(3)', row).html( '<p style="border-radius:30px; background-color: #A9FFC9; text-align:center;">$ '+A+'</p>' );

                }else{
                    $('td:eq(3)', row).html( '<p style="border-radius:30px; background-color: #FFA9A9; text-align:center;">$ '+A+'</p>' );

                }
            },

                "serverSide": true,
                "ordering": true,
                "order": [[ 4, 'des' ]],
                
                "ajax":"{{url('api/datatable3')}}",
               
                "columns":[
                    {data:'concepto'},
                    {data:'paga'},
                    {data:'recibe'},
                    {data:'valor'},
                    {data:'created_at'},
                    {data:null,"render":function(o){return '<button id="obs" class="obs" style=";" title="'+o.observaciones+'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg></button>'}},

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
                    },  
            }
        });
    });
    
    </script>

@endsection
