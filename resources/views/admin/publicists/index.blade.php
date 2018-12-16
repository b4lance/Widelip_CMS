@extends('admin.layouts.app')
@section('content')
    <div class="row">
    	<div class="col-sm-12 col-md-8 col-md-offset-2">
    		<div class="box box-primary">
          <div class="box box-header"><h4>Listado de Publicistas <a href="{{route('publicists.create')}}" class="btn btn-sm btn-primary pull-right">Crear</a></h4></div>
    			<div class="box-content">
    				<table class="table data">
    					<thead>
    						<th>Nombre</th>
    						<th>Apellido</th>
                <th>Status</th>
                <th>Editar</th>
                <th>Eliminar</th>
    					</thead>
    					<tbody>
    						@foreach($publicists as $p)
							<tr>
								<td>{{$p->name}}</td>
                <td>{{$p->lastname}}</td>
                <td>
                                  @if($p->status == 'ACTIVE')
                                       <span class="badge bg-green" style="cursor: pointer;">Activo</span>
                                   @else
                                       <span class="badge bg-red" style="cursor: pointer;">Revisión</span>
                                   @endif
                              </td>
                <td>
                  <a href="{{route('publicists.edit',$p->id)}}" class="btn btn-sm btn-warning"><span class="fa fa-pencil"></span></a>
                </td>
                <td>
                  {!! Form::open(['route'=>['publicists.destroy', $p->id], 
                  'method' => 'DELETE']) !!}
                  <button type="submit" onclick="return confirm('Seguro deseas eliminar este publicista?');" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
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