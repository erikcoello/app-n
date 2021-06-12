@extends('layout')
@section('home','Contact')
@section('content')
    <h1> {{__('Contact')}} </h1>

    @include('partials.session-status')
    

    <form method="POST" action="{{route('messages.store') }}">
        @csrf
        <input type="text" name="name" placeholder="Nombre..." value=" {{old('name')}}" > <br>
        {!! $errors->first('name', '<small>:message</small><br>' ) !!}
        <input type="email" name="email" placeholder="Email..." value=" {{old('email')}} "> <br>
         {!! $errors->first('email', '<small>:message</small><br>' ) !!} 
        <input name="subject" placeholder="Asunto..." value=" {{old('subject')}} "> <br>
         {!! $errors->first('subject', '<small>:message</small><br>' ) !!} 
        <textarea name="content" placeholder="Mensaje..." value="{{old('content')}}"></textarea> <br>
         {!! $errors->first('content', '<small>:message</small><br>' ) !!} 
        <button>@lang('send')</button>
    </form>

@endsection