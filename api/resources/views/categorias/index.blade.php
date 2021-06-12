@extends('layout')

@section('content')

<div class="row py-lg-2">
    <div class="col-md-6">
        <h2>@lang('Lista de Categorias')</h2>
    </div>
    <div class="col-md-6"> 
        <a href=" {{route('categorias.create')}} "class="btn btn-primary btn-lg float-md-right" role="button">Crear Categoría</a>
</div>
    
</div>{{-- row py-lg2 --}}
    

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tabla Usuarios</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
        @include('partials.session-status')

        <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Herramientas</th>
         </thead>
            <tfoot>
        <tr>
                <th>id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Herramientas</th>
          
            </tr>
            </tfoot>

    </thead>
    <tbody>
        <tr>
         @forelse($categorias as $categoria)
         <td> {{ $categoria->id }} 
           </td>
           <td> {{ $categoria->name }} 
           </td>
           <td>{{ $categoria->description }} 
           <td>             {{-- el parametro $categoria es = $categoria ->id (el id se le pasa a la ruta (web )/alumnos/create/{id}) --}}
                <a href="{{route('categorias.edit', $categoria) }}"><i class="fa fa-edit"></i></a>
 
    @can('delete',$categoria)

    <a href="#"  data-toggle="modal" data-target="#deleteModal" data-categoriaid="{{$categoria['id']}}"><i class="fas fa-trash-alt"></i></a>

         <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿está seguro de eliminar este cargo?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Click en Eliminar.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form method="POST" action="{{route('categorias.destroy', $categoria)}} " >
                @method('DELETE')
                @csrf
                <input type="hidden" id="categoria_id" name="categoria_id" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
            </form>
            </div>
        </div>
        </div>
    </div>           @endcan
                {{--Original   <form method="POST" action="{{route('categorias.destroy', $categoria)}} " >
                @csrf @method('DELETE')
                <button><i class="fas fa-trash-alt"></i></button>
               </form> --}}
           </td>
            </tr>
               @empty
            <li>No Hay Categorias para mostrar</li>
            @endforelse
          
    </tbody>

</table>
    
@endsection


@section('js_categoria_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var categoria_id = button.data('categoriaid') 
            console.log(categoria_id)
            var modal = $(this)
           modal.find('.modal-footer #categoria_id').val(categoria_id);
           // modal.find('form').attr('action','/cargoItem/' + post_id);
        })
    </script>
@endsection