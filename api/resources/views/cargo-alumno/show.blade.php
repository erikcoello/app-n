
@extends('layout')

@section('title', $alumno)

@section('content')
<div class="row py-lg-2">
    <div class="col-md-12">
        <h3>@lang('alumno')</h3>
         @foreach($alumno as $alumnoItem)
         <div class="card-body">
        <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> <thead> <tr> <th>{{ $alumnoItem->id_alumno }} </th>  <th>{{ $alumnoItem->matricula }} </th>
                      <th> {{ $alumnoItem->nombre }} {{ $alumnoItem->apellido_paterno }} 
                       {{ $alumnoItem->apellido_materno }}       </th>          
                       @endforeach
                       
                      {{--  <th>Total de Pagos Realizados</th> <th>{{ $monto }}</th>
                       <th>Total de Cargos</th> <th>{{ $saldo }}</th>
                       <th>Adeudo</th> <th>{{ $diferiencia }}</th>
                       --}} </tr>
                       </thead>
                        </table> </div></div>
        
    </div>
    <hr>

</div>{{-- row py-lg2 --}}

   <!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Historial Pagos del Alumno</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Id_alumno</th>
            <th>Ciclo_escolar</th>
            <th>Semestre</th>
            <th>Fecha de Cargo</th>
               {{--  <th>Descripción</th>
 --}}            <th>Herramientas</th>
            {{-- 
            <th>Permisos</th>
            <th>Herramientas</th>
        --}} </tr>
         </thead>


            <tfoot>
        <tr>
            <th>Id</th>
            <th>Id_alumno</th>
            <th>Ciclo_escolar</th>
            <th>Semestre</th>
            <th>Fecha de Cargo</th>
           {{--  <th>Descripción</th>
 --}}            <th>Herramientas</th>
            {{-- 
            <th>Permisos</th>
            <th>Herramientas</th>
        --}} 
            </tr>
             
            </tfoot>

    </thead>
        <tbody>

            @foreach($cargo as $cargoItem)
            <tr>
                <td>{{ $cargoItem->id }}</td>
               <td> {{ $cargoItem->id_alumno }} </td>
                <td> {{ $cargoItem->ciclo_escolar }} </td>
                <td>  {{$cargoItem->semestre }}</td>
                <td>{{ $cargoItem->created_at }}</td>
           
     <td>
  @can('delete',$cargoItem)  
    <a href="#"  data-toggle="modal" data-target="#deleteModal" data-cargoid="{{$cargoItem['id']}}"><i class="fas fa-trash-alt"></i></a>



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
            <form method="POST" action="{{route('cargo-alumno.destroy', $cargoItem)}} " >
                @method('DELETE')
                @csrf
                <input type="hidden" id="cargo_id" name="cargo_id" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
            </form>
            </div>
        </div>
        </div>
    </div>

 {{-- <form method="POST" action="{{route('cargo-alumno.destroy', $cargoItem)}} " >
    @csrf @method('DELETE')
    <button><i class="fas fa-trash-alt"></i></button>  --}}

   @endcan

 </td> 
 </tr>  
  @endforeach              
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