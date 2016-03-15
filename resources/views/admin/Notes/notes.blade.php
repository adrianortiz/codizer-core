@extends('layout-core')

@section('title', 'Notas')

@section('title-header', 'Notas')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    <a href="#" class="core-menu-list"><div>Notas</div></a>
    <a href="#" class="core-menu-list menu-list-option" data-toggle="modal" data-target="#modalNewNote"><div>Nueva nota</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Notas compartidas</div></a>

@endsection


@section('article-content')

@section('extra-content')
    <div class="options-tools-list">
        <div class="left-content-list-tool">
            <div class="btn-group" role="group" aria-label="...">
                <button type="button" class="btn btn-default btn-sm">1</button>
                <button type="button" class="btn btn-default btn-sm">2</button>

                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="right-content-list-tool">

            <div id="btn-group-to-note" style="display:  none" class="btn-group" role="group" aria-label="...">
                <button type="button" id="btn-edit-note" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalUpdateNote">Editar</button>
                <button type="button" id="btn-delete-note" class="btn btn-default btn-sm">Eliminar</button>
            </div>

        </div>
    </div>
@endsection

<div class="left-content-list">
    <table class="table table-hover">
        <tbody id="list-notes">

            @foreach($notes as $note)
            <tr class="data-note-tr" data-note="{{ $note->id }}">
                <td>
                    <a href="#" class="core-menu-list menu-list-option menu-lis-img list-contacts-table">
                        <div class="dropdown">{{ substr($note->content, 0, 22) . '...' }}<br/>{{ $note->updated_at }}</div>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div id="continaer-note-shows" class="right-content-list">
    <div id="msg-vacio">Ninguna nota seleccionada.</div>
    <!-- <div class="block-content-info"></div> -->
</div>
@endsection

@section('modals')

    @include('admin.Notes.patials.modal-nota')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-notes.js') }}"></script>
@endsection