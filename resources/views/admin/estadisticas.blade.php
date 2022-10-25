@extends('layouts.app')

@section('content')


<div class="container">
    
        
    <div class="card">
        <div class="card-header"><h5>Estadísticas</h5></div>

        <div class="card-body">
        <div class="components">
        </div>

            <div class="d-flex justify-content-center" >
                    <div  style=" width:700px; height:auto;">

                    <table style="border:solid #5CC0F7 ;" class="table table-bordered ">
                            
                            <thead>
                                <tr>
                                    <th scope="col"> Parámetro</th>
                                    <th scope="col"> Valor</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>Número de usuarios registrados:&nbsp; </td>
                                <td>{{$nregistros}}</td>
                            </tr>
                            <tr>
                                <td>Número de empleados registrados</td>
                                <td>{{$nempleados}}</td>
                            </tr>
                            <tr>
                                <td>Promedio de edad de usuarios</td>
                                <td>{{$promedio}} &nbsp; Años</td>
                            </tr>
                            <tr>
                                <td>Promedio de busto</td>
                                <td>{{$promb}} &nbsp; cm</td>
                            </tr>
                            <tr>
                                <td>Promedio de cintura</td>
                                <td>{{$promci}} &nbsp; cm</td>
                            </tr>
                            <tr>
                                <td>Promedio de cadera</td>
                                <td>{{$promca}} &nbsp; cm</td>
                            </tr>
                        </table>             
                    </div>
                    
            </div>
            <br>
            <div >
                <canvas id="chart-ingresos" width="15" height="6"></canvas>
            </div><br>
            
            <canvas id="chart-edades" width="15" height="5"></canvas>
            <br>
            <canvas id="chart-estaturas" width="15" height="6"></canvas>
            <br>
            <div class="d-flex justify-content-center" style="width:auto; height:400px; ">
                <div  style="width:400px ; height:400px; ">
                                <canvas id="chart-sex" width="15" height="6"></canvas>
                            </div>
            </div><br>
           
            

            
            
    
        </div>
    </div>
<script>
    $(document).ready(function(){
        const data = JSON.parse(`<?php echo $data; ?>`)
       

        const ctx=document.getElementById('chart-edades').getContext('2d');
            const edadGraph =new Chart(ctx,{
                type: 'bar',
                data: {
                            labels: data.rangos,
                            datasets: [{
                            label: '#',
                            
                            data: data.edad,
                            backgroundColor:[
                                'rgba(255, 105, 25)',

                            ],
                            hoverBackgroundColor:[
                                'rgba(255, 156, 102)',
                            ],
                            borderWidth: 1,
                            borderColor:[
                                'rgba(0,0,0)',
                            ]
                        }]
                },
                options:{
                    indexAxis: 'y',
                    plugins: {
                        responsive: true,
                        legend:{
                            display: false,
                        },
                        title:{
                            display: true,
                            text:'Rangos de edad'
                        },
                    },
                    
                    scales:{
                        xAxes:{
                            title:{
                                display: true,
                                text:'N° de personas'
                            },
                            
                            
                                ticks:{
                                    display: true,
                                    beginAtZero: true,
                                    stepSize: 1,
                                }
                            
                        },
                        yAxes:{
                            title:{
                                display:true,
                                text: 'Rangos de edad'
                            },
                            
                        }
                    }
                }
            
            });


            const ptx=document.getElementById('chart-estaturas').getContext('2d');
            const estaturaGraph =new Chart(ptx,{
                type: 'bar',
                data: {
                            labels: data.rangoses,
                            datasets: [{
                            label: '#',
                            
                            data: data.estatura,
                            backgroundColor:[
                                'rgba(255, 105, 25)',

                            ],
                            hoverBackgroundColor:[
                                'rgba(255, 156, 102)',
                            ],
                            borderWidth: 1,
                            borderColor:[
                                'rgba(0,0,0)',
                            ]
                        }]
                },
                options:{
                    indexAxis: 'y',
                    plugins: {
                        responsive: true,
                        legend:{
                            display: false,
                        },
                        title:{
                            display: true,
                            text:'Rangos de estatura'
                        },
                    },
                    
                    scales:{
                        xAxes:{
                            title:{
                                display: true,
                                text:'N° de personas'
                            },
                            
                            
                                ticks:{
                                    display: true,
                                    beginAtZero: true,
                                    stepSize: 1,
                                }
                            
                        },
                        yAxes:{
                            title:{
                                display:true,
                                text: 'Rangos de estatura'
                            },
                            
                        }
                    }
                }
            
            });

            t=data.sexo[1]+data.sexo[2];
            var sy=[(data.sexo[1]*100/t).toFixed(1),(data.sexo[2]*100/t).toFixed(1)]
            var sx=['Masculino','Femenino']
            console.log(t)
 
            const oas=document.getElementById('chart-sex').getContext('2d');
            const sexGraph =new Chart(oas,{
                type: 'pie',
                data: {
                            labels: sx,
                            datasets: [{
                        
                            
                            
                            data: sy,
                            backgroundColor:[
                                'rgba(53, 135, 255)',
                                'rgba(255, 47, 148)',

                            ],
                            hoverBackgroundColor:[
                                'rgba(140, 187, 255)',
                                'rgba(255, 142, 197)',
                                
                            ],
                            borderWidth: 1,
                            borderColor:[
                                'rgba(0,0,0)',
                            ]
                        }]
                },
                options:{
                    plugins: {
                        responsive: true,
                        
                        title:{
                            display: true,
                            text:'Distribución porcentual por sexo'
                        },
                    },
                        
                        responsive: true,
                        
                        title:{
                            display: true,
                            text:'Adicciones'
                        },
                    },

            });

            console.log(data.valori,data.valoro)
            const oyx=document.getElementById('chart-ingresos').getContext('2d');
            const ingresosGraph =new Chart(oyx,{
                type: 'line',
                data: {
                            labels: data.fecha,
                            datasets: [{
                            label: 'Ingresos',
                            
                            data: data.valori,
                            backgroundColor:[
                                'rgba(37, 255, 109)',

                            ],
                            hoverBackgroundColor:[
                                'rgba(169, 255, 201)',
                                
                            ],
                            borderWidth: 1,
                            borderColor:[
                                'rgba(0, 255, 0)',
                            ]
                        },
                        {
                            label: 'Egresos',
                            
                            data: data.valoro,
                            backgroundColor:[
                                'rgba(230, 16, 255)',

                            ],
                            hoverBackgroundColor:[
                                'rgba(243, 138, 255 )',
                            ],
                            borderWidth: 1,
                            borderColor:[
                                'rgba(255, 0, 0)',
                            ] 
                        }
                    ]
                        
                },
                options:{
                    lineTension: 0.3,
                    plugins: {
                        responsive: true,
                        legend:{
                            display: true,
                        },
                        title:{
                            display: true,
                            text:'Ingresos en el tiempo'
                        },
                    },
                    scales:{
                        xAxes:{
                            title:{
                                display:true,
                                text: 'Año-Mes'
                            }
                        },
                        yAxes:{
                            title:{
                                display: true,
                                text:'Valor [$]'
                            },
                            
                            
                                ticks:{
                                    display: true,
                                    beginAtZero: true,
                                    min: 0,
                                    stepSize: 100000,
                                }
                        }
                    }
                }
            
            });

            

    });
</script>


@endsection
