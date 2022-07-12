<a href="{{route('admin.show', $id)}}" class="btn btn-outline-primary btn-sm">Perfil</a>
<a href="{{route('admin.edit', $id)}}" class="btn btn-outline-warning btn-sm">Editar</a>
<a href="{{route('admin.borrar', $id)}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a {{$nombre}}?')">Borrar</a>