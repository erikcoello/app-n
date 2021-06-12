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

<form id="a" role="form" action = "{{route('credencial.store')}}" method = "post"  enctype="multipart/form-data">
    @csrf 
<input type="hidden" name="id_alumno" value="{{ $id_alumno }}">

<div class="row col-md-12">
             <div class="form-group col-md-4">
        <label for="foto" class="control-label">Foto</label>
        
            <input type="file" name="nameRetrato" id="retrato" data-initial-preview="{{isset($data->retrato) ? Storage::url("credencial/$data->retrato") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=retrato"}}" accept="image/*"/> 
  </div>
            <div class="form-group col-md-4">
        <label for="foto" class="control-label">Firma</label>
            
            <input type="file" name="nameFirma" id="firma" data-initial-preview="{{isset($data->firma) ? Storage::url("credencial/$data->firma") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=firma"}}" accept="image/*"/> 
            </div>

             

    <button class="btn btn-primary btn-lg btn-block">Almacenar Archivos</button>
</div>

    <hr>
</div>

   @endsection