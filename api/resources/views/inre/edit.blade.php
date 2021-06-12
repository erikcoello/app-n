@extends('layout')
    @section('content')
         @include('partials.session-status')
    @include('partials.validation-errors')

     
      <form id="estudiante" role="form" action = "{{route('inre.update',$alumno->id_alumno)}}" method = "post"  enctype="multipart/form-data">   
  @csrf @method('PATCH')
  <input type="hidden" name="id_alumno" value="{{ $alumno->id_alumno }}">
<div class="form-row">
    <div class="form-group col-md-4">
      <label for="nombre">Nombre(s)</label>
      <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre',$alumno->nombre)}}" >
    </div>
    <div class="form-group col-md-3">
      <label for="app">Apellido Paterno</label>
   <input type="text" class="form-control" name= "apellido_paterno" id="apellido_paterno"  value="{{old('apellido_paterno',$alumno->apellido_paterno)}}">
    </div>
    <div class="form-group col-md-3">
      <label for="apm">Apellido Materno</label>
      <input type="text" class="form-control" name= "apellido_materno" id="apellido_materno"   value="{{old('apellido_materno',$alumno->apellido_materno)}}" >
    </div>
    <div class="form-group col-md-1">
      <label for="edad">Edad</label>
      <input type="text" class="form-control" name= "edad" id="edad" placeholder="" readonly value="{{old('edad',$alumno->edad)}}" >
    </div>
     <div class="form-group col-md-1">
      <label for="inputState">Sexo</label>
    <select class="form-control formselect required" placeholder="Selecccione Sexo"
                            name="sexo" id="sexo">
              <option value="" disabled selected>Seleccione el
                               sexo</option>
                                @if($alumno->sexo == "M")
                                             <option selected value="M">M</option>
                                             <option  value="H">H</option>
                                @elseif($alumno->sexo == "H")
                                              <option selected value="H">H</option>
                                              <option  value="M">M</option>
                                              @else
                                              <option  value="M">M</option>
                                              <option  value="H">H</option>
                                             @endif
                    
                            </select>                
    </div>
  </div>
  <div class="form-row">
     <div class="form-group col-md-3">
    <label for="inputCurp">CURP</label>
    <input type="text" class="form-control" name= "curp" id="curp" placeholder="Curp" value="{{old('curp',$alumno->curp)}}" >
  </div>
  <div class="form-group col-md-2">
    <label for="inputMatricula">Matrícula</label>
    <input type="text" class="form-control" name= "matricula" id="matricula" placeholder="Matrícula" value="{{old('matricula',$alumno->matricula)}}">
  </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">Celular</label>
      <input type="text" class="form-control" name= "celular" id="celular" placeholder="# Celular" value="{{old('celular',$alumno->celular)}}" >
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" name= "correo" id="correo" placeholder="Email" value="{{old('correo',$alumno->correo)}}">
    </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">Seguro Social</label>
      <input type="text" class="form-control" name= "nss" id="nss" placeholder="Seguro Social" value="{{old('nss',$alumno->nss)}}">
    </div>
  </div>
    <div class="form-row">
     <div class="form-group col-md-3">
    <label for="inputCurp">Fecha Nacimiento</label>
    <input type="date" class="form-control" name= "fecha_nacimiento" id="fecha_nacimiento" placeholder="fecha_nacimiento" value="{{old('fecha_nacimiento',$alumno->fecha_nacimiento)}}" >
  </div>
  <div class="form-group col-md-2">
    <label for="inputMatricula">Tel. Casa</label>
    <input type="tel" class="form-control" name= "telefono" id="telefono" placeholder="Teléfono de Casa" value="{{old('alergias',$alumno->telefono)}}">
  </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">Tipo Sanguineo</label>
      <input type="text" class="form-control" name= "sangre" id="sangre" placeholder="Tipo Sanguineo" value="{{old('sangre',$alumno->sangre)}}" >
    </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">Alergías</label>
      <input type="text" class="form-control" name= "alergias" id="alergias" placeholder="alergias" value="{{old('alergias',$alumno->alergias)}}">
    </div>
    <div class="form-group col-md-3">
      <label for="inputEmail4">Enfermedades Crónicas</label>
      <input type="text" class="form-control" name= "enfermedades" id="enfermedades" placeholder="Enfermedades Cronicas" value="{{old('enfermedades',$alumno->enfermedades)}}">
    </div>
    </div>
     <div class="form-row">
     <div class="form-group col-md-3">
    <label for="inputCurp">Estado Civil</label>
    <input type="text" class="form-control" name= "edo_civil" id="edo_civil" placeholder="Estado Civil" value="{{old('edo_civil',$alumno->edo_civil)}}" >
  </div>
  <div class="form-group col-md-2">
    <label for="inputMatricula">Hijos</label>
    <input type="text" class="form-control" name= "hijos" id="hijos" placeholder="Hijos" value="{{old('hijos',$alumno->hijos)}}">
  </div>
  <div class="form-group col-md-3">
    <label for="inputMatricula">Discapacidades</label>
    <input type="text" class="form-control" name= "discapacidades" id="discapacidades" placeholder="Discapacidades" value="{{old('discapacidades',$alumno->discapacidades)}}">
  </div>
</div>
 <hr>
 <div><h4>Datos domicilio</h4></div>
  
  <div class="form-row">
 <div class="form-group col-md-3">
    <label for="calle">Calle</label>
    <input type="text" class="form-control" name= "calle" id="calle" placeholder="calle" value="{{old('calle',$alumno->calle)}}" >
  </div>
  <div class="form-group col-md-1">
    <label for="numero_exterior"># Exterior</label>
    <input type="text" class="form-control" name= "numero_exterior" id="numero_exterior" placeholder="#Exterior" value="{{old('numero_exterior',$alumno->numero_exterior)}}">
  </div>
    <div class="form-group col-md-1">
      <label for="numero_interior"># Interior</label>
      <input type="text" class="form-control" name= "numero_interior" id="numero_interior" placeholder="# Interior" value="{{old('numero_interior',$alumno->numero_interior)}}" >
    </div>
    <div class="form-group col-md-2">
      <label for="colonia">Colonia</label>
      <input type="text" class="form-control" name= "colonia" id="colonia" placeholder="colonia" value="{{old('colonia',$alumno->colonia)}}">
    </div>
    <div class="form-group col-md-1">
      <label for="codigo_postal">C. Postal</label>
      <input type="text" class="form-control" name= "codigo_postal" id="codigo_postal" placeholder="Codigo Postal" value="{{old('codigo_postal',$alumno->codigo_postal)}}">
 </div>
 <div class="form-group col-md-2">
      <label for="codigo_postal">Municipio</label>
      <input type="text" class="form-control" name= "municipio" id="municipio" placeholder="municipio" value="{{old('municipio',$alumno->municipio)}}">
 </div>
 <div class="form-group col-md-2">
      <label for="codigo_postal">Estado</label>
      <input type="text" class="form-control" name= "estado" id="estado" placeholder="estado" value="{{old('estado',$alumno->estado)}}">
 </div>
</div>

   <div class="form-row">
 <div class="form-group col-md-4">
    <label for="ln">Lugar de Nacimiento</label>
    <input type="text" class="form-control" name= "lugar_nacimiento" id="lugar_nacimiento" placeholder="lugar_nacimiento" value="{{old('lugar_nacimiento',$alumno->lugar_nacimiento)}}" >
  </div>
  <div class="form-group col-md-2">
    <label for="nacionalidad">Nacionalidad</label>
    <input type="text" class="form-control" name= "nacionalidad" id="nacionalidad" placeholder="Nacionalidad" value="{{old('nacionalidad',$alumno->nacionalidad)}}">
  </div>
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
    </div>
</div>
 <hr>
 <div><h4>Datos Escolares</h4></div>
 <div class="form-row">
 <div class="form-group col-md-4">
    <label for="calle">Bachillerato de Procedencia</label>
    <input type="text" class="form-control" name= "bachillerato" id="bachillerato" placeholder="Nombre del bachillerato de procedencia" value="{{old('bachillerato',$alumno->bachillerato)}}" >
  </div>
  <div class="form-group col-md-3">
    <label for="numero_exterior">Clave de Bachillerato</label>
    <input type="text" class="form-control" name= "clave_bachillerato" id="clave_bachillerato" placeholder="21EBH1254H" value="{{old('clave_bachillerato',$alumno->clave_bachillerato)}}">
  </div>
    <div class="form-group col-md-3">
      <label for="numero_interior">Entidad del bachillerato</label>
      <input type="text" class="form-control" name= "procedencia_bachillerato" id="procedencia_bachillerato" placeholder="Entidad de procedencia del bachillerato" value="{{old('procedencia_bachillerato',$alumno->procedencia_bachillerato)}}" >
    </div>
    <div class="form-group col-md-2">
      <label for="colonia">Promedio G. Bachiller</label>
      <input type="colonia" class="form-control" name="promedio_bachillerato" id="promedio_bachillerato" placeholder="Promedio Bachillerato" value="{{old('promedio_bachillerato',$alumno->promedio_bachillerato)}}">
    </div>
</div>
<hr>
 <div><h4>Datos del Padre o Tutor</h4></div>
  
  <div class="form-row">
 <div class="form-group col-md-4">
    <label for="calle">Nombre Completo Padre o Tutor</label>
    <input type="text" class="form-control" name= "padre_tutor" id="padre_tutor" placeholder="Nombre completo" value="{{old('padre_tutor',$alumno->padre_tutor)}}" >
  </div>
  <div class="form-group col-md-2">
    <label for="numero_exterior">Teléfono de Casa</label>
    <input type="text" class="form-control" name= "tel_tutor" id="tel_tutor" placeholder="Tel Tutor" value="{{old('tel_tutor',$alumno->tel_tutor)}}">
  </div>
    <div class="form-group col-md-2">
      <label for="numero_interior">Celular</label>
      <input type="text" class="form-control" name= "cel_tutor" id="cel_tutor" placeholder="Celular padre o tutor" value="{{old('cel_tutor',$alumno->cel_tutor)}}" >
    </div>
    <div class="form-group col-md-4">
      <label for="colonia">Correo Electronico</label>
      <input type="text" class="form-control" name= "mail_tutor" id="mail_tutor" placeholder="Correo Tutor" value="{{old('mail_tutor',$alumno->mail_tutor)}}">
    </div>
</div>




  <button type="submit" class="btn btn-primary">Guardar</button>
  <hr>
  <br>
</form>

@endsection          