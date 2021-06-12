@extends('layout')

@section('title', 'Editar Proyecto')


@section('content')
    

    <h1>@lang('Editar Proyecto')</h1>
    @include('partials.session-status')

    @include('partials.validation-errors')

   <form method="POST" action=" {{route('projects.update', $project)}} " >
   @method('PATCH')
       @include('projects._form',['btnTxt' => 'Actualizar'])


   </form>

@endsection