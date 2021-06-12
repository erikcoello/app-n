

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Recibo Finanzas ENSFEP</title>
  
  
  
      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
      body {
  background: white; 
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12;
  margin-left: -1cm;
}
page1 {
  background: white;
  display: block;
  margin: 2cm ;
  margin-left:-1cm;
  margin-bottom: 0.2cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page1[size="carta"] {  
  width: 21cm;
  height: 29.7cm; 
}
@media print {
  body, page1 {
    margin: 0;
    box-shadow: 0;
  }
}
.cuerpo {
    margin-top: 2.3cm;
    margin-right:1cm;
    margin-left:-0.6cm;
     width: 21cm;
     line-height: 2.3; 


}

.agradeciendo {
    width: 21cm; 
    margin-left:0cm;
    }
    </style>



</head>

<body>

  <page size="carta">
      <div class="container">
  <div class="row ">
    <div class="col-md-12">
        <br>
        <br>
        <br>
                           <strong> DR. GERARDO PAUL ARVIZU SERAPIO</strong>
                         <br /> <strong>DIRECTOR DE LA ESCUELA NORMAL SUPERIOR</strong>
                         <br /><strong>FEDERALIZADA DEL ESTADO DE PUEBLA</strong>
                         <br /> <strong>P R E S E N T E</strong>
                        </div> {{-- div de la cabecera --}}
                         </div>
                    <div class="row">
                        <div class="cuerpo" >
   <div class="col-md-12">
                 Por este medio me permito solicitar de manera atenta, la autorización de una PRÓRROGA DE 
        <br /> {{$concepto}}, del (la) Estudiante: <strong>{{ $alumno->nombre }} {{$alumno->apellido_paterno }} 
        {{ $alumno->apellido_materno }}</strong>
        <br /> De la: <strong> {{ $nombreLic->nombreEspecialidad }}</strong>
        <br /> Para el semestre: <strong> {{$nombreSemestre->semestre}}</strong>
        <br /> Comprometiéndome a pagar el importe de <strong>$ {{$imprimir->amount }}</strong>
        <br /> Para el día: <strong> {{$imprimir->fecha_prorroga }}</strong>
        <p>
                <br><br>
            </p>
        </p>
    </div>
    </div>
   </div>{{-- div de l cuerpo --}}
 
<br>
        Agradeciendo de antenamo su amable atención y apoyo, quedo de usted.
 

<br><br>
   

    <br><br>
     <div class="text-center">  A T E N T A M E N T E 
    <br /> <br><br><br><br>  NOMBRE Y FIRMA DEL ESTUDIANTE</div>
    

 <br><br><br><br>
   <br>
  
  pvz*
</div>


  </page>

  

</body>

</html>