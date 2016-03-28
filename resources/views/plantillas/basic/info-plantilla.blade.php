@extends('plantillas.basic.layout-plantilla-basic')

@section('cotent')

    <section class="title-basic-section">
        <article>
            <h3>Información</h3>
        </article>
    </section>

    <section class="container-products">
        <article>

            <div id="continaer-note-shows" class="right-content-list content-complete-high">

                <div class="container-list-something container-list-something-50-logo">


                    <div class="container-company-store-logo">
                        <div class="container-company-store-logo-line">
                        </div>
                        <img id="show-info-contact-logo" src="{{ asset('/media/photo-company/' . $empresa->logo) }}">
                    </div>

                    <div id="show-info-contact-empresa" class="core-show-sub-title">Empresa</div>
                    <div id="show-info-contact-nombre" class="core-show-title-blue">{{ $empresa->nombre }}</div>


                </div>

                <div class="container-list-something container-list-something-50-logo">


                    <div class="container-company-store-logo">
                        <div class="container-company-store-logo-line">
                        </div>
                        <img id="show-info-contact-logo" src="{{ asset('/media/photo-store/' . $tienda->foto) }}">
                    </div>

                    <div id="show-info-contact-empresa" class="core-show-sub-title">Tienda</div>
                    <div id="show-info-contact-nombre" class="core-show-title-blue">{{ $tienda->nombre }}</div>


                </div>


                <div class="container-list-something container-list-something-50">
                    <div>
                        <div>Tienda</div>
                        <div id="show-info-contact-sector" class="show-info-general">{{ $tienda->nombre }}</div>
                    </div>
                    <div>
                        <div>Giro de la empresa</div>
                        <div id="show-info-contact-giro-empresa" class="show-info-general">{{ $empresa->giro_empresa }}</div>
                    </div>

                    <div>
                        <div>Dirección</div>
                        <div id="show-info-contact-direccion" class="show-info-general">{{ $empresa->direccion }}</div>
                    </div>
                    <div>
                        <div>Teléfono</div>
                        <div id="show-info-contact-tel" class="show-info-general">{{ $empresa->tel }}</div>
                    </div>
                </div>

                <div class="container-list-something container-list-something-50">
                    <div>
                        <div>Página web</div>
                        <div id="show-info-contact-pagina-web" class="show-info-general">{{ $empresa->pagina_web }}</div>
                    </div>

                    <div>
                        <div>Correo</div>
                        <div id="show-info-contact-correo" class="show-info-general">{{ $empresa->correo }}</div>
                    </div>
                    <div>
                        <div>País</div>
                        <div id="show-info-contact-pais" class="show-info-general">{{ $empresa->pais }}</div>
                    </div>
                </div>
            </div>


        </article>
    </section>

@endsection


@section('modals')

@endsection

@section('extra-js')

    <script>
        // $('#btn-view-modal').click();
        $('#tag-info').addClass('menu-selected');
    </script>

@endsection