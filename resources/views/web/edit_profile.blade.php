@extends('layouts.app')

@section('content')
  <div class="container bootstrap snippet">
    <div class="row">
      <div class="col-sm-12 mt-3">
              
          <div class="tab-content p-b-3 mt-2">
                <div class="tab-pane active" id="profile">
                    <h2 class="m-y-2">Editar Perfil</h3>
                <form action="{{route('update_profile',$user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Nombre: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                            </div>

                             <div class="form-group">
                                <label for="">Apeliido: <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}" required>
                            </div>

                             <div class="form-group">
                                <label for="">Usuario: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}" required>
                            </div>

                             <div class="form-group">
                                <label for="">Correo Electronico: <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" required>
                            </div>
                        @if($user->publicist)
                             <div class="form-group">
                                <label for="">Biografia: <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="biography" value="{{$user->email}}" required>{{$user->publicist->biography}}</textarea>
                            </div>

                        @endif

                            <div class="col-sm-12">
                                    <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar" width="200px"><br>
                                    <input type="file" class="text-center center-block file-upload" name="file">
                             </div>

                             <div class="col-sm-12 mt-3">
                                 <button class="btn btn-primary" type="submit">Guardar</button>
                             </div>

                        </div>
                    </div>
                    <!--/row-->
                </form>
                </div>

        </div><!--/col-9-->
    </div><!--/row-->
                             
@endsection
@section('scripts')
    <script>
    $(document).ready(function() {

    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.avatar').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
        }
    }
    

    $(".file-upload").on('change', function(){
        readURL(this);
    });
});
</script>
@endsection