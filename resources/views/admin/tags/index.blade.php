@extends('admin.layouts.app')
@section('content')
    <div class="row">
    	<div class="col-sm-12 col-md-8 col-md-offset-2">
    		<div class="box box-primary">
          <div class="box box-header"><h4>Listado de Etiquetas <a href="{{route('tags.create')}}" class="btn btn-sm btn-primary pull-right">Crear</a></h4></div>
    			<div class="box-content">
    				<table class="table data">
    					<thead>
    						<th>Nombre</th>
                <th>Tipo</th>
    						<th>Editar</th>
                <th>Eliminar</th>
    					</thead>
    					<tbody>
    						@foreach($tags as $t)
							<tr>
								<td>{{$t->name}}</td>
                <td>
                  @if($t->type == 'ARTICLES')
                      Articulos
                  @endif

                  @if($t->type == 'NOTICES')
                      Noticias
                  @endif

                  @if($t->type == 'BOOKS')
                      Libros
                  @endif
                </td>
                <td>
                  <a href="{{route('tags.edit',$t->id)}}" class="btn btn-sm btn-warning"><span class="fa fa-pencil"></span></a>
                </td>
                <td>
                  {!! Form::open(['route'=>['tags.destroy', $t->id], 
                  'method' => 'DELETE']) !!}
                  <button type="submit" onclick="return confirm('Seguro deseas eliminar esta etiqueta?');" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
                  {!! Form::close() !!}
                </td>
							</tr>
    						@endforeach
    					</tbody>
    				</table>
    			</div>
    		</div>
    	</div>
    </div>
@endsection
@section('scripts')
<script>
  $(function () {
    $('.data').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });

    });
</script>
@endsection