@extends('layout')

@section('title', 'Crear Categoria')


@section('content')
    

    <h1>@lang('Crear Categoria')</h1>
    
    @include('partials.session-status')
    @include('partials.validation-errors')
   <form method="POST" action=" {{route('categorias.store')}} " >
    
        @csrf
         <div class="form-group">
                <label>
            Título de la categoria </label>
            <input class="form-control" type="text" name="name" value="{{old('title', $categoria->name)}} " >
        
        </div>
        <div class="form-group">
        <label>
            Descripción de la Categoria </label>
            <input class="form-control" type="text" name="description"  value="{{old('description', $categoria->description)}}">
        
        </div>
       
                             <button  class="btn btn-primary"> guardar </button>



   </form>

@endsection