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

 <h2> Editar Pago</h2>

 @include('partials.session-status')
    @include('partials.validation-errors')

    <form method="POST" action=" {{ route('alumnos.update', $data->id) }} "  enctype="multipart/form-data" >
    @csrf @method('PATCH')
    <div class="form-row">
         <div class="form-group col-md-4">
      <label for="inputState">Tipo de Movimiento</label>
      <select class="form-control " id="concepto" name="concepto">
                  {{-- <option value="{{$data->concepto}}"> {{$nombreConcepto}}
                             </option>
 --}}
                        <option  value="add"  selected>
                            Pago
                        </option>
                 
                        <option value="out" selected>
                            Prorroga
                        </option>

 

                  
                    </select>
       </div>
        <div class="form-group col-md-4">
            <label for="selecccione">Ciclo_Escolar</label>
                   <select class="form-control formselect required"
                            name="ciclo_escolar" id="ciclo_escolar">
                            
                                 <option value="{{$cicloEscolarEstudiante->id_ciclo}}"> {{$cicloEscolarEstudiante->ciclo_escolar}}
                             </option>
                            @foreach($ciclo_escolar as $cicloid)
                            <option value="{{ $cicloid->id_ciclo }}" {{ old('ciclo_escolar')== $cicloid->id_ciclo ?"selected" : ""  }}>
                                {{ ucfirst($cicloid->ciclo_escolar) }}
                             @endforeach
                           
                           
                    </select>                
        </div>
       <div class="form-group col-md-4">
           <label for="seleccione">Semestre</label>
                  <select class="form-control formselect required" placeholder="Selecccione Semestre"
                            name="semestre" id="semestre">
               <option value="{{$semestreEstudiante->id_semestre}}"> {{$semestreEstudiante->semestre}}
                             </option>
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
                    <input type="text" class="form-control" name= "fecha" id="fecha" placeholder="fecha" value="{{old('fecha',$data->created_at)}}" >
        </div>

        <div class="form-group col-md-4">
          <label for="fecha">Cantidad</label>
          <div class="input-group-prepend">
             <span class="input-group-text">$</span>
                    <input type="number" class="form-control" name= "monto" id="monto" placeholder="monto" value="{{old('monto',$data->amount)}}" >
        </div></div>

        <div class="form-group col-md-4">
      <label for="concepto">Categoria</label>
      <select name="categoria" id="categoria" class="form-control">
         <option value="{{$categoriaEstudiante->id}}"> {{$categoriaEstudiante->name}}
                             </option>
    
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
                    <input type="text" class="form-control" name= "prorroga" id="prorroga" placeholder="prorroga" value="{{old('prorroga',$data->fecha_prorroga)}}" >
        </div>
      <div class="form-group col-md-4">
             <label for="comentarios">Comentarios</label>
                    <textarea name="comentarios" class="form-control" rows="3" placeholder="comentarios">{{old('comentarios',$data->description) }} </textarea>
        </textarea> 
      </div>
</div>

            <div class="form-group col-md-4">
        <label for="foto" class="control-label">Foto Baucher de Pago</label>
        
            <input type="file" name="baucher" id="baucher" data-initial-preview="{{isset($baucherFoto->path) ? Storage::url("attached/$baucherFoto->path") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=baucher"}}" accept="image/*"/> 
  </div>

 <button type="submit" class="btn btn-primary">Guardar</button>

</form>     

<hr><hr>

@endsection


{{-- 



 
    
    
            @forelse($alumno as $alumnoItem)
                <input type="hidden" name="id_alumno" value="{{$alumnoItem->id_alumno }}">
         @empty
            <li>No Hay usuario</li>
         @endforelse
 





@endsection


 --}}