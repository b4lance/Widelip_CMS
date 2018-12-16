@extends('layouts.app')

@section('content')
<div class="container">
        	
<div class="row mt-1">

 <div class="col-md-2 col-sm-12"></div>
 <div class="col-md-8  col-sm-12">
        @if(count($errors) > 0)
            
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert bg-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>    
            </div>
                
            @endif
</div>
</div>
<div class="row mt-4">


                <div class="col-md-2 col-sm-12"></div>
                <div class="col-md-8  col-sm-12" style="margin-bottom: 400px;">
             
                      <div class="tab-pane fade show active" id="articles">
                            <div class="card mt-2" v-for="p in posts" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between">
                                    <h5>Editar</h5>
                                   <div class="mt-1"><a href="{{route('notices')}}" class="btn btn-sm btn-danger">Regresar</a></div>
                                </div>    
                                </div>
                                <div class="card-body">
                                <form action="{{route('update_notice',$post->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="form-group">
                                        <label for="">Titulo <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" placeholder="Titulo" class="form-control" value="{{$post->name}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">URL <span class="text-danger">*</span></label>
                                        <input type="text" name="slug" id="slug" placeholder="URL Amigable" class="form-control" readonly value="{{$post->slug}}">
                                    </div>


                                    <div class="form-group">
                                        <label for="">Breve Descripción <span class="text-danger">*</span></label>
                                        <textarea name="excerpt" id="excerpt" rows="2" class="form-control">{{$post->excerpt}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Contenido <span class="text-danger">*</span></label>
                                        <textarea name="body" id="body" rows="2" class="form-control">
                                            {!! $post->body !!}
                                        </textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Categoria <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">Seleccione la Categoria</option>
                                            @foreach($categories as $c)
                                            <option value="{{$c->id}}" {{$post->category_id == $c->id ? 'selected' : ''}}>{{$c->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Etiquetas <span class="text-danger">*</span></label><br>
                                        @foreach($tags as $t)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="tag_id{{$t->id}}"> <input class="form-check-input" {{$post->tags->contains($t->id) ? 'checked' : ''}} type="checkbox" name="tag_id[]" id="tag_id{{$t->id}}" value="{{$t->id}}"> {{$t->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>

                                     <div class="form-group">
                                        <label for="" style="font-weight: bold;">Imagen</label><br>
                                        <input type="file" name="file" id="file">
                                    </div>

                                    <input type="hidden" name="id" value="{{$post->id}}">

                                    <button type="submit" class="btn btn-primary btn-block">Publicar</button>
                                
                                </div>
                            </form>
                            </div>
                
                      </div>

            </div>
        
            </div>

@endsection
@section('scripts')
<script src="{{asset('js/jquery.stringToSlug.min.js')}}"></script>
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script>
  $(document).ready(function(){
      $('#name,#slug').stringToSlug({
            callback: function(text){
                $('#slug').val(text);
            }
      });
  });
      CKEDITOR.config.height=400;
      CKEDITOR.config.width='auto';
      CKEDITOR.replace( 'body' );
</script>
@endsection