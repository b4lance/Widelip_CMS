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
                                   <div><span class="fa fa-folder-open-o"></span> <a href="{{route('category',$post->category->slug)}}">{{$post->category->name}}</a></div>
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
                                <a href="{{route('tag',$t->slug)}}"><span class="fa fa-tag"></span> {{$t->name}}</a>
                                @endforeach
                                <hr>
                                <p>Creado Por:</p>
                                <p><a href="{{route('profile_web',$post->user->id)}}"><img src="{{$post->user->image}}" alt="" width="60px;" class="img-thumbnail"> {{$post->user->name}}</a></p><br>
                            </div>
                
                      </div>

            </div>
        
            </div>

@endsection