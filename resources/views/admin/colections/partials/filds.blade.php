<div class="form-group">
    <label for="name">@lang('collections.name_collection')</label>
    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'type' => 'text', 'placeholder' => 'Ingresa un nombre']) !!}
</div>

<div class="form-group">
    <label for="description">@lang('collections.description_collection')</label>
    {!! Form::textarea('description', null, ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'Ingresa un nombre']) !!}
</div>

@if (!Auth::guest())
    {!! Form::hidden('user_id', Auth::user()->id, ['id' => 'user_id', 'class' => 'form-control',]) !!}
@endif