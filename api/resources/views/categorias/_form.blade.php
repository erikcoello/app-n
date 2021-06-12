 @csrf
 <label>
            Título de la categoria <br>
            <input type="text" name="name" value=" {{ old('title', $categoria->name)}} " >
        </label>
        <br> 
        <label>
            Descripción de la Categoria <br>
            <input type="text" name="description"  value=" {{ old('description', $categoria->description)}}">
        </label>
        
        <br>


                {{--   <label for="self">Tipo de Categoria</label> <br/>
                  <select name="type" class="form-control">
                    <option value="add" >Categoria de entrada</option>
                    <option value="out" >Categoria de Retiro</option>
                  </select> --}}
             <br>
         <button> {{$btnTxt}} </button>