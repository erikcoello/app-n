@extends('layout')

@section('content')
@include('partials.session-status')
    @include('partials.validation-errors')

    
<form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
  @csrf
    
    <div class="form-group">
        <label for="name">Nombre de Usuario</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="username" value="{{ old('name') }}" required>
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Email..." value="{{ old('email') }}">
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Crear contraseña" required minlength="8">
    </div>
    <div class="form-group">
        <label for="password_confirmation">Repetir Contraseña</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" id="password_confirmation">
    </div>
     <div class="form-group">
        <label for="role">Seleccione el Rol del Usuario</label>
        <select class="role form-control" name="role" id="role">
            <option value="">Seleccione un Rol</option>
            @foreach ($roles as $role)
            <option data-role-id="{{$role->id}}" data-role-slug="{{$role->slug}}" value="{{$role->id}}">{{$role->name}}</option>
            @endforeach
        </select>
    </div> 
    
<div id="permissions_box" >
        <label for="roles">Seleccione los Permisos del Rol </label>
        <div id="permissions_ckeckbox_list">
        </div>
    </div>   

    <div class="form-group pt-2">
        <input class="btn btn-primary" type="submit" value="Guardar">
    </div>
</form>    
@section('js_user_page')

    <script>


        $(document).ready(function(){
            var permissions_box = $('#permissions_box');
            var permissions_ckeckbox_list = $('#permissions_ckeckbox_list');
            permissions_box.hide(); // hide all boxes
            $('#role').on('change', function() {
                var role = $(this).find(':selected');    
                var role_id = role.data('role-id');
                var role_slug = role.data('role-slug');
                permissions_ckeckbox_list.empty();
                $.ajax({
                    url: "{{route('users.create')}}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                        role_slug: role_slug,
                    }
                }).done(function(data) {
                    
                    console.log(data);
                    
                    permissions_box.show();                        
                    // permissions_ckeckbox_list.empty();
                    $.each(data, function(index, element){
                        $(permissions_ckeckbox_list).append(       
                            '<div class="custom-control custom-checkbox">'+                         
                                '<input class="custom-control-input" type="checkbox" name="permissions[]" id="'+ element.slug +'" value="'+ element.id +'">' +
                                '<label class="custom-control-label" for="'+ element.slug +'">'+ element.name +'</label>'+
                            '</div>'
                        );
                    });
                });
            });
        });
    </script>

@endsection
@endsection