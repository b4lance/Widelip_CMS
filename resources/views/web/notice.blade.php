@extends('layouts.app')

@section('content')
<div class="container">
        	<div class="row">
                <div class="col-sm-12">
             
                      <div class="tab-pane fade show active" id="articles">
                            <div class="card mt-2" v-for="p in posts" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                    <h5 class=""><a href="" class="text-white">{{$post->name}}</a></h5>
                                <div class="d-flex justify-content-between">
                                   <div><span class="fa fa-folder-open-o"></span> <a href="{{route('category_notices',$post->category->slug)}}">{{$post->category->name}}</a></div>
                                   <div><span class="fa fa-comment-o"></span> 0</div>
                                </div>    
                                </div>
                                <div class="card-body">

                                @if($post->file)
                                <img src="{{$post->file}}" alt="Imagen del Post" class="img-fluid">
                                @endif
                                <p>{{$post->excerpt}}</p><hr>
                                {!! $post->body !!} <hr>
                                 Etiquetas: 
                                @foreach($post->tags as $t)
                                <a href="{{route('tag_notices',$t->slug)}}"><span class="fa fa-tag"></span> {{$t->name}}</a>
                                @endforeach
                                <hr>
                                <img src="{{asset('img/48.jpg')}}" alt="" width="30px" class="img-responsive img-circle mt-1"/> Creado Por: {{$post->publicist->name}} {{$post->lastname}}
                                </div>
                            </div>
                
                      </div>

            </div>
        
            </div>

@endsection