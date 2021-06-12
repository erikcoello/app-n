@extends('layout')

@section('title', $alumno)

@section('content')
<div class="row py-lg-2">
    <div class="col-md-12"><h3>@lang('Info Estudiante')</h3>
        <div class="card mb-3">
            
              @include('partials.session-status')
    @include('partials.validation-errors')
    @include('partials.mensaje')
    <div class="card-header">
        {{--  @foreach($alumno as $alumnoItem) --}}
        
        <div class="table-responsive">
           

                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 

                         <thead>
                             <tr>
                             <th>#</th>
                             <th>Matrícula</th>
                             <th>Nombre</th>
                            <th>Ciclo Escolar</th>
                             <th>Semestre</th>
                              <th>Licenciatura</th>
                              <th>Grupo</th>
                              
                             </tr>
                              </thead>


                                <tbody>
                    <tr> <td>{{ $alumno->id_alumno }} </td>  <td>{{ $alumno->matricula }} </td>
                      <td> {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} 
                       {{ $alumno->apellido_materno }}       </td>          
                       {{-- @endforeach --}}
                       <td>{{ $semestreCurso->ciclo_escolar }} </td>
                       <td>{{ $semestreCurso->semestre }} </td>
                        <td>{{ $Especialidad->nombreEspecialidad }} </td>
                         <td>{{ $Especialidad->grupo }} </td>
                         
                   </tr>
                    <thead>
                             <tr>
                             <th></th>
                             <th></th>
                             <th>Total Pagos Realizados</th>
                            <th>Total Cargos</th>
                             <th>Estatus</th>
                              <th></th>
                              <th></th>
                               
                             </tr>
                              </thead>
                   <tr>

                   <td></td>
                   <td></td>
                       
                       <td>{{ $monto }}</td>
                       <td>{{ $saldo }}</td>
                       <td class="p-3 mb-2 bg-info text-white">{{ $diferiencia }}</td>
                       <td></td>
                       <td></td>

                       </tr>
                       </tbody>
                        </table> </div>
                    </div></div>
        
    </div>
    <hr>

</div>

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
            <th>id Alumno</th>
            <th>Monto</th>
            <th>Fecha de Movimiento</th>
            
            <th>Semestre</th>
            <th>Pago Concepto</th>
            <th>Descripción</th>
            <th>Herramientas</th>
            {{-- 
            <th>Permisos</th>
            <th>Herramientas</th>
        --}} </tr>
         </thead>


            <tfoot>
        <tr>
            <th>id Alumno</th>
            <th>Monto</th>
            <th>Fecha de Movimiento</th>
           
            <th>Semestre</th>
            <th>Pago Concepto</th>
            <th>Descripción</th>
            <th>Herramientas</th>
      
            </tr>
             
            </tfoot>

    </thead>
        <tbody>

            @foreach($pago as $pagoItem)
            <tr>
                <td>{{ $pagoItem->id_alumno }}</td>
                <td> {{ $pagoItem->amount }} </td>
                <td>{{ $pagoItem->created_at }}</td>
                
                <td>  {{$pagoItem->semestre }}</td>
                <td>{{ $pagoItem->name }} </td>
                <td>{{ $pagoItem->description }}</td>



 
  <td>
     <a  target="_blank" href="/public/download/{{$pagoItem->id_pago}}" title="Ver baucher de pago"><i class="fas fa-money-bill-alt pr-2"></i></a>
    @can('edit',$pagoItem)
    <a href=" {{ route('alumnos.edit', $pagoItem ) }} " title="editar el pago o prorroga"><i class="fa fa-edit fa-1x pr-2"></i></a>
      @endcan
    <a href=" {{ route('descargarPDF', $pagoItem) }} " title="Generar recibo de prorroga"><i class="fas fa-file-alt pr-2"></i></a>

 @can('delete',$pagoItem)
  <a href="#"  data-toggle="modal" data-target="#deleteModal" data-pagoitem="{{$pagoItem['id']}}" title="Eliminar pago o prorroga"><i class="fas fa-trash-alt pr-2"></i></a>
 {{-- <form method="POST" action="{{route('alumnos.destroy', $pagoItem)}} " >
    @csrf @method('DELETE')
    <button><i class="fas fa-trash-alt"></i></button>
</form> --}}

 <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Seguro de eliminar este registro?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">¡Á</span>
            </button>
            </div>
            <div class="modal-body">Click en Eliminar.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form method="POST" action="{{route('alumnos.destroy', $pagoItem->id)}} " >
                @method('DELETE')
                @csrf
                <input type="hidden" id="pago_item" name="pago_item" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
            </form>
            </div>
        </div>
        </div>
    </div>
@endcan

 </td>   
  @endforeach              
@endsection

@section('js_cargo_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var pago_item = button.data('pagoitem') 
            console.log(pago_item)
            var modal = $(this)
           modal.find('.modal-footer #pago_item').val(pago_item);
           // modal.find('form').attr('action','/cargoItem/' + post_id);
        })
    </script>
@endsection