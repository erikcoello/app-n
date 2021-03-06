@extends('layout')

@section('title', 'Pago')


@section('content')

    <h1>@lang('Editar Pago Ciclo Escolar')</h1>
             @include('partials.validation-errors')
           
 <form id="a" role="form" action = " {{route('costo-semestre.update', $cargoItem)}} " method = "post"  enctype="multipart/form-data">
      @csrf @method('PATCH')

             <div class="form-group">
            <label for="exampleInputPassword1">Ciclo Escolar</label>
                         
                    <select class="form-control" name="id_ciclo" id="id_ciclo">
                  <option class="" value="">Seleccione Ciclo_Escolar</option>
                    @foreach ($ciclo_escolar as $cicloEscolarItem)    

                     
                    @if($cicloEscolarItem->id_ciclo>0)
                   
                        <option  value="{{$cicloEscolarItem->id_ciclo }}">
                   
                            {{ $cicloEscolarItem->ciclo_escolar }}
                      
                        </option>
                      @endif
                    @endforeach
                    </select>

</div>
<div class="form-group">
                     <label for="exampleInputPassword1">Semestre</label>
                         
                    <select class="form-control" name="semestre_id" id="semestre_id">
                  <option class="" value="">Seleccione Semestre</option>
                    @foreach ($semestre as $semestreItem)    

                     
                    @if($semestreItem->id_semestre>0)
                   
                        <option  value="{{$semestreItem->id_semestre}}">
                   
                            {{ $semestreItem->semestre }}
                      
                        </option>
                      @endif
                    @endforeach
                    </select>

</div>

<div class="form-group">
<label etiqueta="">Monto</label>
                  <input  maxlength="200" name="amount" type="text"   data-mask="000,000,000,000,000.00" data-mask-reverse="true"  value="{{old('amount')}}  "  class="form-control"  placeholder="Monto">
                 
                   </div>

                   <label for="pagoForm">Tipo de Movimiento</label> <br>
                   <select class="form-control " id="type_movimiento" name="type">
                   <option  value="" >
                      Seleccione Tipo
                    </option>
                  @if($type=="reinscripcion")
                        <option  value="reinscripcion"  selected>
                            REINSCRIPCI??N
                        </option>
                  @elseif($type=="inscripcion")  
                        <option value="inscripcion" selected>
                            INSCRIPCI??N
                        </option>
                   @elseif($type=="titulacion")  
                        <option value="titulacion" selected>
                            TITULACI??N
                        </option>     
                  @else 
                    <option  value="reinscripcion" >
                      REINSCRIPCI??N
                    </option>
                    <option  value="inscripcion" >
                      INSCRIPCI??N
                    </option>
                    <option  value="titulacion" >
                      TITULACI??N
                    </option>
                  @endif
                    </select> <br>


                    <br> 
                      <button  class="btn btn-primary"> Actualizar </button>

</form>{{-- Fin del Formulario --}} 


@endsection
