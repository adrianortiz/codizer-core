@extends('layout-core')

@section('title', 'Información')

@section('title-header', 'Información')


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

@endsection

@section('article-content')

@section('extra-content')
    <div class="core-tags-container">

            <ul class="nav nav-tabs" data-tabs="tabs">
                <li class="active">
                    <a href="#user-info-general" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">General</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#info" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Nombre</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#dir" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Dirección</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#tel" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Teléfono</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#mail" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Correo</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#social" data-toggle="tab">
                        <div class="companies-icon"></div>
                        <div class="companies-desc">
                            <div class="companies-title">Información</div>
                            <div class="companies-tittle-tag">Redes sociales</div>
                        </div>
                    </a>
                </li>
            </ul>

    </div>

@endsection

<div class="card-container">

    <div class="tab-content">

        <div class="form-group tab-pane active" id="user-info-general">
            <div class="container-show-info-contact-a">
                <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Adrian Ortiz Martinez</div>
            </div>
            <div class="container-list-something">
                @for($i = 0; $i <= 100; $i++)
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis, ante non molestie sagittis, felis turpis vulputate dui, et laoreet quam felis ut odio. Quisque ullamcorper consectetur dolor. Phasellus interdum consequat tortor quis egestas. Curabitur mattis urna a iaculis volutpat. Duis facilisis lorem vel viverra ultricies. Morbi semper venenatis neque, eget rhoncus enim. Morbi in malesuada sem.</p>
                @endfor
            </div>
        </div>


        <div class="form-group tab-pane" id="info">
            <div class="container-show-info-contact-a">
                <div id="show-info-contact-empresa" class="core-show-sub-title">Información</div>
                <div id="show-info-contact-nombre-completo" class="core-show-title-blue">Algo más</div>
            </div>
            <div class="container-list-something">
                @for($i = 0; $i <= 100; $i++)
                    <p>Hola</p>
                @endfor
            </div>
        </div>


        <div class="form-group tab-pane" id="dir">
            <div class="container-list-something">
                dirección
            </div>
        </div>

        <div class="form-group tab-pane" id="tel">
            <div class="container-list-something">
                telefono
            </div>
        </div>

        <div class="form-group tab-pane" id="mail">
            <div class="container-list-something">
                mail
            </div>
        </div>

        <div class="form-group tab-pane" id="social">
            <div class="container-list-something">
                social
            </div>
        </div>

    </div>

</div>

@endsection

@section('modals')


@endsection

@section('extra-js')

@endsection