@extends('layout')

@section('content')
<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Usuarios Registrados</h2>
    </div>
    <div class="col-md-6"> 
        <a href="/public/users/create" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Crear Nuevo Usuario</a>
</div>
    
</div>{{-- row py-lg2 --}}


<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tabla Usuarios</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	
	<thead>
		<tr>
			<th>id</th>
			<th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Permisos</th>
            <th>Herramientas</th>
		</tr>
         </thead>
            <tfoot>
        <tr>
                <th>id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Permisos</th>
            <th>Herramientas</th>
            </tr>
            </tfoot>

	</thead>
    <tbody>
        @foreach ($users as $user)
        @if(!\Auth::user()->hasRole('superadmin') && $user->hasRole('superadmin')) @continue, @endif
        <tr {{ Auth::user()->id == $user->id ? 'bgcolor=#ddd' : ''}} >
            <td>
            {{ $user->id }}
            </td>
             <td>
            {{ $user->name }}
            </td>
             <td>
            {{ $user->email }}
            </td>
             <td>
             @if ($user->roles->isNotEmpty())
                            @foreach ($user->roles as $role)
                                <span class="badge badge-secondary">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        @endif
            </td>
             <td>
          @if ($user->permissions->isNotEmpty())
                                        
                            @foreach ($user->permissions as $permission)
                                <span class="badge badge-secondary">
                                    {{ $permission->name }}                                    
                                </span>
                            @endforeach
                        
                        @endif
            </td>
            <td>
             <a href="{{route('users.show', $user->id) }}"><i class="fa fa-eye"></i></a> 
             <a href=" {{ route('users.edit', $user->id ) }} "><i class="fa fa-edit"></i></a>
             <a href="#" data-toggle="modal" data-target="#deleteModal" data-userid="{{$user['id']}}"><i class="fas fa-trash-alt"></i></a>

              {{-- 
                 <form method="POST" action="{{route('users.destroy', $user->id)}} " >
    @csrf @method('DELETE')
    <button ><i class="fas fa-trash-alt"></i></button> --}}
</form>

              </td>
        </tr>
        @endforeach
    </tbody>

</table>
<!-- delete Modal-->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Seguro de Eliminar este Usuario?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">Click en Eliminar.</div>
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <form method="POST" action="">
                    @method('DELETE')
                    @csrf
                    {{-- <input type="hidden" id="user_id" name="user_id" value=""> --}}
                    <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
                </form>
                </div>
            </div>
            </div>
        </div>
    </div>

 @endsection
  


@section('js_user_page')

      <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var user_id = button.data('userid') 
            
            var modal = $(this)
            // modal.find('.modal-footer #user_id').val(user_id)
            modal.find('form').attr('action','/public/users/' + user_id);
        })
    </script>

@endsection


