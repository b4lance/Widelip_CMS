@extends('admin.layouts.app')
@section('content')
    <div class="row">
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Publicista</h3>
            </div>
      
              <div class="box-body">
              <form method="POST" action="{{route('publicists.update',$publicist->id)}}">
                @csrf
                @method('PUT')

                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                  <label for="name">Nombre: <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{$publicist->name}}">
                  @if($errors->has('name'))
                  <span class="help-block">{{$errors->first('name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('lastname') ? 'has-error' : ''}}">
                  <label for="name">Apellido: <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Apellido" value="{{$publicist->lastname}}">
                  @if($errors->has('lastname'))
                  <span class="help-block">{{$errors->first('lastname')}}</span>
                  @endif
                </div>

                <div class="form-group  {{$errors->has('college') ? 'has-error' : ''}}">
                     <label for="">Universidad: <span class="text-danger">*</span></label>
                     <input type="text" name="college" id="college" class="form-control" placeholder="Universidad" value="{{$publicist->college}}">
                      @if($errors->has('college'))
                        <span class="help-block">{{$errors->first('college')}}</span>
                      @endif
                 </div>

                 <div class="form-group  {{$errors->has('biography') ? 'has-error' : ''}}">
                     <label for="">Biografia <span class="text-danger">*</span></label>
                     <textarea type="text" name="biography" id="biography" placeholder="Biografia" class="form-control">{{$publicist->biography}}
                     </textarea>
                      @if($errors->has('biography'))
                          <span class="help-block">{{$errors->first('biography')}}</span>
                      @endif
                 </div>

                   <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
                  <label for="name">Status: <span class="text-danger">*</span></label>
                  <select class="form-control" name="status" id=status">
                      <option value="ACTIVE" {{$publicist->status == 'ACTIVE' ? 'selected' : ''}}>Activo</option>
                      <option value="INACTIVE" {{$publicist->status == 'INACTIVE' ? 'selected' : ''}}>Inactivo</option>
                  </select>
                  @if($errors->has('status'))
                  <span class="help-block">{{$errors->first('status')}}</span>
                  @endif
                </div>       
                                    
                  <div class="form-group  {{$errors->has('file') ? 'has-error' : ''}}">
                      <label for="" style="font-weight: bold;">Documento como Publicista</label><br>
                      <input type="file" name="file" id="file">
                      @if($errors->has('file'))
                          <span class="help-block">{{$errors->first('file')}}</span>
                      @endif
                  </div>      

                  <div class="col-sm-12">
                    <iframe src="{{$publicist->file}}" width="40%" height="80%" frameborder="0">
                      
                    </iframe>
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