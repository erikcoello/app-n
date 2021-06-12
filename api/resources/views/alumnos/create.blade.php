@extends('layout')
@section('title', 'alumnos')
@section('scripts')
<script src="{{asset("js/bootstrap-fileinput/js/fileinput.min.js")}}" type="text/javascript"></script>
<script src="{{asset("js/bootstrap-fileinput/themes/fas/theme.min.js")}}" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/locales/LANG.js"></script> -->
<script src="{{asset("js/bootstrap-fileinput/js/locales/es.js")}}" type="text/javascript"></script>
<script src="{{asset("js/crearBaucher.js")}}" type="text/javascript"></script>

@endsection
@section('content')
 
    @include('partials.validation-errors')
    
    
    <form id="a" role="form" action = " {{route('alumnos.store')}} " method = "post"  enctype="multipart/form-data">
         @csrf
         @forelse($alumno as $alumnoItem)
                <input type="hidden" name="id_alumno" value="{{$alumnoItem->id_alumno }}">
         @empty
            <li>No Hay usuario</li>
         @endforelse
 <div class="form-row">
         <div class="form-group col-md-4">
      <label for="inputState">Tipo de Movimiento</label>
      <select class="form-control " id="concepto" name="concepto">
                   <option  value="{{ old('concepto')}}" >
                      {{ old('concepto')}}
                    </option>
                  @if($concepto=="add")
                        <option  value="add"  selected>
                            Pago
                        </option>
                 
                        <option value="out" selected>
                            Prorroga
                        </option>

 

                  @else 
                    <option  value="add" >
                      Pago
                    </option>
                    <option  value="out" >
                      Prorroga
                    </option>
                     
                  @endif
                    </select>
       </div>
        <div class="form-group col-md-4">
            <label for="selecccione">Ciclo_Escolar</label>
                   <select class="form-control formselect required" placeholder="Selecccione el Ciclo Escolar"
                            name="ciclo_escolar" id="ciclo_escolar">
                     <option value="0" disabled selected>Seleccione el
                               Ciclo_Escolar *</option>
                      @foreach($ciclo_escolar as $ceid)
                     <option  value="{{ $ceid->id_ciclo }}" {{ old('ciclo_escolar')== $ceid->id_ciclo ?"selected" : ""  }}>
                                {{ ucfirst($ceid->ciclo_escolar) }}

                    </option>
                            @endforeach
                    </select>                
        </div>
       <div class="form-group col-md-4">
           <label for="seleccione">Semestre</label>
                  <select class="form-control formselect required" placeholder="Selecccione Semestre"
                            name="semestre" id="semestre">
              <option value="0" disabled selected>Seleccione el
                               semestre *</option>
                            @foreach($semestre as $id_sem)
                            <option  value="{{ $id_sem->id_semestre }}" {{ old('semestre')== $id_sem->id_semestre ?"selected" : ""  }}>
                                {{ ucfirst($id_sem->semestre) }}

                      </option>
                            @endforeach
                        </select>                
    </div>

</div>
  
  <div class="form-row">
        <div class="form-group col-md-4">
             <label for="fecha">Fecha de solicitud</label>
                    <input type="date" class="form-control" name= "fecha" id="fecha" placeholder="fecha" value="{{old('fecha')}}" >
        </div>

        <div class="form-group col-md-4">
          <label for="fecha">Cantidad</label>
          <div class="input-group-prepend">
             <span class="input-group-text">$</span>
                    <input type="number" class="form-control" name= "monto" id="monto" placeholder="monto" value="{{old('monto')}}" >
        </div></div>

        <div class="form-group col-md-4">
      <label for="concepto">Categoria</label>
      <select name="categoria" id="categoria" class="form-control">
        <option selected>Seleccione...</option>
        @foreach ($categorias as $id_cat)    

                     
                    @if($id_cat->id>0)
                   
                        <option  value="{{ $id_cat->id}}" {{ old('categoria')== $id_cat->id ?"selected" : ""  }}>
                   
                            {{ $id_cat->name }}
                      
                        </option>
                      @endif
                    @endforeach
                    
      </select>
   



  </div>
   </div>
 <div class="form-row">
       <div class="form-group col-md-4">
             <label for="fecha_prorroga">Fecha Pago de Prorroga</label>
                    <input type="date" class="form-control" name= "prorroga" id="prorroga" placeholder="prorroga" value="{{old('prorroga')}}" >
        </div>
      <div class="form-group col-md-4">
             <label for="comentarios">Comentarios</label>
                    <textarea name="comentarios" class="form-control" rows="3" placeholder="comentarios">{{old('comentarios') }} </textarea>
        </textarea> 
      </div>
</div>

            <div class="form-group col-md-4">
        <label for="foto" class="control-label">Foto Baucher de Pago</label>
        
            <input type="file" name="baucher" id="baucher"  data-initial-preview="{{isset($data->retrato) ? Storage::url("credencial/$data->baucher") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=baucher"}}" accept="image/*"/> 
  </div>

 <button type="submit" class="btn btn-primary">Guardar</button>

</form>     






@endsection