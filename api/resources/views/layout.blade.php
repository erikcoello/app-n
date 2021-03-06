<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  

  <title>ENSFEP</title>


  <script src="https://kit.fontawesome.com/3eb468d2fb.js" crossorigin="anonymous"></script> 
  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/css/app.css') }} ">
  <!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

@yield('css_role_page')

</head>


<body class="hold-transition sidebar-mini">
<div class="wrapper"> 
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="/public/alumnos/index" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>
</nav>

 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/public/alumnos/index" class="brand-link">
<!--<img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">-->
      <span class="brand-text font-weight-light">ENSFEP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            @auth
          {{ Auth::user()->name }}   {{ Auth::user()->roles->isNotEmpty() ? Auth::user()->roles->first()->name : " " }}
          @endauth
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>
         
           @canany(['isAdmin','isFinance'])
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Conceptos Generales

                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('categorias.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Concepto Pago / Prorroga</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('costo-semestre.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Costos Semestre</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan
          <li class="nav-item has-treeview">
            <a href="/" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
               Estudiantes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('alumnos.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Finanzas Estudiantes</p>
                </a>
              </li>
            </ul>
          </li>
          <!--  Control Escolar  -->
          @canany(['isAdmin','isSchool'])
          <li class="nav-item has-treeview">
            <a href="{{route('controlescolar.index')}}" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
               Control Escolar
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('controlescolar.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Documentos Estudiante</p>
                </a>
              </li>
            </ul>
          </li>
          @endcanany
        <!--  la directiva de can solo esconde los links pero se pueden accesar desde la url isSysadmin es declarado en los gates dentro de authServiceProvider  -->
         @canany(['isAdmin'])
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Usuarios
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('usuarios')</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Roles
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('roles.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>@lang('Roles')</p>
                </a>
              </li>
           </ul>
          </li>
       @endcan
        {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e_commerce.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-commerce</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project_add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project_edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project_detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Iniciar / Cerrar Session
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> --}}
              

                @guest
            <li class="nav-item" ><a class="nav-link" href="{{route('login')}}"><i class="far fa-circle nav-icon"></i>@lang('Iniciar Sesi??n')</a></li>

            @else
            <li class="nav-item"><a class="nav-link" href="#"onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();"> <i class="far fa-circle nav-icon"></i> <p>Cerrar Sesi??n</p> 
       </a></li>
            @endguest
             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>


                     
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/"></a></li>
              <li class="breadcrumb-item active"></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        

@yield('content') 
      
      </div> {{-- cierre container fluid --}}
   </div> {{-- cierre row --}}
</div> {{-- cierre wraper --}}


   {{-- @include('partials.nav') --}}
    
   {{--  @include('partials.session-status') --}}

  <script src="{{asset('/js/app.js')}}"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
 -->
@yield('scripts')
@yield('js_user_page') 
@yield('js_categoria_page') 
@yield('js_cargo_page')
@yield('js_role_page') 
</body>

</html>