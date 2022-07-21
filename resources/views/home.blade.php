@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    
</style>
<div class="container d-flex justify-content-evenly" >
<div class="col " >
    <div class="row d-flex justify-content-evenly" >
        <img id="1" class="im" src="{{asset('images/1.jpg')}}" >
        <img id="2" class="im"  src="{{asset('images/2.jpg')}}" >
        <img id="3" class="im" src="{{asset('images/3.jpg')}}" >
        <img id="4" class="im"  src="{{asset('images/4.jpg')}}" >
        
        </div><div class="row d-flex justify-content-evenly">
    <img id="5" class="im" src="{{asset('images/5.jpg')}}" >
        <img id="6" class="im"  src="{{asset('images/6.jpg')}}" >
        <img id="7" class="im" src="{{asset('images/7.jpg')}}" >
        <img id="8" class="im" src="{{asset('images/8.jpg')}}" >
        <img id="9" class="im" src="{{asset('images/9.jpg')}}" >

        </div>



</div></div>
    



<script>
    $(document).ready(function(){
        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return Math.floor(Math.random() * (max - min) + min);
        }
        var im=getRandomInt(1, 10);
        var is=getRandomInt(1, 10);
        var image = document.getElementById(im);
        var image2 = document.getElementById(is);
        
        var w=image.width-1;
        var h=image.height-1;


        var w2=image2.width-1;
        var h2=image2.height-1;

        $("#"+is).animate({
            width:w+'px',
            height:h+'px'
            

        },1000);

        $("#"+im).animate({
            width:w+'px',
            height:h+'px'
            

            })
        
    });
</script>
</body>
</html>


@endsection
