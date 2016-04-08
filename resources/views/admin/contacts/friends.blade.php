@extends('layout-core')

@section('title', 'Amigos')

@section('title-header', 'Amigos')


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

        @forelse($friends as $friend)
            <div class="card-container-user">
                <div class="card-info">
                    <img src="{{ asset('/media/photo-perfil/' . $friend->foto) }}" width="70px" height="70px">
                    <ul>
                        <li><a href="{{ route('perfil', $friend->perfil_route) }}">{{ $friend->nombre . ' ' . $friend->ap_paterno }}</a></li>
                        <li><span>{{ $friend->profesion }}</span></li>
                    </ul>
                </div>
                <div class="card-btns">
                    <a href="{{ route('perfil', $friend->perfil_route) }}" class="btn">Ver perfil</a>
                    <button class="btn">Eliminar amistad</button>
                </div>
            </div>
        @empty
            <div id="msg-vacio">No tienes amigos.</div>
        @endforelse

    </div>


@endsection

@section('modals')

@endsection

@section('extra-js')
    <script src="{{ asset('/js/core-contacts.js') }}"></script>
@endsection