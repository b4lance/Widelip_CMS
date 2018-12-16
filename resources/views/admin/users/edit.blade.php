@extends('admin.layouts.app')
@section('content')
    <div class="row">
    	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Usuario</h3>
            </div>
      
              <div class="box-body">
              <form method="POST" action="{{route('users.update',$user->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                  <label for="last_name">Nombre: <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{$user->name}}">
                  @if($errors->has('name'))
                  <span class="help-block">{{$errors->first('name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
                  <label for="name">Apellido: <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellido" value="{{$user->last_name}}">
                  @if($errors->has('last_name'))
                  <span class="help-block">{{$errors->first('last_name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                  <label for="username">Usuario: <span style="color: red;">*</span></label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Usuario" value="{{$user->username}}">
                   @if($errors->has('username'))
                  <span class="help-block">{{$errors->first('username')}}</span>
                  @endif
                </div>


                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  <label for="email">Email: <span style="color: red;">*</span></label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{$user->email}}">
                   @if($errors->has('email'))
                  <span class="help-block">{{$errors->first('email')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                  <label for="role">Rol: <span style="color: red;">*</span></label>
                  <select name="role" id="role" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="ADMIN" {{$user->role == 'ADMIN' ? 'selected' : ''}}>Administrador</option>
                    <option value="USER" {{$user->role == 'USER' ? 'selected' : ''}}>Usuario</option>
                  </select>
                   @if($errors->has('role'))
                  <span class="help-block">{{$errors->first('role')}}</span>
                  @endif
                </div>


                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                  <label for="password">Contraseña: </label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="{{old('password')}}">
                   @if($errors->has('password'))
                  <span class="help-block">{{$errors->first('password')}}</span>
                  @endif
                </div>

                <div class="form-group">
                  <label for="password_confirmation">Confirmar Contraseña:</label>
                  <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
                </div>

                <!--<div class="form-group">
                  <label for="password">Status:</label>
                  <select name="status" id="status" class="form-control">
                    <option value="ACTIVE">Activo</option>
                     <option value="INACTIVE">Inactivo</option>
                  </select>
                </div>-->
             
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>

    </div>
@endsection