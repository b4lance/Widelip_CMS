@extends('layouts.app')

@section('content')
  <div class="container bootstrap snippet">
    <div class="row">
      <div class="col-md-3 col-sm-12 mt-2"><!--left col-->
              

      <div class="text-center">
        <img src="{{$user->image}}" class="avatar img-circle img-thumbnail" alt="avatar">
      </div></hr><br>

          
          
          <ul class="list-group">
            <li class="list-group-item text-muted">Actividad <i class="fa fa-dashboard fa-1x"></i></li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Articulos</strong></span>{{$posts_count}}</li>
            <li class="list-group-item text-right"><span class="pull-left"><strong>Noticias</strong></span>{{$notices_count}}</li>
          </ul> 
               
         
          
        </div><!--/col-3-->
      <div class="col-sm-9 mt-3">
              
          <div class="tab-content p-b-3 mt-2">
                <div class="tab-pane active" id="profile">
                    <h2 class="m-y-2">Perfil @if(auth()->user())<a href="{{route('edit_profile', auth()->user()->id)}}" class="btn btn-success btn-sm">Editar</a>@endif</h3>
                    <div class="row">
                        <div class="col-sm-12">
                          @if($user->publicist)
                            <h5>Nombre : {{$user->publicist->name}} {{$user->publicist->lastname}}</h5>
                            <h5>Universidad: {{$user->publicist->college}}</h5>
                            <h5>Biografia: </h5>
                            <p>{{$user->publicist->biography}}
                            </p>
                            @else
                            <h5>Nombre : {{$user->name}} {{$user->lastname}}</h5>
                            @endif
                        </div>
                      
                        <div class="col-md-12">
                            <h4 class="m-t-2"><span class="fa fa-clock-o ion-clock pull-xs-right"></span> Actividad Reciente</h4>
                            <table class="table table-hover table-striped">
                                <tbody> 
                                @foreach($posts as $p)                                   
                                    <tr>
                                        <td>
                                            <a href="{{route('post',$p->slug)}}">{{$p->name}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @if($user->publicist)
                                @foreach($notices as $n)                                   
                                    <tr>
                                        <td>
                                            <a href="{{route('notice',$n->slug)}}">{{$n->name}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--/row-->
                </div>

        </div><!--/col-9-->
    </div><!--/row-->
                             
@endsection