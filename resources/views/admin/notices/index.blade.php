@extends('admin.layouts.app')
@section('content')
    <div class="row">
    	<div class="col-sm-12">
            <h4>Listado de Noticias</h4>
    		<div class="box box-primary">
    			<div class="box-content">
    				<table class="table data">
    					<thead>
    						<th>Fecha</th>
    						<th>Usuario</th>
    						<th>Nombre</th>
    						<th>Status</th>
    						<th>Editar</th>
                <th>Eliminar</th>
    					</thead>
    					<tbody>
    						@foreach($notices as $n)
							<tr>
								<td>{{\Carbon\Carbon::parse($n->created_at)->format('d/m/Y')}}</td>
								<td>{{$n->publicist->name}}</td>
								<td>{{$n->name}}</td>
								 <td>
                                  @if($n->status == 'PUBLISHED')
                                       <span class="badge bg-green" style="cursor: pointer;">Publicado</span>
                                   @else
                                       <span class="badge bg-red" style="cursor: pointer;">Revisión</span>
                                   @endif
                             	</td>
                             	<td>
                             		<a href="{{route('notices.edit',$n->id)}}" class="btn btn-sm btn-warning"><span class="fa fa-pencil"></span></a>
                             	</td>
                             	<td>
                             		 {!! Form::open(['route'=>['notices.destroy', $n->id], 
                                    'method' => 'DELETE']) !!}
                                    <button type="submit" onclick="return confirm('Seguro deseas eliminar esta noticia?');" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
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