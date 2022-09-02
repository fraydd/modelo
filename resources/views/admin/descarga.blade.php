@extends('layouts.app')

@section('content')
<!-- Button trigger modal -->
<button id="btn" style="display:none" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div  class="modal-dialog">
    <div style="background-color:#D4EDDA ;" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro exitoso</h5>
        
      </div>
      <div class="modal-body">
        <a href="{{route('modelos.pdf')}}">descargar</a>
      </div>
        <div class="modal-footer">
            <a href="{{ url()->previous() }}">Regresar</a>

        </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(e) {
    $('#btn').click();
  
    
  });

</script>

@endsection
