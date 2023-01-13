@extends('layouts.app')

@section('content')
<style>
    .nav-tabs .nav-link.active,.show>.nav-tabs .nav-link{
    color:#0eaacb !important
}
.nav-tabs .nav-link,.show>.nav-tabs .nav-link{
    color:#505050 !important
}
    label.error {
    color: red;
    font-size: 1rem;
    display: block;
    margin-top: 5px;
}
input.error {
    border: 1px dashed red;
    font-weight: 300;
    color: red;
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
        <div class="col-md-12">
            <div class="card">
                
            @if(session('borrado'))
                    <div class="alert alert-success" role="alert">
                        Registro borrado correctamente!
                    </div>
                    <script>
                        setTimeout(function(){
                    
                            $(".alert").fadeOut(100);
                            
                        },3000);
                        
                    </script>
                @endif

                @if(session('noborrado'))
                    <div class="alert alert-danger" role="alert">
                        Error al borrar registro!
                    </div>
                    <script>
                        setTimeout(function(){
                    
                            $(".alert").fadeOut(100);
                            
                        },3000);
                        
                    </script>
                @endif
                <div class="card-header"><h5>Caja</h5></div>

                <div class="card-body">
                    
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Nuevo ingreso</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Nuevo egreso</button>
                        <button class="nav-link" id="nav-caja-tab" data-bs-toggle="tab" data-bs-target="#nav-caja" type="button" role="tab" aria-controls="nav-caja" aria-selected="false">Cierre de caja</button>
                    
                    </div>
                </nav>
                <div style="min-height: 200px; border:solid;border-color:#dedede ; border-radius:2%; border-width:0px 1px 1px 1px; padding:0px 10px 0px 10px;" class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <br>
                        <form id="Formulario1"  action="{{ url('/caja')}}" method="post" enctype='multipart/form-data'>
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
                                <div class="col-sm-2">
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
                            </div> <br>
                            
                             
                            <input id="Guardar" type="submit" value="Guardar" class="float-end btn btn-outline-success" onclick="return confirm('¿Estás seguro de agragar un nuevo ingreso?')">


                            
                        
                        </form>
                    </div>


                    <!-- Egreso -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <br>
                        <form id="Formulario2"  action="{{ url('/cajaegreso')}}" method="post" enctype='multipart/form-data'>
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
                                <div class="col-sm-2">
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
                            </div> <br>
                            
                             
                            <input id="Guardar" type="submit" value="Guardar" class="float-end btn btn-outline-success" onclick="return confirm('¿Estás seguro de agragar un nuevo egreso?')">
                        
                        </form>

                    </div>

                    <div class="tab-pane" id="nav-caja" role="tabpanel" aria-labelledby="nav-caja-tab">
                    <br>
                        <form id="Formulario3"  action="" method="post" enctype='multipart/form-data'>
                            @csrf
                            
                            <div class="row">
                                <div class="col-2">
                                   
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn ">
                                            <input type="checkbox" name="ingresos" id="ingresos" checked> 
                                            Ingresos
                                        </label>
                                    </div>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn ">
                                            <input type="checkbox" name="egresos" id="egresos"> 
                                            Egresos
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="col-3">
                                    <div class="form-outline">
                                        <label for="inicio" class="form-label d-flex justify-content-center">Fecha de inicio</label>
                                        <input autocomplete="off" type="date" class="form-control" name="inicio" id="inicio"  required>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-outline">
                                        <label for="fin" class="form-label d-flex justify-content-center">Fecha final</label>
                                        <input autocomplete="off" type="date" class="form-control" name="fin" id="fin"  required>
                                    </div>
                                </div>
                                </div>
                           
                            
                        </form>
                        <br>
                        <hr>
                        <button style="margin:5px ;" id="excel" class="btn btn-outline-success btn-sm" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel" viewBox="0 0 16 16">
                            <path d="M5.884 6.68a.5.5 0 1 0-.768.64L7.349 10l-2.233 2.68a.5.5 0 0 0 .768.64L8 10.781l2.116 2.54a.5.5 0 0 0 .768-.641L8.651 10l2.233-2.68a.5.5 0 0 0-.768-.64L8 9.219l-2.116-2.54z"/>
                            <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            </svg>
                        </button>
                        <button style="margin:5px ;" id="pdf" class="btn btn-outline-danger btn-sm" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.6 11.85H0v3.999h.791v-1.342h.803c.287 0 .531-.057.732-.173.203-.117.358-.275.463-.474a1.42 1.42 0 0 0 .161-.677c0-.25-.053-.476-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.545 1.333a.795.795 0 0 1-.085.38.574.574 0 0 1-.238.241.794.794 0 0 1-.375.082H.788V12.48h.66c.218 0 .389.06.512.181.123.122.185.296.185.522Zm1.217-1.333v3.999h1.46c.401 0 .734-.08.998-.237a1.45 1.45 0 0 0 .595-.689c.13-.3.196-.662.196-1.084 0-.42-.065-.778-.196-1.075a1.426 1.426 0 0 0-.589-.68c-.264-.156-.599-.234-1.005-.234H3.362Zm.791.645h.563c.248 0 .45.05.609.152a.89.89 0 0 1 .354.454c.079.201.118.452.118.753a2.3 2.3 0 0 1-.068.592 1.14 1.14 0 0 1-.196.422.8.8 0 0 1-.334.252 1.298 1.298 0 0 1-.483.082h-.563v-2.707Zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638H7.896Z"/>
                            </svg>
                        </button>



                    
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
                                <th>Medio</th>
                                <th >Timestamp</th>
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
$(document).ready( function () {


    $("#ingresos").change(function() {
        if ($('#ingresos').is(":checked")==false || $('#egresos').is(":checked")==false) {
            $("#ingresos").prop("checked", true);
            
        }

        $("#egresos").prop("checked", false);

    
  });

  $("#egresos").change(function() {
    if ($('#egresos').is(":checked")==false || $('#ingresos').is(":checked")==false) {
            $("#egresos").prop("checked", true);
            
        }
    
    $("#ingresos").prop("checked", false);


});
    $( "#excel" ).click(function() {
        var inicio=$("#inicio").val()
        var fin=$("#fin").val()
        var ini= new Date(inicio).getTime()
        var fi=new Date(fin).getTime()
        console.log(ini,fi,ini<=fi)

        $("#Formulario3").validate({
            rules:{
                inicio : {required: true},
                fin:{required: true},

            },
            messages:{       
                    inicio:{required:"Campo requerido"},
                    fin:{required:"Campo requerido"}
                    }
        });
      
        if (ini<fi || isNaN(ini) || isNaN(fi)) {
            
        $('#Formulario3').attr('action', '{{ url("/cierreCaja")}}');
        $( "#Formulario3" ).submit();
        }
        else{
            alert('La fecha de inicio debe ser menor que la final')
        }
        
    });

    $( "#pdf" ).click(function() {
        var inicio=$("#inicio").val()
        var fin=$("#fin").val()
        var ini= new Date(inicio).getTime()
        var fi=new Date(fin).getTime()
        console.log(ini,fi,ini<=fi)

        $("#Formulario3").validate({
            rules:{
                inicio : {required: true},
                fin:{required: true},

            },
            messages:{       
                    inicio:{required:"Campo requerido"},
                    fin:{required:"Campo requerido"}
                    }
        });
      
        if (ini<fi || isNaN(ini) || isNaN(fi)) {
            
        $('#Formulario3').attr('action', '{{ url("/cierreCajaPdf")}}');
  
        
        $( "#Formulario3" ).submit();
        }
        else{
            alert('La fecha de inicio debe ser menor que la final')
        }
        
    });
    
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
                "order": [[ 5, 'des' ]],
                
                "ajax":"{{url('api/cajaroot')}}",
               
                "columns":[
                    {data:'concepto'},
                    {data:'paga'},
                    {data:'recibe'},
                    {data:'valor'},
                    {data:'medio_id'},
                    {data:'created_at'},
                    {data:null,"render":function(o){return '<button id="obs" class="obs" style=";" title="'+o.observaciones+'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16"><path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg></button>'}},
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
                    },

                    
                

                       
                    
                
            }
        });
    });
    
    </script>

@endsection
