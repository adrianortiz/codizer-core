@extends('layout-core')

@section('title', 'Notas')

@section('title-header', 'Notas')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    <a href="#" class="core-menu-list"><div>Notas</div></a>
    <a href="#" id="btn-list-all-notes" class="core-menu-list menu-list-option"><div>Todas las notas</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Notas compartidas</div></a>

@endsection


@section('article-content')

@section('extra-content')
    <div class="options-tools-list">

        <div class="left-content-list-tool">
            <div id="core-search-group" class="input-group input-group-sm">
                <input type="text" class="form-control" placeholder="Buscar por...">
                <span class="input-group-btn">
                    <button type="button" id="core-search-group-btn" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>

        <div class="right-content-list-tool">
            <div id="btn-group-to-product" class="btn-group left" role="group" aria-label="...">
                <button type="button" id="btn-new-product" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalNewNote">Nueva nota</button>
            </div>
            <div id="btn-group-to-note" style="display:  none" class="btn-group right" role="group" aria-label="...">
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
            <tr class="data-note-tr" data-note="{{ $note -> id }}">
                <td class="container-list-point">
                    <div></div>
                    <div></div>
                    <div></div>
                </td>
                <td>
                    <div class="list-note-content">{{ substr($note->content, 0, 41) . '...' }} </div>
                    <span class="list-note-date-update">{{ $note->updated_at }}</span>
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