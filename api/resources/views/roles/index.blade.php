@extends('layout')

@section('content')
<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>Lista de Roles Registrados</h2>
    </div>
     <div class="col-md-6">
            <a href="{{route('roles.create')}}" class="btn btn-primary btn-lg float-md-right" role="button" aria-pressed="true">Crear Nuevo Rol</a>

</div>
    
</div>{{-- row py-lg2 --}}

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tabla Roles</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
    <thead>
        <tr>
            <th>id</th>
            <th>Role</th>
            <th>Slug</th>
            <th>Permission</th>
            <th>Tools</th>
        </tr>

    </thead>
    <tbody>
        @foreach ($roles as $role)
        <tr>
            <td>
            {{ $role->id }}
            </td>
             <td>
            {{ $role->name }}
            </td>
             <td>
            {{ $role->slug }}
            </td>
             <td>
                            @if ($role->permissions != null)
                                    
                                @foreach ($role->permissions as $permission)
                                <span class="badge badge-secondary">
                                    {{ $permission->name }}                                    
                                </span>
                                @endforeach
                            
                            @endif
                        </td>
           
             
              <td>
                <a href="{{ route('roles.show', $role->id ) }} "><i class="fa fa-eye"></i></a>
                <a href="{{ route('roles.edit', $role->id ) }} "><i class="fa fa-edit"></i></a>
                <a href="#" data-toggle="modal" data-target="#deleteModal" data-roleid="{{$role['id']}}"><i class="fas fa-trash-alt"></i></a>
                            {{-- 
                             <form method="POST" action="{{route('roles.destroy', $role->id)}} " >
                                @csrf @method('DELETE')
    <button><i class="fas fa-trash-alt"></i></button>
</form> --}}
                            
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
        <h5 class="modal-title" id="exampleModalLabel">¿Seguro de Eliminar este Rol?</h5>
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
            {{-- <input type="hidden" id="role_id" name="role_id" value=""> --}}
            <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
        </form>
        </div>
    </div>
    </div>
</div>



@endsection

@section('js_role_page')

<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var role_id = button.data('roleid') 
        
        var modal = $(this)
        // modal.find('.modal-footer #role_id').val(role_id)
        modal.find('form').attr('action','/public/roles/' + role_id);
    })
</script>

@endsection