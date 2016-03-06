@extends('app')

@section('content')

    @include('partials/errors')

    <div class="row"></div>
    <div class="container-login center-block">
        <div class="card" id="card-codizer-1">
            <div class="card-content">

                <div class="section ">

                    <span class="card-title black-text">@lang('auth.login_title')</span>

                    <div class="row">
                        <div class="col s12 m12 l12">

                                {!! Form::open(['route' => ['login'], 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                                    <div class="input-field col s12 m12 l12">
                                        <label for="email">@lang('validation.attributes.email')</label>
                                        {!! Form::text('email', null, ['class' => 'form-control validate', 'type' => 'email']) !!}
                                    </div>

                                    <div class="input-field col s12 m12 l12">
                                        <label for="password">@lang('validation.attributes.password')</label>
                                        {!! Form::password('password', null, ['class' => 'form-control']) !!}
                                    </div>


                                    <div class="row input-field col s12 m12 l12">
                                        <input name="remember" type="checkbox" id="remember" />
                                        <label for="remember">@lang('auth.remember')</label>
                                    </div>

                                    <div class="input-field col s12 m12 l2">
                                        <button type="submit" class="btn waves-effect waves-light deep-purple text-lighten-1 light">@lang('auth.login_button')</button>
                                    </div>

                                    <div class="input-field col s12 m12 l12">
                                        <a class="btn waves-effect waves-light blue light" href="{{ url('/password/email') }}">Forgot Your Password?</a>
                                    </div>

                                {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

