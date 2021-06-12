@extends('layout')

@section('title', 'Portfolio')


@section('content')
    

    <h1>@lang('portafolio')</h1>
    <a href=" {{route('projects.create')}} ">Crear Proyecto</a>
        @include('partials.session-status')

    <ul>
         @forelse($projects as $project)
            <li> <a href=" {{route('projects.show', $project) }} "> {{ $project->title }} </a></li>
        @empty
            <li>No Hay Proyectos para mostrar</li>
         @endforelse
         {{$projects->links()}}
    </ul>

@endsection