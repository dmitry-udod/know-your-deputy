<a title="Видалити" class="btn btn-danger btn-xs"
   onclick="event.preventDefault();
           if (confirm('Ви впевненi що бажаєте видалити запис?')) {
           document.getElementById('{{ $viewName }}{{ $entity->id }}').submit();
           }
           "><i class="glyphicon glyphicon-trash"></i></a>

<form id="{{ $viewName }}{{ $entity->id }}" action="{{ route("admin.$viewName.destroy", $entity->id) }}" method="POST" style="display: none;">
    <input type="hidden" value="DELETE" name="_method">
    {{ csrf_field() }}
</form>