$('#tienda-tag').addClass('companies-tag-selectionated');
var tiendaOldContainerToHide = null;

// Contenedor de tiendas
$containerTienda = $('.container-admin-100');

function addTienda(result) {
    newTienda = '<div class="tienda-container" data-id="' + result.tienda.id + '"> <div class="tienda-color-background"></div> <div class="tienda-img-container"> <img src="' + result.tienda.foto + '"> </div> <div class="tienda-info-container"> <div class="tienda-info-container-nombre"> <span>Tienda</span> <h2>' + result.tienda.nombre + '</h2> </div> <div class="tienda-info-container-desc"> <div class="tienda-option-container"> <div class="btn-group" role="group"> <button type="button" class="btn btn-default btn-sm dropdown-toggle tienda-options-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-h fa-lg"></i> </button> <ul class="dropdown-menu dropdown-menu-right"> <li><a href="#" >Ver tienda</a></li> <li class="divider"></li> <li><a class="btn-update-company" href="#" data-toggle="modal" data-target="#modalUpdateTienda">Editar</a></li> </ul> </div> </div> <span>Descripción</span> <h2>' + result.tienda.desc + '</h2> </div> </div> </div>';
    $containerTienda.append(newTienda);
}

function fillFormTienda(result) {
    $('#id-show').val(result.tienda.id);
    $('#nombre-show').val(result.tienda.nombre);
    $('#desc-show').val(result.tienda.desc);
    $('#store_route-show').val(result.tienda.store_route);
    $('#store_route_platilla-show').val(result.tienda.store_route_platilla);
    $('#estado-show').val(result.tienda.estado);
}

(function($) {

    var App = {
        init: function () {
            App.GetDataTienda();
            App.CreateTienda();
            App.UpdateTienda();
        },

        GetDataTienda: function() {

            // Escuchar eventos dentro de .container-admin-100 sobre .btn-update-company
            $('.container-admin-100').on("click", '.btn-update-company', function() {

                // Obtenerl el elemento padre div.tienda-container
                tiendaOldContainerToHide = $(this).parents('div.tienda-container');

                // Obtener el data-id del elemento padre y agregarlo al formulario de show tienda para obtener la data
                $('#id-tienda-to-show').val( tiendaOldContainerToHide.data('id') );

                initGetTienda();
            });

            function initGetTienda() {
                var form = $('#form-tienda-to-show');
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
                        fillFormTienda(result);

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

        CreateTienda: function () {

            $('#store-new-tienda').click( function() {
                if ( validateGroup(".form-group-validate") == -1 )
                    initSaveCompany();
            });

            function initSaveCompany() {
                var form = $('#form-tienda-store');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,

                    data:new FormData( $('#form-tienda-store')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();

                        console.log(result.tienda);
                        hideShowAlert('msj-success', result.tienda);
                        $('.close').click();
                        document.getElementById("form-tienda-store").reset();

                        addTienda(result);
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

        UpdateTienda: function() {
            $('#update-tienda').click( function() {
                if ( validateGroup(".form-group-validate-update") == -1 )
                    initUpdateTienda();
            });

            function initUpdateTienda() {
                var form = $('#form-tienda-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,

                    data:new FormData( $('#form-tienda-update')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('.close').click();
                        document.getElementById("form-tienda-update").reset();

                        tiendaOldContainerToHide.hide();
                        addTienda(result);
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