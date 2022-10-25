
    <style>
        h1{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: black;
            font-size: larger;
        }
        td{
            border: solid;
            font-size: small;
        }
        table {
            border-collapse: collapse;
        }
        .valor{
            text-align:right;
            min-width: 70px;
        }
        .fecha{
            text-align: center;
        }
        .medio{
            text-align: center;
        }
        tr{
            font-size: small;
        }
    </style>
    <h1 >Cierre de caja <small>{{$rango}}</small>  ({{$estado}})</h1>
    <p>Fecha de consulta :  {{$now}}</p>
    <table>
        <thead>
            <tr>
                <th>PAGA</th>
                <th>RECIBE</th>
                <th>CONCEPTO</th>
                <th>MEDIO DE PAGO</th>
                <th > VALOR </th>
                <th>FECHA Y HORA</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cajas as $caja)
                <tr>
                    <td>{{$caja->paga}}</td>
                    <td>{{$caja->recibe}}</td>
                    <td>{{$caja->concepto}}</td>
                    <td class="medio">{{$caja->medio_id}}</td>
                    <td class="valor">{{$caja->valor}}</td>
                    <td class="fecha">{{$caja->fecha}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>TOTAL</td>
                <td>{{$suma}}</td>
                <td>&nbsp;</td>

            </tr>
        </tfoot>
        


        
        
    </table>
