@extends('layout-admin')

@section('title', @trans('title.admin'))

@section('content')

    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-user.svg') }}"></span> <span> > </span>EDITAR DATOS</h1>
        </div>
    </div>

    <div class="container-inputs-list min-top">
        @include('partials.errors')

        {!! Form::model($user, ['route' => ['admin.update', $user], 'method' => 'PUT']) !!}
        @include('partials.form')
        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                @lang('auth.update_button')
            </button>
        </div>
        {!! Form::close() !!}
    </div>

@endsection