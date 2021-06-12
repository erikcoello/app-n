@extends('layout')

@section('title', 'alumnos')
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>
<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/themes/fas/theme.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/locales/LANG.js"></script>
<script src="{{asset("js/crear.js")}}" type="text/javascript"></script>

@endsection
@section('content')

<form id="a" role="form" action = "{{route('official.store')}}" method = "post"  enctype="multipart/form-data">
    @csrf 

@forelse($id_alumno as $alumnoItem)
  <input type="hidden" name="id_alumno" value="{{ $alumnoItem->id_alumno }}">
        @empty
            <!-- <li>No Hay usuario</li> -->
             @endforelse

<div class="row col-md-12">
             <div class="form-group col-md-4">
        <label for="foto" class="control-label">Certificado en PDF</label>
        
            <input type="file" name="bachiller" id="certBachiller" data-initial-preview="{{isset($data->certBachiller) ? Storage::url("imagenes/official/$data->certBachiller") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Certificado"}}" accept="pdf"/> 
        
  </div>
            <div class="form-group col-md-4">
        <label for="foto" class="control-label">Curp en PDF</label>
            
            <input type="file" name="curp" id="curp" data-initial-preview="{{isset($data->curp) ? Storage::url("imagenes/official/$data->curp") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Curp"}}" accept="pdf"/> 
            </div>

             <div class="form-group col-md-4">
        <label for="foto" class="control-label">Acta Nacimiento en PDF</label>
        
            <input type="file" name="nacimiento" id="nacimiento" data-initial-preview="{{isset($data->nacimiento) ? Storage::url("imagenes/official/$data->nacimiento") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Nacimiento"}}" accept="pdf"/> 
           </div>

    <button class="btn btn-primary btn-lg btn-block">Almacenar Archivos</button>
</div>

    <hr>
</div>

   @endsection