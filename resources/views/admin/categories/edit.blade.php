@extends('admin.layouts.app')
@section('content')
    <div class="row">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Categoria Etiqueta</h3>
            </div>
      
              <div class="box-body">
              <form method="POST" action="{{route('categories.update',$category->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                  <label for="name">Nombre:</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{$category->name}}">
                  @if($errors->has('name'))
                  <span class="help-block">{{$errors->first('name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('slug') ? 'has-error' : ''}}">
                  <label for="slug">URL:</label>
                  <input type="text" class="form-control" name="slug" id="slug" placeholder="URL" value="{{$category->slug}}" readonly>
                   @if($errors->has('slug'))
                  <span class="help-block">{{$errors->first('slug')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('type') ? 'has-error' : ''}}">
                  <label for="slug">Tipo:</label>
                 <select name="type" id="type" class="form-control">
                    <option value="ARTICLES" {{$category->type == 'ARTICLES' ? 'selected' : ''}}>Articulos</option>
                    <option value="NOTICES" {{$category->type == 'NOTICES' ? 'selected' : ''}}>Noticias</option>
                 </select>
                   @if($errors->has('type'))
                  <span class="help-block">{{$errors->first('type')}}</span>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="body">Decripción:</label>
                  <textarea class="form-control" name="body" id="body" placeholder="URL">
                    {{$category->body}}
                  </textarea> 
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
<script>
  $(document).ready(function(){
      $('#name,#slug').stringToSlug({
          callback: function(text){
            $('#slug').val(text);
          }
      });
  });
</script>
@endsection