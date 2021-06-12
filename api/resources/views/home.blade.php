 @extends('layout')
{{--@extends('layouts.app') --}}
@section('home','Home')

@section('content')
    <h1>@lang('Home')</h1>
    @auth
    {{auth()->user()->name }}
    @endauth
@endsection 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- 

 --}}