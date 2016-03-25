/**
 * Created by Codizer on 3/24/16.
 */
$('#extra-tag').addClass('companies-tag-selectionated');

var ofertaContainer = $('#container-oferta');
var ofertaOldContainerToHide = null;

function addOferta(result) {
    return '<div class="extra-container-mini" data-id="' + result.oferta.id + '"> <div class="btn-extra-container"> <div class="btn-group" role="group"> <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra btn-extra-azul-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-h fa-lg"></i> </button> <ul class="dropdown-menu"> <li><a class="btn-update-oferta" href="#" data-toggle="modal" data-target="#modalUpdateOferta">Editar Oferta</a></li> </ul> </div> </div> <div class="body-extra"> <span class="txt-color-azul">Oferta</span> <div>'+ result.oferta.tipo_oferta + ' ' + result.oferta.regla_porciento +'%</div> </div> </div>';
}

function fillFormOferta(result) {
    $('#id-oferta-show').val(result.oferta.id);
    $('#regla_porciento-oferta-show').val(result.oferta.regla_porciento);
    $('#tipo_oferta-oferta-show').val(result.oferta.tipo_oferta);
}


var categoriaContainer = $('#container-categoria');
var categoriaOldContainerToHide = null;

function addCategoria(result) {
    return '<div class="extra-container-mini" data-id="' + result.categoria.id + '"> <div class="btn-extra-container"> <div class="btn-group" role="group"> <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra btn-extra-morado-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-h fa-lg"></i> </button> <ul class="dropdown-menu"> <li><a class="btn-update-categoria" href="#" data-toggle="modal" data-target="#modalUpdateCategoria">Editar Categoría</a></li> </ul> </div> </div> <div class="body-extra"> <span class="txt-color-morado">Categoría</span> <div>'+ result.categoria.nombre +'</div> </div> </div>';
}

function fillFormCategoria(result) {
    $('#id-categoria-show').val(result.categoria.id);
    $('#nombre-categoria-show').val(result.categoria.nombre);
}

var fabricaContainer = $('#container-fabricante');
var fabricaOldContainerToHide = null;

function addFabrica(result) {
    return '<div class="extra-container-mini" data-id="' + result.fabrica.id + '"> <div class="btn-extra-container"> <div class="btn-group" role="group"> <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-h fa-lg"></i> </button> <ul class="dropdown-menu"> <li><a class="btn-update-fabrica" href="#" data-toggle="modal" data-target="#modalUpdateFabrica">Editar Fabricante</a></li> </ul> </div> </div> <div class="body-extra"> <span>Fabricante</span> <div>'+ result.fabrica.nombre +'</div> </div> </div>';
}

function fillFormFabrica(result) {
    $('#id-fabrica-show').val(result.fabrica.id);
    $('#nombre-fabrica-show').val(result.fabrica.nombre);
}

(function($) {

    var App = {
        init: function () {
            App.GetDataOferta();
            App.CreateOferta();
            App.UpdateOferta();

            App.GetDataCategoria();
            App.CreateCategoria();
            App.UpdateCategoria();

            App.GetDataFabricante();
            App.CreateFabricante();
            App.UpdateFabricante();
        },

        GetDataOferta: function() {

            // Escuchar eventos dentro de ofertaContainer sobre .btn-update-oferta
            ofertaContainer.on("click", '.btn-update-oferta', function() {

                // Obtenerl el elemento padre
                ofertaOldContainerToHide = $(this).parents('div.extra-container-mini');

                // Obtener el data-id del elemento padre y agregarlo al formulario de show oferta para obtener la data
                $('#id-oferta-to-show').val( ofertaOldContainerToHide.data('id') );

                initGetOferta();
            });

            function initGetOferta() {
                var form = $('#form-oferta-to-show');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {

                        $('.core-loader').hide();
                        fillFormOferta(result);

                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        },

        CreateOferta: function () {

            $('#store-new-oferta').click( function() {
                if ( validateGroup(".form-group-validate-oferta") == -1 )
                    initSaveOferta();
            });

            function initSaveOferta() {
                var form = $('#form-oferta-store');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('#msg-vacio').hide();

                        $('.close').click();
                        document.getElementById("form-oferta-store").reset();

                        // Incrementamos en más 1 el contador de oferta
                        $('#lb-count-oferta').html( parseInt($('#lb-count-oferta').html()) + 1 );

                        ofertaContainer.append( addOferta(result) );
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }
        },

        UpdateOferta: function() {
            $('#update-oferta').click( function() {
                if ( validateGroup(".form-group-validate-oferta-update") == -1 )
                    initUpdateOferta();
            });

            function initUpdateOferta() {
                var form = $('#form-oferta-update');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'PUT',
                    dataType:   'json',
                    // async:   false,
                    data:       datos,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('.close').click();
                        document.getElementById("form-oferta-update").reset();

                        ofertaOldContainerToHide.hide();
                        ofertaOldContainerToHide.after( addOferta(result) );
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        },




        GetDataCategoria: function() {

            // Escuchar eventos dentro de categoriaContainer sobre .btn-update-categoria
            categoriaContainer.on("click", '.btn-update-categoria', function() {

                // Obtener el elemento padre
                categoriaOldContainerToHide = $(this).parents('div.extra-container-mini');

                // Obtener el data-id del elemento padre y agregarlo al formulario de show categoria para obtener la data
                $('#id-categoria-to-show').val( categoriaOldContainerToHide.data('id') );

                initGetOferta();
            });

            function initGetOferta() {
                var form = $('#form-categoria-to-show');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {

                        $('.core-loader').hide();
                        fillFormCategoria(result);
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        },

        CreateCategoria: function () {

            $('#store-new-categoria').click( function() {
                if ( validateGroup(".form-group-validate-categoria") == -1 )
                    initSaveCategoria();
            });

            function initSaveCategoria() {
                var form = $('#form-categoria-store');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('#msg-vacio').hide();

                        $('.close').click();
                        document.getElementById("form-categoria-store").reset();

                        // Incrementamos en más 1 el contador de oferta
                        $('#lb-count-categoria').html( parseInt($('#lb-count-categoria').html()) + 1 );

                        categoriaContainer.append( addCategoria(result) );
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }
        },

        UpdateCategoria: function() {
            $('#update-categoria').click( function() {
                if ( validateGroup(".form-group-validate-categoria-update") == -1 )
                    initUpdateCategoria();
            });

            function initUpdateCategoria() {
                var form = $('#form-categoria-update');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'PUT',
                    dataType:   'json',
                    // async:   false,
                    data:       datos,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('.close').click();
                        document.getElementById("form-categoria-update").reset();

                        categoriaOldContainerToHide.hide();
                        categoriaOldContainerToHide.after( addCategoria(result) );
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        },




        GetDataFabricante: function() {

            // Escuchar eventos dentro de categoriaContainer sobre .btn-update-categoria
            fabricaContainer.on("click", '.btn-update-fabrica', function() {

                // Obtener el elemento padre
                fabricaOldContainerToHide = $(this).parents('div.extra-container-mini');

                // Obtener el data-id del elemento padre y agregarlo al formulario de show categoria para obtener la data
                $('#id-fabrica-to-show').val( fabricaOldContainerToHide.data('id') );

                initGetFabricante();
            });

            function initGetFabricante() {
                var form = $('#form-fabrica-to-show');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {

                        $('.core-loader').hide();
                        fillFormFabrica(result);
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        },

        CreateFabricante: function () {

            $('#store-new-fabrica').click( function() {
                if ( validateGroup(".form-group-validate-fabrica") == -1 )
                    initSaveFabricante();
            });

            function initSaveFabricante() {
                var form = $('#form-fabrica-store');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('#msg-vacio').hide();

                        $('.close').click();
                        document.getElementById("form-fabrica-store").reset();

                        // Incrementamos en más 1 el contador de oferta
                        $('#lb-count-fabricante').html( parseInt($('#lb-count-fabricante').html()) + 1 );

                        fabricaContainer.append( addFabrica(result) );
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }
        },

        UpdateFabricante: function() {
            $('#update-fabrica').click( function() {
                if ( validateGroup(".form-group-validate-fabrica-update") == -1 )
                    initUpdateCategoria();
            });

            function initUpdateCategoria() {
                var form = $('#form-fabrica-update');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'PUT',
                    dataType:   'json',
                    // async:   false,
                    data:       datos,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('.close').click();
                        document.getElementById("form-fabrica-update").reset();

                        fabricaOldContainerToHide.hide();
                        fabricaOldContainerToHide.after( addFabrica(result) );
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        }


    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);