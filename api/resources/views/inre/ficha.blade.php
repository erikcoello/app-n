<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>IN RE ENSFEP</title>
    <link rel="stylesheet" href="{{asset('css/ficha_escolar.css')}}">
   
</head>

<body>
    <div class="container">
      
      <div class="row col-12">
      
           <h1>SECRETARÍA DE EDUCACIÓN PÚBLICA<br />
                ESCUELA NORMAL SUPERIOR FEDERALIZADA DEL ESTADO DE PUEBLA
                <br /> CLAVE: 21DNL0006L</h1> 
  <div class="col-md-1 sep">
                <img src="{{ asset('img/sep.png')}}">
        </div>
          
  <div class="col-1 federalizada">
           <img src="{{ asset('img/ensfep_2015.png') }}">
        </div>
  </div>

      
      <h3 class="col-12 titulo">FECHA   
        {{$fecha_inre->fecha_in_re}} </h3>
      <h3 class="col-12 ingreso">@if($semestreCurso->id_semestre==1)    FORMATO INSCRIPCIÓN @else   FORMATO REINSCRIPCIÓN  @endif</h3>
      <h3 class="col-12 folio">Folio: {{$cicloCurso->ciclo_escolar . $alumno->curp . $alumno->id_alumno }}</h3> 
      <img class= "box" src="{{asset("storage/$credencial->foto") }}"width=110px;>


 <table class="table table-striped table-sm">
  <thead>
    <tr class="">
      <th >Nombre</th>
      <th >Curp</th>
      <th >edad</th>
      <th >Matrícula</th>
      <th >celular</th>
    </tr>
  </thead>
  <tbody>
   

    <tr class="table-primary">
      <td>{{$alumno->nombre .' '.$alumno->apellido_paterno . ' ' . $alumno->apellido_materno}}</td>
      <td>{{$alumno->curp}}</td>
      <td>{{$alumno->edad}}</td>
      <td>{{$alumno->matricula}} </td>
      <td>{{$alumno->celular}} </td>
    </tr>
    <tr>
      <th >Email</th>
      <th>Seguro Social</th>
      <th >Tipo Sanguineo</th>
      <th >Fecha Nacimiento</th>
      <th colspan="2">Tel. Casa</th>
    </tr>
    <tr class="table-primary">
      <td>{{$alumno->correo}}</td>
      <td>{{$alumno->nss}}</td>
      <td>{{$alumno->sangre}}</td>
      <td>{{$alumno->fecha_nacimiento}} </td>
      <td colspan="2">{{$alumno->telefono}} </td>
    </tr>
     <tr>
      <th scope="col">Edo. Civil</th>
      <th scope="col">Hijos</th>
      <th scope="col">Discapacidades</th>
      <th scope="col">Alergias</th>
      <th scope="col">Enfermedades Cronicas</th>
    </tr>
    <tr class="table-primary">
      <td>{{$alumno->edo_civil}}</td>
      <td>{{$alumno->hijos}}</td>
      <td>{{$alumno->discapacidades}}</td>
      <td>{{$alumno->alergias}} </td>
      <td>{{$alumno->enfermedades}} </td>
    </tr>
     <tr>
      <th scope="col">Domicilio</th>
      <th scope="col"></th>
      <th scope="col"></th>

      <th scope="col">Lugar de Nac.</th>
       <th scope="col"></th>
      
      
    </tr>
    <tr class="table-primary">
    
     <td colspan="3" scope="row">{{ $alumno->calle . ' ' . $alumno->numero_exterior . ' ' . $alumno->numero_interior . ' ' .$alumno->colonia. ' ' . $alumno->codigo_postal . ' ' . $alumno->municipio . ' ' . $alumno->estado }}
    </td>
     <td colspan="2" scope="col">{{$alumno->lugar_nacimiento}}</td>

     </tr>
      <tr>
      <th colspan="2" scope="col">Nombre Tutor</th>
      <th scope="col">Telefono de Casa</th>
      <th scope="col">Celular</th>
      <th scope="col">Email</th>
    </tr>
     <tr class="table-primary">
      <td colspan="2">{{$alumno->padre_tutor}}</td>
      <td>{{$alumno->tel_tutor}}</td>
      <td>{{$alumno->cel_tutor}}</td>
      <td>{{$alumno->mail_tutor}} </td>
    </tr>
    <tr>
      <th colspan="2" scope="col">Licenciatura</th>
      <th scope="col">Semestre</th>
      <th scope="col">Grupo</th>
      <th scope="col">Ciclo_escolar</th>
    </tr>
    <tr class="table-primary">
      <td colspan="2" >{{$nombreLic->nombreEspecialidad}}</td>
      
      <td>{{$semestreCurso->semestre}}</td>
      <td>{{$licenciatura->grupo}}</td>
     <td>{{$cicloCurso->ciclo_escolar}} </td>
    </tr>
  </tbody>
</table>
<table class="firmas" >
  <td>DANIELA SOTO NOCELO <br>_________________________________________
              <br>  FIRMA JEFA DE OFICINA <br>  DE CONTROL ESCOLAR</td>
              <td><img src="{{asset("storage/$credencial->firma") }}"width=110px;><br>_________________________________________<br>
              FIRMA DEL ESTUDIANTE
            </td>
              <td> DR. GERARDO PAUL ARVIZU SERAPIO <br> _________________________________________
         <br> FIRMA DIRECTOR GENERAL</td>
</table>
</div>


</body>

</html>