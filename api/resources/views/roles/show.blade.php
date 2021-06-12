@extends('layout')

@section('content')

<div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Nombre del Rol: {{ $role->name }}</h3>
                <h4>Slug del Rol: {{$role->slug}} </h4>
                
            </div>
            <div class="card-body">
                <h5><div class="card-title">Rol</div> </h5>
                <p class="card-text"> </p>
            </div>

            <h5 class="car-title">Permisos Actuales</h5>
                  <p class="card-text"> </p>

        </div>
        <div class="card-footer">
            <a href="{{ url()->previous()}} " class="btn btn-primary">Regresar a los Roles</a>
        </div>




</div>



@endsection