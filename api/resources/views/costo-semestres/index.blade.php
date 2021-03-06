@extends('layout')

@section('title', 'Costo In/Re')
@section('content')
 
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tabla costo de Semestre</div>
         {{ Form::open(['route' => 'costo-semestre.index', 'method' => 'GET', 'class' => 'form-inline pull-right p-2']) }}
                            <div class="form-group">
                                {{ Form::text('ciclo_escolar', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por Ciclo Escolar']) }}
                            </div>
                           
                        <div class="form-group">
                                <button type="submit" class="btn btn-navbar my-2 my-sm-0">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        {{ Form::close() }}
                    
       <div class="col-md-12 pt-1"> 
        <a href=" {{route('costo-semestre.create')}} "class="btn btn-primary btn-lg float-md-right" role="button">Crear Cargo</a>
</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
     
    <thead>
        <tr>
            <th>id</th>
            <th>Ciclo_Escolar</th>
            <th>Semestre</th>
            <th>Cantidad</th>
            <th>Concepto</th>
            <th>Herramientas</th>
            {{-- 
            <th>Permisos</th>
            
            <th>Herramientas</th>
        --}} </tr>
         </thead>


            <tfoot>
        <tr>
                 <th>id</th>
            <th>Ciclo_Escolar</th>
            <th>Semestre</th>
            <th>Cantidad</th>
            <th>Concepto</th>
            <th>Herramientas</th>
           {{--  <th>Rol</th>
            <th>Permisos</th>
            <th>Herramientas</th>--}}
            </tr>
             
            </tfoot>

    </thead>
        <tbody>
       
          @forelse($cargo as $cargoItem)


    <tr>
        <td>{{ $cargoItem->id }}</td> 
        <td> {{ $cargoItem->ciclo_escolar }} </td> 
        <td> {{ $cargoItem->semestre }} </td> 
         <td>   {{ $cargoItem->amount }} </td> 
          <td>  {{ $cargoItem->type }}</td> 
        {{--  <td> <a href="{{route('alumnos.show', $alumno->id_alumno) }}"><i class="fa fa-eye fa-1x pr-2"></i></a> --}}  
            <td>
                
                @can('update',$cargoItem)
             <a href=" {{route('costo-semestre.edit', $cargoItem) }}"><i class="fas fa-edit"></i></a> 
                @endcan

 @can('delete',$cargoItem)
    <a href="#"  data-toggle="modal" data-target="#deleteModal" data-cargoid="{{$cargoItem['id']}}"><i class="fas fa-trash-alt"></i></a>



    <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">??est?? seguro de eliminar este cargo?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">??</span>
            </button>
            </div>
            <div class="modal-body">Click en Eliminar.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form method="POST" action="{{route('costo-semestre.destroy', $cargoItem)}} " >
                @method('DELETE')
                @csrf
                <input type="hidden" id="cargo_id" name="cargo_id" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
            </form>
            </div>
        </div>
        </div>
    </div>
 @endcan


               {{--  @can('delete',$cargoItem)
              <form method="POST" action="{{route('costo-semestre.destroy', $cargoItem)}} " >
                @csrf @method('DELETE')
                <button><i class="fas fa-trash-alt"></i></button>
               </form>
               @endcan --}}
                  </td>

                      </tr>

            @empty
            <li>No Hay Proyectos para mostrar</li>
{{--        
           <li> <a href=" {{route('/alumnos.show', $alumno) }} "> {{ $alumno->id_alumno }} </a></li> --}}
       </tbody>
        @endforelse

<div class="col-md-10">

    {{ $cargo->appends(request()->all())->links() }}  </div>

    
     {{--  {{$alumnos->links()}}</div>  {{ $alumnos->render() }} --}}
      @endsection



@section('js_cargo_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var cargo_id = button.data('cargoid') 
            console.log(cargo_id)
            var modal = $(this)
           modal.find('.modal-footer #cargo_id').val(cargo_id);
           // modal.find('form').attr('action','/cargoItem/' + post_id);
        })
    </script>
@endsection