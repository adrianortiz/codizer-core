<div class="input-group">
    {!! Form::open(['route' => ['admin.colecciones.form.data.index', $form], 'method' => 'GET', 'id' => 'form-search', 'class' => 'navbar-form navbar-left pull-right', 'role' => 'search']) !!}
        {!! Form::text('content',null, ['id' => 'content', 'placeholder' => 'Buscar', 'class' => 'form-control']) !!}
        <div class="input-group-btn">
            <button type="submit" id="btnSearch" class="btn btn-info">Buscar</button>
        </div>
    {!! Form::close() !!}
</div>