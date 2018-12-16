@extends('layouts.app')

@section('content')
<div class="container">
        	<div class="row mt-4">

                <div class="col-md-4 col-sm-12">
                    <ul class="list-group">
                            <li class="list-group-item active d-flex justify-content-between align-items-center">
                                <a href="{{route('panel')}}" class="text-white">Articulos</a>
                                <span class="badge badge-primary badge-pill">{{$count_post}}</span>
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
                                    <h5>Mis Noticias</h5>
                                   <div class="mt-1"><a href="{{route('new_notice')}}" class="btn btn-sm btn-success">Nueva Noticia</a></div>
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
                                                @foreach($notices as $n)
                                                <tr>
                                                    <td>{{$n->name}}</td>
                                                    <td width="20%">{{\Carbon\Carbon::parse($n->created_at)->format('d-m-Y')}}</td>
                                                    <td>
                                                        @if($n->status == 'PUBLISHED')
                                                            <span class="badge badge-success" style="cursor: pointer;">Publicado</span>
                                                        @else
                                                            <span class="badge badge-danger" style="cursor: pointer;">Revisión</span>
                                                        @endif
                                                    </td>
                                                     <td><a href="{{route('notice',$n->slug)}}" class="btn btn-info btn-sm"><span class="fa fa-eye"></span></a></td>
                                                    <td><a href="{{route('edit_notice',$n->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span></a></td>
                                                    <td>
                                                    {!! Form::open(['route'=>['delete_post', $n->id], 
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