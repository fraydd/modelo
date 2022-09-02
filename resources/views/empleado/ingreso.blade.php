@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

    .imagen{
    height: auto;
    width: auto;
    max-width: 300px;
    max-height: 300px;
    border-radius: 5% ;
    overflow: hidden;
}
</style>
    <title>Document</title>
</head>
<body >
<div class="grid-block" style="background-image: url('images/fondo.png'); height: 100vh; min-height: 1000px; background-position: center; background-repeat: no-repeat; background-size: cover;">

<br>
<div class="container"  >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-transparent">
                <div class="card-header"><h4 style="color:white ;" >Registro ingreso de  usuarios.</h4></div>

                <div class="card-body">
                   
                <form  action="{{ url('/empleado')}}" method="post" enctype='multipart/form-data'>
                @csrf
                
                <div class="input-group mb-3">
                    <span class="input-group-text bg-transparent"  style="color:white ;">Ingrese su clave: </span>
                    
                    <input placeholder=" " autocomplete="off" type="text" style="color:white ;" class="form-control  bg-transparent" name="di" id="di" aria-label="Recipient's username" aria-describedby="button-addon2">
                    
                    <input type="submit" class="btn btn-outline-secondary" style="color:white ; border-color:white;" id="button-addon2">

                </div>

                
                    
                    
                
                </form>
                </div>
            </div>

                

                @if (session('error'))
                <br>
                <div class="des">
                    <div class=" alert alert-danger" role="alert">
                    
                    Usuario no encontrado!
                    </div>
                </div>
                <script>
                        $(document).ready(function(){
                            setTimeout(function(){
                                
                                $(".des").fadeOut(100);
                            },2000);  
                        })
                    </script>
                @endif
            

                @if(session('data'))
                <br>
                <div class="des card" id="fondo">
                    
                <div class=" card-body">
                    <h1>Bienvenido {{$data=json_decode(session('data'))}}!</h1><br>
                    <div class=" d-flex justify-content-center">
                        <img class="d-flex justify-content-center imagen" src="{{ asset(json_decode(session('foto'))) }}"  >
                    </div>
                    <br>
                    <h5 id="estado"></h5> 
                    <h5 id="a"> </h5><br>
                    
                    <p id="b"></p>
                    <p id="c"></p>
                    
                        
                       
                    </div>

                    
                </div>



                <div style="display: none">
                    {{$foto=json_decode(session('foto'))}}
                    {{$estado=json_decode(session('estado'))}}
                    {{$fecha_v=json_decode(session('fecha_v'))}}
                    {{$adeudos=json_decode(session('adeudos'))}}
                    
                    
                </div>




                
                    

                    <script>
                        $(document).ready(function(){




                            const estado = @json($estado);
                            const fecha_v = @json($fecha_v);
                            var adeudos=@json($adeudos);
                            adeudos=JSON.parse(adeudos);
                            
                            a=[];
                            b=[];
                            c=[];

                            for (let i = 0; i < adeudos.length; i++) {
                                if (adeudos[i]['tipo'].slice(0,8)=='pasarela') {
                                    a.push(adeudos[i]);
                                }
                                else if(adeudos[i]['tipo'].slice(0,11)=='Mensualidad'){
                                    b.push(adeudos[i]);
                                }else{
                                    c.push(adeudos[i]);
                                }
                                
                            
                                
                            }
                            console.log(a)

                            

                            if(estado==1){
                                var fondo = document.getElementById('fondo');
                                fondo.style.backgroundColor = '#d4edda';
                                
                                document.getElementById('estado').innerHTML ='Suscripción vigente hasta el: '+ fecha_v;
                                if (c.length>=1) {
                                    
                                    for (let i = 0; i < c.length; i++) {
                                        var mas3=new Date(c[i]['mas3'])
                                        var now=Date.now();
                                        
                                        if (now>=mas3) {
                                            
                                            document.getElementById('a').innerHTML ='Pago de <b>'+c[i]['tipo']+'</b> retrasado';
                                            fondo.style.backgroundColor = '#ffeaec';
                                            const music = new Audio('sounds/access.mp3');
                                            music.play();
                                        }
                                    }
                                    
                                }

                                if (a.length>=1) {
                                    
                                    for (let i = 0; i < a.length; i++) {
                                        var fecha=new Date(a[i]['fecha_evento'])
                                        var now=new Date(Date.now());
                                        now.setHours(0)
                                        now.setMinutes(0)
                                        fecha.setHours(0)
                                        fecha.setMinutes(0)
                                        fecha.setDate(fecha.getDate()+2)
                                        console.log(fecha,'a',now)
                                        
                                        if (fecha<now) {
                                            document.getElementById('a').innerHTML ='Pago de <b>'+a[i]['tipo']+'</b> retrasado';
                                            fondo.style.backgroundColor = '#ffeaec';
                                            const music = new Audio('sounds/access.mp3');
                                            music.play();
                                        }
                                    }
                                    
                                }

                                if (c.length>=1 || b.length>=1  || a.length>=1 ) {
                                    var texto=''
                                    const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})

                                    for (let j = 0; j < a.length; j++) {
                                        var tipo=a[j]['tipo']
                                        var valor= f.format(a[j]['monto'])
                                        var fecha=a[j]['fecha_evento']
                                        texto+=tipo
                                        texto+=' '+valor+'; &nbsp;<b>('+fecha+')</b><br>'
                                        
                                        
                                    }
                                    for (let j = 0; j < b.length; j++) {
                                        var tipo=b[j]['tipo']
                                        var valor= f.format(b[j]['monto'])
                                        texto+=tipo
                                        texto+=' '+valor+'<br>'
                                        
                                        
                                    }
                                    for (let j = 0; j < c.length; j++) {
                                        var tipo=c[j]['tipo']
                                        var valor= f.format(c[j]['monto'])
                                        
                                        texto+=tipo
                                        texto+=' '+valor+'<br>'
                                        
                                        
                                    }
                                   

                                    document.getElementById('b').innerHTML ='Pagos pendientes:<br>'+texto;
                                    
                                }
                            }else{
                                var fondo = document.getElementById('fondo');
                                fondo.style.backgroundColor = '#ffeaec';
                                document.getElementById('estado').innerHTML ='Suscripción vencida';
                                const music = new Audio('sounds/access.mp3');
                                music.play(); 
                                
                               

                                if (c.length>=1) {
                                    
                                    for (let i = 0; i < c.length; i++) {
                                        var mas3=new Date(c[i]['mas3'])
                                        var now=Date.now();
                                       
                                        if (now>=mas3) {
                                           
                                            document.getElementById('a').innerHTML ='Pago de <b>'+c[i]['tipo']+'</b> retrasado';
                                            fondo.style.backgroundColor = '#ffeaec';
                                            const music = new Audio('sounds/access.mp3');
                                            music.play();
                                        }
                                    }
                                    
                                }
                                if (a.length>=1) {
                                    
                                    for (let i = 0; i < a.length; i++) {
                                        var fecha=new Date(a[i]['fecha_evento'])
                                        var now=new Date(Date.now());
                                        now.setHours(0)
                                        now.setMinutes(0)
                                        fecha.setHours(0)
                                        fecha.setMinutes(0)
                                        fecha.setDate(fecha.getDate()+2)
                                        console.log(fecha,'a',now)
                                        
                                        if (fecha<now) {
                                            document.getElementById('a').innerHTML ='Pago de <b>'+a[i]['tipo']+'</b> retrasado';
                                            fondo.style.backgroundColor = '#ffeaec';
                                            const music = new Audio('sounds/access.mp3');
                                            music.play();
                                        }
                                    }
                                    
                                }
                                if (c.length>=1 || b.length>=1  || a.length>=1 ) {
                                    var texto=''
                                    const f =new Intl.NumberFormat('es-CO', {style: 'currency',currency: 'COP',minimumFractionDigits: 0})

                                    for (let j = 0; j < a.length; j++) {
                                        var tipo=a[j]['tipo']
                                        var valor= f.format(a[j]['monto'])
                                        var fecha=a[j]['fecha_evento']
                                        texto+=tipo
                                        texto+=' '+valor+'; &nbsp;<b>('+fecha+')</b><br>'
                                        
                                        
                                    }
                                    for (let j = 0; j < b.length; j++) {
                                        var tipo=b[j]['tipo']
                                        var valor= f.format(b[j]['monto'])
                                        texto+=tipo
                                        texto+=' '+valor+'<br>'
                                        
                                        
                                    }
                                    for (let j = 0; j < c.length; j++) {
                                        var tipo=c[j]['tipo']
                                        var valor= f.format(c[j]['monto'])
                                        texto+=tipo
                                        texto+=' '+valor+'<br>'
                                        
                                        
                                    }
                                 

                                    document.getElementById('b').innerHTML ='Pagos pendientes:<br>'+texto;
                                    
                                }
                            }
                           

                            setTimeout(function(){
                               
                                $(".des").fadeOut(100);
                            },5000);  
                        })
                        
                        
                    </script>
                    
   

                @endif

            
        </div>
    </div>
    <div>
    


    
</div>
</div>
</div> 





@endsection
</body>
</html>



