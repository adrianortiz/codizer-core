@extends('layout-core')

@section('title', 'Seguidores')

@section('title-header', 'Seguidores')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

    <a href="#" class="core-menu-list menu-list-option"><div>Ver todos</div></a>
@endsection

@section('article-content')

    @section('extra-content')
        <div class="options-tools-list">
            <div class="left-content-list-tool">

                <div id="core-search-group" class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button id="core-search-group-btn" class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>

            </div>

            <div class="right-content-list-tool">
            </div>
        </div>
    @endsection

    <div class="card-container">

        @for($i = 0; $i < 130; $i++)

        <div class="card-container-user">
            <div class="card-info">
                <img src="{{ asset('/media/photo-perfil/karen-olvera123.png') }}" width="66px" height="66px">
                <ul>
                    <li><a href="#">Karen Olvera</a></li>
                    <li><span>Diseñadora</span></li>
                </ul>
            </div>
            <div class="card-btns">
                <a href="#" class="btn">Ver perfil</a>
                <button class="btn">Dejar de seguir</button>
            </div>
        </div>

        @endfor

    </div>

@endsection

@section('modals')

    @include('admin.contacts.patials.modal-contacto')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-contacts.js') }}"></script>
@endsection