<style>
.img{
    height: auto;
    width: auto;
    max-width: 100px;
    max-height: 100px;
}
.div{
    height: auto;
    width: auto;
    max-width: 100px;
    max-height: 100px;
}
figure{
    border-radius: 10%;
    overflow: hidden;
}
</style>
<div class="div">
    <figure>
        <img class="img" src="{{ asset($foto)}}" alt="imagen {{$nombre}}" > 
    </figure>
    
</div>
