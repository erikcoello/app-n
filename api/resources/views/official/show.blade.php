@extends('layout')

    @section('title', 'alumnos')
            @section('content')
                <div class="row py-lg-2">
                    <div class="col-md-12">
                         <h3>@lang('Info Estudiante')</h3>
                    <div class="card mb-3">
                            <div class="card-header">
        
    <div class="table-responsive">
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
                         <td> <a href="{{route('official.create',$alumno->id_alumno) }}" title="Subir"><i class="fas fa-file-upload pr-2"></i></a> 
                            <a href="{{route('official.edit',$data) }}" title="Editar/Ver"><i class="fas fa-edit pr-2"></i></a> 

                            <a href="{{route('official.bachiller',$data)}} "target="_blank" title="visualizar Certificado"><i class="fas fa-chalkboard-teacher pr-2"></i></a>
                             <a href="{{route('official.curp',$data)}} "target="_blank" title= "Visualizar Curp"><i class="fas fa-info pr-2"></i></a>
                             <a href="{{route('official.acta',$data)}} "target="_blank" title= "Visualizar Acta Nac."><i class="fas fa-id-badge pr-2"></i></a>


                           {{-- original <a href="{{route('official.detail',$data_file->id) }}"><i class="far fa-eye pr-2"></i></a>  --}}
                          
                        <a href="#"  data-toggle="modal" data-target="#deleteModal" data-dataId="{{$data}}" title="Eliminar Documentos"><i class="fas fa-trash-alt pr-2"></i></a></td>
                   </tr>
                  
                       </tbody>
                        </table> </div>
                    </div></div>
        
    </div>
    <!-- delete Modal-->
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
            <form method="POST" action="{{route('official.destroy', $data)}} " >
                @method('DELETE')
                @csrf
                <input type="hidden" id="pago_item" name="pago_item" value="">
                <a class="btn btn-primary" onclick="$(this).closest('form').submit();">Eliminar</a>
            </form>
            </div>
        </div>
        </div>
    </div>
    <hr>
    

</div>{{-- row py-lg2 --}}

@endsection
@section('js_cargo_page')
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) 
            var data = button.data('data') 
            console.log(data)
            var modal = $(this)
           modal.find('.modal-footer #dataId').val(data);
           // modal.find('form').attr('action','/cargoItem/' + post_id);
        })
    </script>
@endsection