<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/moment-with-locales.min.js')}}"></script>
@extends('layouts.app')

@section('content')
<div class="container">
@foreach($posts as $p)
    <div class="card mt-2" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class=""><a href="#" class="text-white">{{$p->name}}</a></h5>
                                <div class="d-flex justify-content-between">
                                   <div><span class="fa fa-folder-open-o"></span> <a href="{{route('category_notices',$p->category->slug)}}">{{$p->category->name}}</a> Publicado 
                                    <script>
                                         function since(d){
                                            var lang=moment.lang('es');
                                            return document.write(moment(d).fromNow());
                                        }
                                        since('{{$p->created_at}}')
                                    </script> 
                                    </div>
                                   <div><span class="fa fa-comment-o"></span> 0</div>
                                </div>    
                                </div>
                                <div class="card-body">
                                <img src="{{$p->file}}" alt="Imagen del Post" class="img-fluid">
                                <p>{{$p->excerpt}} <a href="{{route('notice',$p->slug)}}">Leer Más</a></p>
                                 <p>Creado Por:</p>
                                <p><a href="{{route('profile_web',$p->publicist->user->id)}}"><img src="{{$p->publicist->user->image}}" alt="" width="60px;" class="img-thumbnail"> {{$p->publicist->name}}</a></p><br>
                                @foreach($p->tags as $t)
                                <a href="{{route('tag_notices',$t->slug)}}" class="mr-2"><span class="fa fa-tag"></span> {{$t->name}}</a>
                                @endforeach
                                 </div>
    </div>
@endforeach
<div class="d-flex justify-content-center mt-2">{{$posts->render()}}</div>
</div>

@endsection



