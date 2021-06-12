@extends('layout')

@section('title', 'alumnos')


@section('content')


   
                        
                        {{ Form::open(['route' => 'alumnos.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('id_alumno', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por id_alumno']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::text('matricula', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por matricula']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::text('nombre', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por apellidos o nombre']) }}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-navbar my-2 my-sm-0">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        {{ Form::close() }}
                    
    {{-- <div class="col-md-6">
        <h1>@lang('alumnos')</h1>
    </div>
    <div class="col-md-6">
        <h1>@lang('busqueda')</h1>
    </div> --}}
    <hr>

{{-- row py-lg2 --}}



   <!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
          @include('partials.session-status')
    @include('partials.validation-errors')
    @include('partials.mensaje')
        <i class="fas fa-table"></i>
        Tabla de Alumnos</div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
    <thead>
        <tr>
            <th>id_alumno</th>
            <th>Matrícula</th>
            <th>Nombre Completo</th>
            <th>Herramientas</th>
            {{-- 
            <th>Permisos</th>
            <th>Herramientas</th>
        --}} </tr>
         </thead>


            <tfoot>
        <tr>
               <th>id_alumno</th>
               <th>Matrícula</th>
            <th>Nombre Completo</th>
            <th>Herramientas</th>
           {{--  <th>Rol</th>
            <th>Permisos</th>
            <th>Herramientas</th>--}}
            </tr>
             
            </tfoot>

    </thead>
        <tbody>
       
          @forelse($alumnos as $alumno)

    <tr><td>{{ $alumno->id_alumno }}</td> <td> {{ $alumno->matricula }} </td> <td> {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td> 

                       {{-- aqui le estoy pasando el id_alumno, que lo extraje del modelo Alumno que se convierte en variable de $alumnos en el form de base de datos a la vista show  --}}
                       <td> <a href="{{route('alumnos.show', $alumno->id_alumno) }}" title="Detalle Financiero Estudiante"><i class="fa fa-eye fa-1x pr-2"></i></a>  

                        @can('edit',$alumno)
                           <a href="{{route('alumnos.create', $alumno->id_alumno) }}" title="Hacer Pago o Prorroga"><i class="fab fa-cc-amazon-pay fa-1x pr-2"></i></a> 
                          
                          {{--  @can('delete', $alumno) --}}
                            <a href="{{ route('cargo-alumno.create', $alumno->id_alumno) }}" title="Asignar adeudo del semestre en curso al estudiante"><i class="far fa-credit-card fa-1x pr-2"></i></a> 
                             <a href="{{ route('cargo-alumno.show', $alumno->id_alumno) }}" title="Historial de Cargos del estudiante por semestre" ><i class="fas fa-file-invoice-dollar pr-2"></i></a> 
                        @endcan
                           </td></tr>

            @empty
            <li>No Hay Proyectos para mostrar</li>
{{--        
           <li> <a href=" {{route('/alumnos.show', $alumno) }} "> {{ $alumno->id_alumno }} </a></li> --}}
       </tbody>
        @endforelse
<div class="col-md-10">

    {{ $alumnos->appends(request()->all())->links() }}  
    
     {{--  {{$alumnos->links()}}</div>  {{ $alumnos->render() }} --}}
@endsection



            