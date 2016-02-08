<div class="btn-group menu-global-collection" role="group" aria-label="...">
    <a href="{{ route('form', $form) }}" class="btn btn-default">Nuevo registro</a>

    <div class="btn-group" role="group">
        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span><img src="{{ asset('/images/icon-menu-white.svg') }}" class="icon-button"></span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-codizer">
            <li><a href="{{ route('form', $form) }}">
                    <span><img src="{{ asset('/images/new.svg') }}" class="icon-button"></span>
                    Nuevo registro</a></li>

            <li><a href="{{ route('admin.colecciones.form.data.index', $form) }}">
                    <span><img src="{{ asset('/images/icon-textarea-white.svg') }}" class="icon-button"></span>
                    Gestionar registros</a></li>

            <li role="separator" class="divider"></li>

            <li><a href="{{ route('admin.complements.edit', $form) }}">
                    <span><img src="{{ asset('/images/input-white.svg') }}" class="icon-button"></span>
                    Complements</a></li>


            <li role="separator" class="divider"></li>

            <li><a href="{{ route('admin.colecciones.edit', $form) }}">
                    <span><img src="{{ asset('/images/icon-edit-white.svg') }} " class="icon-button"></span>
                    Editar colleción</a></li>

            <li role="separator" class="divider"></li>

            <li><a href="{{ url('/admin/colecciones') }}">
                    <span><img src="{{ asset('/images/icon-complements-white.svg') }}" class="icon-button"></span>
                    Ver mis colecciones</a></li>
        </ul>
    </div>
</div>