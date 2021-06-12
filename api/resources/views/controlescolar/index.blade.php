@extends('layout')

@section('title', 'alumnos')


@section('content')


   
                        
                   {{ Form::open(['route' => 'controlescolar.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) }}
                            <div class="form-group">
                                {{ Form::text('id_alumno', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por id_alumno']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::text('matricula', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por matricula']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::text('nombre', null, ['class' => 'form-control mr-sm-2', 'placeholder' => 'Busqueda por Apellido o nombre']) }}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-navbar my-2 my-sm-0">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        {{ Form::close() }} 


 
    <hr>

   
   <!-- DataTables Example -->

<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Tabla de Alumnos</div>
        <div class="col-md-12"> 
        <a href=" {{route('estudiante.create')}}"class="btn btn-primary btn-lg float-md-right" role="button">Crear Estudiante</a>
</div>
         @include('partials.session-status')
    @include('partials.validation-errors')
    @include('partials.mensaje')
     
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
    <thead>
        <tr>
            <th>id</th>
            <th>Matrícula</th>
            <th>Nombre Completo</th>
            <th>Herramientas</th>
             </tr>
         </thead>


            <tfoot>
        <tr>
               <th>id</th>
               <th>Matrícula</th>
            <th>Nombre Completo</th>
            <th>Herramientas</th>

            </tr>
             
            </tfoot>

    </thead>
        <tbody>
       
          @forelse($alumnos as $alumno)

    <tr><td>{{ $alumno->id_alumno }}</td> <td> {{ $alumno->matricula }} </td> <td> {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td> 
       <td> <a href="{{route('official.show',$alumno->id_alumno) }}" title = "Documentación Estudiante"><i class="fas fa-folder pr-2"></i></a>
      <a href="{{route('credencial.show',$alumno->id_alumno) }}" title = "credencial Estudiante"><i class="fas fa-user pr-2"></i></a>
      <a href="{{route('estudiante.edit',$alumno->id_alumno) }}" title = "Editar Estudiante"><i class="fas fa-user-edit pr-2"></i></a>
       <a href="{{route('inre.edit',$alumno->id_alumno) }}" title = "Subir datos personales"><i class="fas fa-keyboard pr-2"></i></a>
       <a href="{{route('inre.alumno',$alumno->id_alumno) }}" title = "Descargar Formato Datos Personales"><i class="far fa-address-card pr-2"></i></a>
       
         </td>


        

            @empty
            <li>No Hay Proyectos para mostrar</li>
       </tbody> 
        @endforelse
<div class="col-md-10">

    {{ $alumnos->appends(request()->all())->links() }}  

</div>

@endsection



            