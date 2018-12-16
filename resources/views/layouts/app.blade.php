<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
    <link rel="stylesheet" href="{{asset('font-awesome/css/font-awesome.min.css')}}">
   
</head>
<body style="min-height: 75rem;
padding-top: 4.5rem;">
    <div>
        <nav class="navbar navbar-expand-md navbar-laravel fixed-top navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                         <li class="nav-item">
                                 <a class="nav-link" href="{{ route('g_posts') }}">Blog</a>
                        </li>

                        <li class="nav-item">
                                 <a class="nav-link" href="{{ route('n_notices') }}">Noticias</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                            <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
                            </form>
                        @guest

                            <li class="nav-item">
                                <a class="nav-link btn btn-success mr-2" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link btn btn-success mr-2" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                @endif
                            </li>
                        @else
                            <li>
                                @if(auth()->user()->image)
                                <img src="{{auth()->user()->image}}" alt="" width="30px" class="img-responsive img-circle mt-1"/>
                                @else
                                  <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="" width="30px" class="img-responsive img-circle mt-1"/>
                                  @endif
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     <a href="{{route('profile_web',auth()->user()->id)}}" class="dropdown-item">Perfil</a>
                                      <a href="{{ route('panel') }}" class="dropdown-item">Mis Publicaciones</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <main class="py-4" id="app">
        @if(session('success'))
        <div class="container">
            <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              {{session('success')}}
            </div>
          </div>
      @endif
      @if(session('info'))
      <div class="container">
          <div class="alert alert-dismissible alert-info">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{session('info')}}
          </div>
        </div>
    @endif
            @yield('content')
        </main>

        <!--Footer-->
    <footer class="blog-footer">
      <p>WIDELIP</p>
      <p>
        <a href="#">Todos los derechos reservados &copy;</a>
      </p>
    </footer>
        <!--Footer-->
    </div>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/vue.js')}}"></script>
    <script src="{{asset('js/axios.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-with-locales.min.js')}}"></script>
    @yield('scripts')
</body>
</html>
