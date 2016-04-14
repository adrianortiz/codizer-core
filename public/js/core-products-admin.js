/**
 * Created by Codizer on 11/04/16.
 */
$('#productos-tag').addClass('companies-tag-selectionated');

function addAllItemToList(result, url) {
    return '<tr class="data-product-tr" data-product="' + result.product_id + '">' +
        '<td class="container-list-photo-user">' +
        '<img src="' + url + result.img + '"></td>' +
        '<td>' +
        '<div class="list-product-title">' + result.nombre + ' ' + '</div>' +
        '<span class="list-product-tags">' + result.tipo_oferta + result.regla_porciento + '%' + '</span>' + '<br/>' +
        '<div class="list-product-pz">' + result.cantidad_disponible + 'pz' + '</div>' +
        '<div class="list-product-price">' + '$' + result.precio + '</div>' +
        '</td>' +
        '</tr>';
}

(function($){

    var App;
    App = {
        init: function () {
            App.LoadProdctsFromStore();
        },

        LoadProdctsFromStore: function() {

            $('#btn-select-tienda').change(function () {
                initGetProductsByStore();
            });

            function initGetProductsByStore() {
                var form = $('#form-products-to-show-by-store');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'json',
                    data: data,

                    beforeSend: function () {
                        $('.core-loader').fadeIn()
                    },

                    success: function (result) {

                        $('.core-loader').fadeOut();

                        // Ocular desc y buttons
                        $('#continaer-product-shows').hide();
                        $('#btn-edit-product').hide();
                        $('#ver-product-store').hide();

                        // Limpiar listado de productos
                        $('#list-products').empty();
                        $(result['products']).each(function (key, item) {
                            $('#list-products').prepend(addAllItemToList(item, result.url));
                        });

                        // Asignar los ID
                        $('#empresa_id_new').val(result.idEmpresa);
                        $('#tienda_id_new').val(result.idTienda);

                        // Asignar los ID
                        $('#empresa_id_up').val(result.idEmpresa);
                        $('#tienda_id_up').val(result.idTienda);

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
