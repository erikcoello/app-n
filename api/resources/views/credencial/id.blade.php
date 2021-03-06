<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Credencial Estudiante</title>
    <link rel="stylesheet" href="{{asset('css/credencial.css')}}">
   
</head>

<body>
 <div id='container'>
                <img src="{{ asset('img/front.jpg') }}">
    </div>
    <div id='foto'>
        
   <img src="{{asset("storage/$credencial->foto") }}"> 
       
  </div>


    <div id="nombre">
                <h1><strong>{{ $alumno->nombre }} {{$alumno->apellido_paterno }} 
        {{ $alumno->apellido_materno }}</strong></h1>
  </div>
         
        

    <div id="licenciatura"> 
        <h1><strong> {{ $nombreLic->nombreEspecialidad }}</strong></h1>
</div>


<div id="curp_static"> 
            <h1><strong>CURP:</strong></h1>
</div>

 <div id="curp"> 
            <h1><strong>{{ $alumno->curp }}</strong></h1>
</div>
<div id="matricula_static"> 
            <h1><strong>MATRÍCULA:</strong></h1>
</div>
<div id="matricula"> 
            <h1><strong>{{ $alumno->matricula }}</strong></h1>
</div>

    <div id='firma'>
              <img src="{{asset("storage/$credencial->firma") }}">   
    </div>
  

</body>

</html>