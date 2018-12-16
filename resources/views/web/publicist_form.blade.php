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
                        <div class="alert alert-dismissible bg-danger">
                             <button type="button" class="close" data-dismiss="alert">&times;</button>
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


                <div class="col-md-2 col-sm-12">
                    
                </div>
                <div class="col-md-8  col-sm-12" style="margin-bottom: 400px;">
             
                      <div class="tab-pane fade show active" id="articles">
                            <div class="card mt-2" v-for="p in posts" style="margin-bottom:10px;">
                                <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between">
                                    <h5>Completa tu perfil como Publicista</h5>
                                   <div class="mt-1"><a href="{{route('panel')}}" class="btn btn-sm btn-danger">Regresar</a></div>
                                </div>    
                                </div>
                                <div class="card-body">
                                <form action="{{route('store_publicist')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="">Nombre <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" placeholder="Nombre" class="form-control" value="{{old('name')}}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Apellido <span class="text-danger">*</span></label>
                                        <input type="text" name="lastname" id="lastname" placeholder="Apellido" class="form-control" value="{{old('lastname')}}">
                                    </div>

                                     <div class="form-group">
                                        <label for="">Universidad <span class="text-danger">*</span></label>
                                        <input type="text" name="college" id="college" placeholder="Universidad" class="form-control" value="{{old('college')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Biografia <span class="text-danger">*</span></label>
                                        <textarea type="text" name="biography" id="biography" placeholder="Biografia" class="form-control">
                                            {{old('biography')}}
                                        </textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="" style="font-weight: bold;">Documento como Publicista<span class="text-danger">*</span></label><br>
                                        <input type="file" name="file" id="file">
                                    </div>

                                   

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