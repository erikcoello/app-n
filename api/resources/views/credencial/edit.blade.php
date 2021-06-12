@extends('layout')

@section('title', 'alumnos')
@section('scripts')
<script src="{{asset("js/bootstrap-fileinput/js/fileinput.min.js")}}" type="text/javascript"></script>
<script src="{{asset("js/bootstrap-fileinput/themes/fas/theme.min.js")}}" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/locales/LANG.js"></script> -->
<script src="{{asset("js/bootstrap-fileinput/js/locales/es.js")}}" type="text/javascript"></script>
<script src="{{asset("js/crearFoto.js")}}" type="text/javascript"></script>

@endsection
@section('content')
@foreach ($datos as $data)

<form id="a" role="form" action = "{{route('credencial.update', $data->id)}}" method = "post"  enctype="multipart/form-data">
   @csrf @method('PATCH')


    <input type="hidden" name="id_alumno" value="{{ $data->id_alumno }}">

 @endforeach
 
             

<div class="row col-md-12">
             <div class="form-group col-md-4">
        <label for="foto" class="control-label">Foto</label>
        
            <input type="file" name="nameRetrato" id="retrato" data-initial-preview="{{isset($data->foto) ? Storage::url("$data->foto") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=retrato"}}" accept="image/*"/> 
  </div>
            <div class="form-group col-md-4">
        <label for="foto" class="control-label">Firma</label>
            
            <input type="file" name="nameFirma" id="firma" data-initial-preview="{{isset($data->firma) ? Storage::url("$data->firma") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=firma"}}" accept="image/*"/> 
            </div>

             

    <button class="btn btn-primary btn-lg btn-block">Almacenar Archivos</button>
</div>

    <hr>
    
</div>

   @endsection
  