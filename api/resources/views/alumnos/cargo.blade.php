@extends('layout')

@section('title', 'alumnos')


@section('content')

<form id="a" role="form" action = " {{route('alumnos.saveCargo')}} " method = "post"  enctype="multipart/form-data">
     @csrf
@forelse($alumno as $alumnoItem)
  <input type="hidden" name="id_alumno" value="{{ $alumnoItem->id_alumno }}">
        @empty
            <li>No Hay usuario</li>
         @endforelse


   <h3 align="center">Asignación De Cargos Por Ciclo Escolar Y Semestre Por Estudiante</h3><br />

   <div class="form-group">
               <label for="exampleInputPassword1">Ciclo Escolar</label>

    <select name="id_ciclo" id="id_ciclo" class="form-control input-lg dynamic" data-dependent="id_semestre">
     <option value="">Seleccione el Ciclo Escolar</option>

     @foreach($listaCE as $id_ciclo)

    
      <option value="{{ $id_ciclo->id_ciclo}}">{{ $id_ciclo->ciclo_escolar }}</option>
       @endforeach
    </select>
   </div>
   <br />
   <div class="form-group">
                <label for="exampleInputPassword1">Semestre</label>

    <select name="id_semestre" id="id_semestre" class="form-control input-lg dynamic" >
     <option value="">Seleccione el Semestre</option>
    </select>
   </div>
    <button  class="btn btn-primary"> guardar </button>

  
</form>
@section('scripts')
  <script>
$(document).ready(function(){

 $('.dynamic').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('alumnos.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result);
    }

   })
  }
 });

 $('#id_ciclo').change(function(){
  $('#id_semestre').val('');

 });

 

});
</script>

@endsection
    
@endsection