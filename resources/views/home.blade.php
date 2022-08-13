@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    *{
        box-sizing: border-box;
    }
    .fondo{
        background-color: #BCBCBC;
        border: solid;

    }
    .im{
        height:auto ; 
        width:auto ;
        max-width: 290px;
        max-height: 290px;
        padding: 10px;
        border-radius: 20px;
        
    }
    .fil{
        display: block;
    }
    body::-webkit-scrollbar{
        width: 7px;
        background: black;
    }
    body::-webkit-scrollbar-thumb{
        background:#5ebef6 ;
        border-radius: 10px;
    }
    
</style>
</head>
<body>
    <!-- Photo Grid -->
    <div class="w3-row" id="myGrid" style="margin-bottom:128px">
        <div class="w3-third" id="0">
        </div>

        <div class="w3-third" id="1">
        </div>

        <div class="w3-third" id="2">

        </div>
    </div>
<script>
    $(document).ready(function(){
        
        
        const data = JSON.parse(`<?php echo $data; ?>`)
        console.log(data.fotos)
        for (let i = 0; i < data.fotos.length; i++) {
            console.log(data.fotos[i])
            let j=i%3;
            $( "#"+j ).append( '<img src="'+data.fotos[i]+'" style="width:100%">' );
            
            
        }
    
    });
</script>

</body>
</html>


@endsection
