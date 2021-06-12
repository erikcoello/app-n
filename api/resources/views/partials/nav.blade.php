
    <nav>
        
        <ul>
            {{-- <li class="{{ setActive('home') }}"><a href=" {{route('home')}} ">@lang('Home')</a></li>
            <li class="{{ setActive('about') }}"><a href="{{route('about')}}">@lang('About')</a></li  >
            <li class="{{ setActive('projects.index') }}"><a href="{{route('projects.index')}}">@lang('Projects')</a></li  > 
            <li class="{{ setActive('contact') }}"><a href="{{route('contact')}}">@lang('Contact')</a></li>--}}
            <li class="{{ setActive('categorias.index') }}"><a href="{{route('categorias.index')}}">@lang('Categorias')</a></li  >
             <li class="{{ setActive('alumnos.index') }}"><a href="{{route('alumnos.index')}}">@lang('Alumnos')</a></li>
             @can('isAdmin')  <li class="{{ setActive('users.index') }}"><a href="{{route('users.index')}}">@lang('usuarios')</a></li>
           
             <li class="{{ setActive('roles.index') }}"><a href="{{route('roles.index')}}">@lang('Roles')</a></li>
            @endcan
 
            @guest
            <li><a href="{{route('login')}}">@lang('Login')</a></li>

            @else
            <li><a href="#"onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Cerrar Session
       </a></li>
            @endguest
        </ul>
    </nav>
     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>