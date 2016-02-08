        <div class="form-group">
            <label for="name">@lang('validation.attributes.name')</label>
            {!! Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="email">@lang('validation.attributes.email')</label>
            {!! Form::email('email', old('email'), ['id' => 'email', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="password">@lang('validation.attributes.password')</label>
            {!! Form::password('password', ['id' => 'password', 'class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <label for="password_confirmation">@lang('validation.attributes.password_confirmation')</label>
            {!! Form::password('password_confirmation', ['id' => 'password_confirmation', 'class' => 'form-control']) !!}
        </div>