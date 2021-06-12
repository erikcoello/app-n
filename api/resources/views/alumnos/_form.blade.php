
                   

                 <label for="exampleInputPassword1">Concepto</label>
                         
                    <select class="form-control" name="categories_id" id="categorie_select">
                  <option class="" value="">Seleccione Concepto</option>
                    @foreach ($data2 as $dataItem)    

                     
                    @if($dataItem->id!=1)
                   
                        <option class="attr-{{$dataItem->type}}" value="{{ $dataItem->id }}">
                   
                            {{ $dataItem->name }}
                      
                        </option>
                      @endif
                    @endforeach
                    </select>

                    <label etiqueta="">Fecha de Prorroga</label>
                  <input  maxlength="70" name="fecha_prorroga" type="text"  value="{{ old('fecha_prorroga', $data->fecha_prorroga)}} "  class="form-control"  placeholder="'No aplica' en caso de no ser prorroga"> 
                  <br>
                     <div class="form-group">
                      <label for="exampleFormControlTextarea1">Comentarios</label>
            <textarea name="description" class="form-control" rows="3" placeholder="mensaje..."> {{old('description', $data->description) }} </textarea>
        </div>
                   {{--  <div class="form-group">
                    <label for="exampleInputEmail1">Adjuntar Imagen Baucher de Pago</label>
                    <input type="file"  name="path"  class="form-control" placeholder="Nombre del archivo">

                   </div> --}}
                     <button  class="btn btn-primary"> {{$btnTxt}} </button>