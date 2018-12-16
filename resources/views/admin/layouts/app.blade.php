<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Widelip</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/dist/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="{{route('admin_index')}}" class="logo">
      <span class="logo-mini"><b>W</b>DL</span>
      <span class="logo-lg"><b>WIDELIP</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
          
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
              
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
            
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{auth()->user()->username}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                  {{ __('Cerrar Sesión') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"><center>MENU</center></li>

         <li>
          <a href="{{route('categories.index')}}"><span class="fa fa-folder-open-o"></span>
              <span>Categorias</span>
          </a>
        </li>

         <li>
          <a href="{{route('tags.index')}}"><span class="fa fa-tag"></span>
              <span>Etiquetas</span>
          </a>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-file-text-o" aria-hidden="true"></i>
              <span>Articulos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('posts.index')}}">Publicaciones</a></li>
            <li><a href="{{route('categories.index')}}">Categorias</a></li>
            <li><a href="{{route('tags.index')}}">Etiquetas</a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i> <span>Noticias</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('publicists.index')}}">Publicistas</a></li>
            <li><a href="{{route('notices.index')}}">Listado de Noticias</a></li>
          </ul>
        </li>

         <li class="treeview">
          <a href="#"><i class="fa fa-book" aria-hidden="true"></i>
            <span>Libros</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>

        <li>
          <a href="{{route('users.index')}}"><i class="fa fa-users" aria-hidden="true"></i>
              <span>Usuarios</span>
          </a>
        </li>

      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
   
    <section class="content container-fluid">
      @if(session('success'))
             <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{session('success')}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>
          </div>
      @endif

      @if(session('error'))
             <div class="box box-danger box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{session('error')}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>

            </div>
          </div>
      @endif


      @yield('content')
      
    </section>
  </div>
  
  <footer class="main-footer">
    <strong>Widelip &copy; 2018-2019. Todos los derechos reservados.
  </footer>
</div>

<script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
@yield('scripts')
</body>
</html>