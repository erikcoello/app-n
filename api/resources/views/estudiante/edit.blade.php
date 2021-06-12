@extends('layout')

@section('title', 'alumnos')


@section('content')
@include('partials.validation-errors')
<form id="estudiante" role="form" action = " {{route('estudiante.update',$alumno->id_alumno)}} " method = "post"  enctype="multipart/form-data">   @csrf @method('PATCH')
  <input type="hidden" name="id_alumno" value="{{ $alumno->id_alumno }}">
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="nombre">Nombre(s)</label>
      <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre', $alumno->nombre)}}" >
    </div>
    <div class="form-group col-md-4">
      <label for="app">Apellido Paterno</label>
   <input type="text" class="form-control" name= "apellido_paterno" id="apellido_paterno" value="{{old('apellido_paterno',$alumno->apellido_paterno)}}">
    </div>
    <div class="form-group col-md-4">
      <label for="apm">Apellido Materno</label>
      <input type="text" class="form-control" name= "apellido_materno" id="apellido_materno" value="{{old('apellido_materno', $alumno->apellido_materno)}}" >
    </div>

  </div>
  <hr>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Celular</label>
      <input type="number" class="form-control" name= "celular" id="celular" placeholder="# Celular" value="{{old('celular', $alumno->celular)}}" >
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" name= "email" id="email" placeholder="Email" value="{{old('email', $alumno->correo)}}">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name= "pass" id="pass" placeholder="Password" value="{{old('pass')}}">
    </div>
    <div class="form-group col-md-3">
        <label for="password_confirmation">Repetir Contraseña</label>
        <input type="password" name="pass_confirmation" class="form-control" placeholder="Confirmar contraseña" id="pass_confirmation">
    </div>
  
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputCurp">CURP</label>
    <input type="text" class="form-control" name= "curp" id="curp" placeholder="Curp" value="{{old('curp',$alumno->curp)}}" >
  </div>
  <div class="form-group col-md-6">
    <label for="inputMatricula">Matrícula</label>
    <input type="text" class="form-control" name= "matricula" id="matricula" placeholder="Matrícula" value="{{old('matricula',$alumno->matricula)}}">
  </div>
 </div>
 <hr>
 
  <div class="form-row">
   <!--  <div class="form-group col-md-4">
      <label for="ciclo_escolar">Ciclo Escolar</label>
       <select  name="ciclo_escolar" id="ciclo_escolar" class="form-control">
                             
                    @if($cicloEscolarEstudiante->id_ciclo>0)
                   
                        <option  value="{{ $cicloEscolarEstudiante->id_ciclo }}" {{ old('ciclo_escolar')== $cicloEscolarEstudiante->id_ciclo ?"selected" : ""  }}>
                   
                            {{ $cicloEscolarEstudiante->ciclo_escolar }}
                      
                        </option>
                      @endif
                    
      </select>
    </div> -->
    <div class="form-group col-md-4">
      <label for="inputState">Plan de Estudios</label>
    <select class="form-control formselect required" placeholder="Selecccione Plan de Estudios"
                            name="plan_estudios" id="plan_estudios">
              <option value="0" disabled selected>Seleccione el
                               plan de estudios *</option>
                            @foreach($plan_estudios as $planid)
                            <option  value="{{ $planid->id_plan }}" {{ old('plan_estudios')== $planid->id_plan ?"selected" : ""  }}>
                                {{ ucfirst($planid->plan_estudios) }}

                      </option>
                            @endforeach
                        </select>                
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Especialidad</label>
      <select class="form-control formselect required" name="idEspecialidad" id="idEspecialidad" placeholder="Seleccionar Especialidad">
          <option  value="{{ $EspecialidadEstudiante->idEspecialidad}}">
            {{($EspecialidadEstudiante->nombreEspecialidad) }}
            
                  
                </select>
            
    </div>
     <div class="form-group col-md-2">
      <label for="inputState">Grupo</label>
      <select class="form-control " id="grupoAlumno" name="grupoAlumno">
                   <option  value="{{old('$ingreso->grupo')}}" >
                      Seleccione Grupo
                    </option>
                  @if($ingreso->grupo=="A")
                        <option  value="A"  selected>
                            A
                        </option> 
                 
                        <option value="B" selected>
                            B
                        </option> 
                
                        <option value="" selected>
                            Único
                        </option>      
                  @else 
                    <option  value="A" >
                      A
                    </option>
                    <option  value="B" >
                      B
                    </option>
                   
                  @endif
                    </select>
    </div>
        </div>
 <div class="form-row"><!-- 
 <div class="form-group col-md-4">
      <label for="semestre">Semestre de Ingreso</label>
      <select name="id_semestre" id="id_semestre" class="form-control">
        <option selected>Seleccione...</option>
        @foreach ($semestre as $semestreId)    

                     
                    @if($semestreId->id_semestre>0)
                   
                        <option  value="{{ $semestreId->id_semestre }}" {{ old('id_semestre')== $semestreId->id_semestre ?"selected" : ""  }}>
                   
                            {{ $semestreId->semestre }}
                      
                        </option>
                      @endif
                    @endforeach
                    
      </select>
    </div> -->
   
     
     <!--  <div class="form-group col-md-4">
      <label for="inputState">Tipo de Ingreso</label>
       <select class="form-control " id="tipo_ingreso" name="tipo_ingreso">
                   <option  value="" >
                      Seleccione...
                    </option>
                  @if($ingreso->tipo_ingreso=="nuevo")
                        <option  value="nuevo"  selected>
                            Nuevo
                        </option>
                  @elseif($ingreso->tipo_ingreso=="traslado")  
                        <option value="traslado" selected>
                            Traslado
                        </option> 
                  @else 
                    <option  value="nuevo" >
                      Nuevo
                    </option>
                    <option  value="traslado" >
                      Traslado
                    </option>
                  @endif
                    </select>
    </div> -->
  </div>
  
  <button type="submit" class="btn btn-primary">Guardar</button>
  <hr>
  <br>
</form>
@endsection
@section('scripts')
 <script>
                $(document).ready(function () {
                $('#plan_estudios').on('change', function () {
                let id_plan = $(this).val();
                console.log(id_plan)
                $('#idEspecialidad').empty();
                $('#idEspecialidad').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                type: 'GET',
                url: '../../getEspecialidades/'+ id_plan,
                success: function (response) {
                var response = JSON.parse(response);
               // console.log(response);   
                $('#idEspecialidad').empty();
                $('#idEspecialidad').append(`<option value="0" disabled selected>Select Especialidad*</option>`);
                response.forEach(element => {

                    $('#idEspecialidad').append(`<option value="${element['idEspecialidad']}">${element['nombreEspecialidad']}</option>`);
                    });
                }
            });
        });
    });
    </script>
  @endsection

