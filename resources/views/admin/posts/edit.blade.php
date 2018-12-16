@extends('admin.layouts.app')
@section('content')
    <div class="row">
        @if(count($errors) > 0)
             <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <div class="box-body">
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{$error}}</li>
                    @endforeach
                  </ul>
              </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>
          </div>
      @endif

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Articulo</h3>
            </div>
      
              <div class="box-body">
              <form method="POST" action="{{route('posts.update',$post->id)}}" enctype="multipart/form-data">
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

                    <div class="form-group">
                          <label for="">Status <span class="text-danger">*</span></label>
                          <select name="status" id="status" class="form-control">
                              <option value="">Seleccione el status</option>
                              <option value="PUBLISHED" {{$post->status == 'PUBLISHED' ? 'selected' : ''}}>Publicado</option>
                              <option value="DRAFT" {{$post->status == 'DRAFT' ? 'selected' : ''}}>Revision</option>
                          </select>
                       </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
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