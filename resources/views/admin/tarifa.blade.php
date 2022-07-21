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

                   <p id="panterior"></p>
                   
                    <form  action="{{ url('/tarifaP')}}" name="formulario" method="post" enctype='multipart/form-data' onKeyPress="if(event.keyCode == 13) event.returnValue = false;">
                        @csrf
                        <div class="input-group">
                            <span class="input-group-text"> $</span>
                            <input  name="tarifaP" id="tarifaP" required type="number" class="form-control"  autocomplete="off">
                            <button type="buton onclick" value="enviar" class=" btn btn-outline-success" onclick="
                                const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
                                var v=document.getElementById('tarifaP').value
                                var a=f.format(v);
                                return confirm('¿Establecer tarifa mensual en '+ a + '?')"  >Enviar</button>
              
                        </div>
                        <br>

                    </form>
                    </div>
                </div>
                
            
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        const mes = @json($mes);
        const pasarela = @json($pasarela);
        const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})
        
        var p=f.format(pasarela);
        var a=f.format(mes);
        document.getElementById('mesanterior').innerHTML ='Precio actual establecido en: '+ a;
        document.getElementById('panterior').innerHTML ='Precio actual establecido en: '+ p;
        
        console.log(p)
    });
</script>


@endsection
