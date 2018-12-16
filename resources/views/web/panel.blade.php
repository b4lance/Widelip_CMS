@extends('layouts.app')

@section('content')
<div class="container">
        	<div class="row mt-4">

                <div class="col-md-4 col-sm-12">
                    <ul class="list-group">
                            <li class="list-group-item active d-flex justify-content-between align-items-center">
                                <a href="#" class="text-white">Articulos</a>
                                <span class="badge badge-primary badge-pill">{{$count}}</span>
                            </li>
                            <li class="list-group-item active d-flex justify-content-between align-items-center">
                            <a href="{{route('notices')}}" class="text-white">Noticias</a>
                                    <span class="badge badge-primary badge-pill">{{$count_notices}}</span>
                            </li>
                    </ul>
                </div>

                <div class="col-md-8 col-sm-12" style="margin-bottom: 400px;">
             
                      <div class="tab-pane fade show active" id="articles">
                            <div class="card mt-2" v-for="p in posts" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between">
                                    <h5>Mis Articulos</h5>
                                   <div class="mt-1"><a href="{{route('new_post')}}" class="btn btn-sm btn-success">Nuevo Articulo</a></div>
                                </div>    
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <th>Nombre</th>
                                                <th>Fecha</th>
                                                <th>Estado</th>
                                                <th colspan="3">&nbsp;</th>
                                            </thead>
                                            <tbody>
                                                @foreach($posts as $p)
                                                <tr>
                                                    <td>{{$p->name}}</td>
                                                    <td width="20%">{{\Carbon\Carbon::parse($p->created_at)->format('d-m-Y')}}</td>
                                                    <td>
                                                        @if($p->status == 'PUBLISHED')
                                                            <span class="badge badge-success" style="cursor: pointer;">Publicado</span>
                                                        @else
                                                            <span class="badge badge-danger" style="cursor: pointer;">Revisión</span>
                                                        @endif
                                                    </td>
                                                     <td><a href="{{route('notice',$p->slug)}}" class="btn btn-info btn-sm"><span class="fa fa-eye"></span></a></td>
                                                    <td><a href="{{route('edit_post',$p->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span></a></td>
                                                    <td>
                                                    {!! Form::open(['route'=>['delete_post', $p->id], 
                                                    'method' => 'DELETE']) !!}
                                                    <button type="submit" onclick="return confirm('Seguro deseas eliminar esta Articulo?');" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button>
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

            </div>
        
            </div>

@endsection

<!--Modal
<div class="modal fade" id="ModalPrueba" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>-->

@section('scripts')
<script>
        $(document).ready(function(){
            $('#ModalPrueba').modal('show');
        });
    </script>
@endsection