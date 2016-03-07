@extends('layout-core')

@section('title', 'Contactos')

@section('title-header', 'Contactos')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

    <a href="#" class="core-menu-list"><div>Seguidores</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Ver todos</div></a>
@endsection


@section('options-tools')
    <div class="options-tools-list">
        <div class="left-content-list-tool"></div>
        <div class="right-content-list-tool"></div>
    </div>
@endsection



@section('article-content')

    <div class="left-content-list">
        <table class="table table-hover">
            <tbody>
            @foreach($friends as $friend)
                <tr>
                    <td>
                        <a href="#" class="core-menu-list menu-list-option menu-lis-img list-contacts-table">
                            <img src="{{ asset('/media/photo-perfil/' . $friend -> foto) }}">
                            <div class="dropdown">{{ $friend -> nombre, ' ' .$friend -> ap_paterno }}</div>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="right-content-list"></div>
@endsection