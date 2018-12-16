@extends('admin.layouts.app')
@section('content')
    <div class="row">
    	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Usuario</h3>
            </div>
      
              <div class="box-body">
              <form method="POST" action="{{route('users.store')}}">
                @csrf
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                  <label for="last_name">Nombre:</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="{{old('name')}}">
                  @if($errors->has('name'))
                  <span class="help-block">{{$errors->first('name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
                  <label for="name">Apellido:</label>
                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Apellido" value="{{old('last_name')}}">
                  @if($errors->has('last_name'))
                  <span class="help-block">{{$errors->first('last_name')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                  <label for="username">Usuario:</label>
                  <input type="text" class="form-control" name="username" id="username" placeholder="Usuario" value="{{old('username')}}">
                   @if($errors->has('username'))
                  <span class="help-block">{{$errors->first('username')}}</span>
                  @endif
                </div>


                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="email" value="{{old('email')}}">
                   @if($errors->has('email'))
                  <span class="help-block">{{$errors->first('email')}}</span>
                  @endif
                </div>

                <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                  <label for="role">Rol:</label>
                  <select name="role" id="role" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="ADMIN">Administrador</option>
                    <option value="USER">Usuario</option>
                  </select>
                   @if($errors->has('role'))
                  <span class="help-block">{{$errors->first('role')}}</span>
                  @endif
                </div>


                <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                  <label for="password">Contraseña:</label>
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