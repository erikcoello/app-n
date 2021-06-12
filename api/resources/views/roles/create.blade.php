@extends('layout')

@section('content')

<h2> Crear Roles</h2>
 
 @include('partials.session-status')
    @include('partials.validation-errors')

<form method="POST" action=" {{route('roles.store')}}" >
   
    @csrf()
    
    <div class="form-group">
        <label for="role_permissions">Nombre para Rol</label>
        <input type="text" name="role_name" class="form-control" id="role_name" placeholder="Role name" value="{{ old('role_name') }}" required>
    </div>
    <div class="form-group">
        <label for="role_permissions">Rol slug</label>
        <input type="text" name="role_slug" class="form-control" id="role_slug" placeholder="Role_slug" value="{{ old('role_slug') }}">
    </div>
    <div class="form-group">
        <label for="role_permissions">Agregar Permisos</label>
        <small>Ejemplo Crear, Leer, Actualizar, Borrar</small>
        <input type="text" data-role="tagsinput" name="roles_permissions" class="form-control" id="role_permissions">
    </div>
   

        <div class="form-group pt-2">
        <input type="submit" class="btn btn-primary">
        </div>

</form>

@section('css_role_page')

<link href="{{ asset('/css/admin/bootstrap-tagsinput.css') }}" rel="stylesheet"> 
@endsection

@section('js_role_page')
    <script src="/js/admin/bootstrap-tagsinput.js"></script>
     <script>
        $(document).ready(function(){
            $('#role_name').keyup(function(e){
                var str = $('#role_name').val();
                str = str.replace(/\W+(?!$)/g, '-').toLowerCase();//rplace stapces with dash
                $('#role_slug').val(str);
                $('#role_slug').attr('placeholder', str);
            });
        });
        
    </script>

@endsection

@endsection
