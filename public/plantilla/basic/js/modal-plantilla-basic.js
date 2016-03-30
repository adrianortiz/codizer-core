/**
 * Created by Codizer on 3/27/16.
 */

//
function fillModalProduct(result)
{
    $('#cantidad').val('1');
    $('#show-info-product-title').text(result.product.nombre);
    $('#show-info-product-code').text(result.product.codigo_producto);
    $('#show-info-product-fabricante').text(result.product.nombre_fabricante);
    $('#show-info-product-precio-descuento').text('$' + result.product.precio + ' ' + result.product.tipo_oferta + ' ' + result.product.regla_porciento + '%');
    $('#show-info-product-final-price').text('$' + result.finalPrice);

    $('#show-info-product-desc').text(result.product.desc_producto);

    $('#show-info-product-categorias').empty();
    if (result.productCategories.length == 0) {
        $('#show-info-product-categorias').append('<span>Sin categorias</span>');
    } else {
        $.each(result.productCategories, function(index, item) {
            $('#show-info-product-categorias').append('<span class="list-product-tags">' + item.nombre + '</span>');
        });
    }

    $('#show-info-product-img').empty();
    $('#show-info-product-img').append('<img id="principal-image-product" src="' + result.url + result.imgsProduct[0].img + '">');
    $.each(result.imgsProduct, function(index, item) {
        $('#show-info-product-img').append('<img class="sub-image-product" src="' + result.url + item.img + '">');
    });
}

(function($) {

    var App = {
        init: function () {
            App.changeImageModal();
            App.GetDataProduct();
        },

        changeImageModal: function() {
            $('#show-info-product-img').on("click", '.sub-image-product', function() {
                $('#principal-image-product').attr('src', $(this).attr('src') );
                $('.sub-image-product').removeClass('principal-image-product');
                $(this).addClass('principal-image-product');
            });
        },

        GetDataProduct: function() {

            // Escuchar eventos dentro de .container-admin-100 sobre .btn-update-company
            $('.container-products').on("click", '.btn-preview-product', function() {

                // Obtenerl el elemento padre div.tienda-container
                tiendaOldContainerToHide = $(this).parents('div.product-container');

                // Obtener el data-id del elemento padre y agregarlo al formulario de show tienda para obtener la data
                $('#id-product-to-show').val( tiendaOldContainerToHide.data('id') );

                initGetTienda();
            });

            function initGetTienda() {
                var form = $('#form-product-to-show');
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
                        fillModalProduct(result);

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


    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);