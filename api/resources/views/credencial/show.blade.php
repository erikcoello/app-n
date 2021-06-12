@extends('layout')

    @section('title', 'alumnos')
            @section('content')
                <div class="row py-lg-2">
                    <div class="col-md-12">
                         <h3>@lang('Info Estudiante')</h3>
                    <div class="card mb-3">
                            <div class="card-header">
        
    <div class="table-responsive">
      @include('partials.validation-errors')
    @include('partials.mensaje')
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 

                         <thead>
                             <tr>
                             <th>Id_alumno</th>
                             <th>Matrícula</th>
                             <th>Nombre</th>
                            <th>Ciclo Escolar</th>
                             <th>Semestre</th>
                              <th>Licenciatura</th>
                              <th>Grupo</th>
                              <th>Herramientas</th>
                              
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
                         <td>                              
                   <a href=" {{ route('credencialPDF', $alumno->id_alumno) }} " title="Visualizar Credencial"><i class="fas fa-id-card-alt pr-2"></i></a>
                   <a href=" {{ route('credencial.create', $alumno->id_alumno) }} " title="Subir Foto y Firma"><i class="fas fa-file-upload pr-2"></i></a>
                   <a href=" {{ route('credencial.edit', $alumno->id_alumno) }} " title="Editar Foto y/o Firma"><i class="fas fa-edit pr-2"></i></a>
                  @if($data != Null)
                  <a href="#"  data-toggle="modal" data-target="#deleteModal" data-dataid="{{$data->id}}" title="Eliminar Documentos"><i class="fas fa-trash-alt pr-2"></i></a>
                    @endif
                </td>
                   </tr>
                  
                       </tbody>
                        </table> </div>
                    </div></div>
        
    </div>
    <!-- delete Modal-->
    @if($data != Null)
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿está seguro de eliminar los ficheros?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">Click en Eliminar.</div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <form method="POST" action="{{route('credencial.destroy', $data->id)}} " >
                @method('DELETE')
                @csrf
                <input type="hidden" id="id_alumno" name="id_alumno" value="{{$alumno->id_alumno}}">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
            </form>
            </div>
        </div>
        </div>
    </div>
    @endif
    <hr>
    

</div>{{-- row py-lg2 --}}

@endsection
@section('js_cargo_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var data_id = button.data('dataid') 
            console.log(data_id)
            var modal = $(this)
           modal.find('.modal-footer #pago_item').val(data_id);
           // modal.find('form').attr('action','/cargoItem/' + post_id);
        })
    </script>
@endsection
    





























