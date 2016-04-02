/**
 * Created by ANGELDAVID on 26/03/2016.
 */
// Almacena los datos de la fila seleccionada
var tableTrTouched = null;
// Contenedor de la lista de las notas (Izquierdo)
var containerProducts = $('#list-products');
// Contenedor del lado derecho
var continaerProductShow = $('#continaer-product-shows');

// Retorna la fila de una notra creada o actulizada
function productCreateUpdate(result) {
    return '<tr class="data-product-tr" data-product="' + result.product.id + '">' +
        '<td class="container-list-point">' +
        '<div></div><div></div><div></div></td>' +
        '<td>' +
        '<div class="list-product-content">' + result.product.content + '</div>' +
        '<span class="list-product-date-update">' + result.product.created_at + '</span>' +
        '</td>' +
        '</tr>';
}

(function($){

    var App = { init: function() {
        App.CreateProduct();
        App.SelectProduct();
        App.UpdateProduct();
        App.DeleteProduct();
        App.SearchAndListAllProducts();
        App.AddInputFileImg();
    },

        AddInputFileImg: function ()
        {
            /*
            var contador = 1;
            $('#btn-add-form-file-img-codizer').click( function() {
                if (contador < 4) {
                    $('.codizer-new-img-product').append('<div class="col-xs-6 col-sm-6 col-md-3"><div class="form-group"><input type="file" accept="image/jpg,image/png" name="img[]" id="img" class="form-control form-with-100"></div></div>');
                    contador++; }

                if ( contador == 4)
                    $('#btn-add-form-file-img-codizer').hide();
            });
            */

            $('#core-file-img-principal').on('change',function (e) {
                $('#core-img-principal').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-2').on('change',function (e) {
                $('#core-img-2').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-3').on('change',function (e) {
                $('#core-img-3').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-4').on('change',function (e) {
                $('#core-img-4').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-5').on('change',function (e) {
                $('#core-img-5').attr('src', URL.createObjectURL(e.target.files[0]));
            });
        },

        /**
         * Crear una nota y agregar la nota creada a la lista de notas (Izquierda)
         * @constructor
         */
        CreateProduct: function()
        {
            $('#store-new-product').click( function() {
                if ( validateGroup('.form-group-validate') == -1 )
                    initSaveProduct();
            });

            function initSaveProduct() {
                var form = $('#form-products-store');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({

                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,

                    data:new FormData( $('#form-products-store')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function( result ) {
                        // console.log(result);

                        $('.core-loader').hide();

                        if ( result.error ) {
                            console.log(result.case);
                            hideShowAlert('msj-danger', result.error);
                        } else {
                            hideShowAlert('msj-success', result.message);
                            $('#msg-list-vacio').hide();
                            containerProducts.prepend( productCreateUpdate(result) );
                            $('.close').click();
                            document.getElementById("form-products-store").reset();
                        }
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('.core-loader').hide();
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }
        },

        /**
         * Seleccionar una nota de la lista de notas y mostrar su
         * infomaci�n en la vista lateral (Derecha)
         * @constructor
         */
        SelectProduct: function()
        {

            $(containerProducts).on("click", "tr", function()
            {
                tableTrTouched = $(this);
                $('.data-product-tr').removeClass('activarFila');
                $(this).addClass('activarFila');

                $('#id-product-to-show').val($(this).attr('data-product'));

                // Enviar id de la nota para eliminar
                $('#id-product-to-delete').val($(this).attr('data-product'));
                $('#btn-group-to-note').show();

                var form = $('#form-product-to-show');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       datos,

                    success: function( result )
                    {
                        // console.log(result);
                        // Agregar datos de la nota consultada al contenedor derecho
                        continaerProductShow.html('<div class="block-content-info">' + result.note[0].content + '</div>');

                        // Agregar datos de la nota seleccionada al formulario de actualizaci�n
                        $('#id-product-to-update').val(result.product[0].id);
                        $('#content-product-to-update').val(result.product[0].content);

                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });

        },

        /**
         * Actualizar una nota de la lista de notas
         * @constructor
         */
        UpdateProduct: function() {
            $('#update-product').click( function() {
                if ( validateGroup(".form-group-validate-update") == -1 )
                    initUpdateProduct();
            });

            function initUpdateProduct() {
                var form = $('#form-product-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,

                    data:new FormData( $('#form-product-update')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('.close').click();
                        document.getElementById("form-product-update").reset();

                        tiendaOldContainerToHide.hide();
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

        /**
         * Eliminar una nota
         * @constructor
         */
        DeleteProduct: function() {

            // Mostrar modal global de eliminar
            $('#btn-delete-product').click( function() {
                $('#modal-delete').fadeIn();
                $('.notificacion-text').addClass('in');
            });

            // Ocultar modal global de eliminar
            $('#no').click( function() {
                $('.notificacion-text').removeClass('in');
                $('#modal-delete').fadeOut();
            });

            // Eliminar nota
            $('#si').click( function() {

                $('.notificacion-text').removeClass('in');
                $('#modal-delete').fadeOut();

                var form = $('#form-product-to-delete');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'DELETE',
                    dataType:   'json',
                    // async:      false,
                    data:       datos,

                    success: function( result )
                    {
                        // console.log(result);

                        // Mensaje de alerta
                        hideShowAlert('msj-success', result.message);

                        // Quitar nota de la vista
                        tableTrTouched.fadeOut();
                        $('#btn-group-to-product').hide();
                        continaerProductShow.html('<div id="msg-vacio">Ningun producto seleccionado.</div>');
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();
                    // Ocultar modal global de eliminar
                    $('#modal-delete').fadeOut();
                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });
        },

        SearchAndListAllProducts: function() {

            // Llama al método buscarUnoTodoNote cuando se teclea en el buscador
            $('#core-search-group input').keyup( function() {
                buscarUnoTodoProduct();
            });

            // Llama al método buscarUnoTodoNote cuando se le da click
            // Al estar el campo de busqueda vacio, traera toda la data
            $('#btn-list-all-products').click( function() {
                $('#core-search-group input').val('');
                buscarUnoTodoProduct();
            });

            function buscarUnoTodoProduct() {
                var form = $('#form-product-to-search');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       datos + '&content=' + $('#core-search-group input').val(),

                    success: function( result) {

                        containerProducts.empty();
                        var count = 0;
                        $( result['notes']).each( function(key, value) {
                            count++;
                            containerProducts.prepend(
                                '<tr class="data-product-tr" data-product="' + value.id + '">' +
                                '<td class="container-list-point">' +
                                '<div></div><div></div><div></div></td>' +
                                '<td>' +
                                '<div class="list-product-content">' + value.content.substring(0, 40) + '...</div>' +
                                '<span class="list-product-date-update">' + value.updated_at + '</span>' +
                                '</td>' +
                                '</tr>'
                            );
                        });

                        if (count == 0)
                            containerProducts.html('<div id="msg-list-vacio">Ninguna coincidencia.</div>');

                    }
                }).fail( function( result ) {
                    hideShowAlert('msj-danger', 'Ocurrio un problema');
                    console.log( result )
                });

            }
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);