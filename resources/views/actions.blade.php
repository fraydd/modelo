<a href="{{route('modelos.show', $id)}}" class="btn btn-outline-primary btn-sm">Perfil</a>
<a href="{{route('modelos.renovar', $id)}}" class="btn btn-outline-success btn-sm" >Renovar</a>
<a href="{{route('modelos.edit', $id)}}" class="btn btn-outline-warning btn-sm">Editar</a>
<a href="{{route('modelos.borrar', $id)}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a {{$nombre}}?')">Borrar</a>