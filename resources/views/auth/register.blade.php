@extends('layout')

@section('title', 'Registrate')

@section('msn-boton')
    <p>Si ya tienes una cuenta inicia sesión</p>
    <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>
@endsection

@section('content')
<div id="container-panel-right">

    @include('partials/errors')

    <div id="container-form-register">

        <h1>@lang('auth.register_title')</h1>

        {!! Form::open(['route' => ['register'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
        @include('partials.form')

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                @lang('auth.register_button')
            </button>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection