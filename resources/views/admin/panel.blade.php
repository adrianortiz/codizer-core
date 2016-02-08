@extends('layout-admin')

@section('title', @trans('title.admin'))

@section('content')

    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-user.svg') }}"></span> <span> > </span> Hola {{ Auth::user()->name }} </h1>
        </div>
    </div>

    <div class="container-inputs-list min-top">

        <div class="container-form">
            <div class="container-form-titulo">
                <div id="container-form-icon-collection" class="container-form-icon"></div>
                <div><h3>Panel</h3></div>
            </div>
            <ul>
                <li><a href="{{ route('admin.edit', Auth::user()->id) }}">Edit profile</a></li>
                <li><a href="#">Change password</a></li>
                <p>
                </p>
            </ul>
        </div>
    </div>

@endsection