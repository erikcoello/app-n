@extends('layout')

@section('title', 'Crear Proyecto')


@section('content')
    

    <h1>@lang('Crear Proyecto')</h1>
    
    @include('partials.session-status')
    @include('partials.validation-errors')
   <form method="POST" action=" {{route('projects.store')}} " >
    
       
       @include('projects._form',['btnTxt' => 'Guardar'])
       


   </form>

@endsection