/**
 * Created by ANGELDAVID on 26/03/2016.
 */
// Almacena los datos de la fila seleccionada
var tableTrTouched = null;
// Contenedor de la lista de las notas (Izquierdo)
var containerProducts = $('#list-products');
// Contenedor del lado derecho
var continaerProductShow = $('#continaer-product-shows');
function limpiarInputfile() {
    $('#core-img-principal').attr('src','/media/icon/upload-img-icon.png');
    $('#core-img-2').attr('src','/media/icon/upload-img-icon.png');
    $('#core-img-3').attr('src','/media/icon/upload-img-icon.png');
    $('#core-img-4').attr('src','/media/icon/upload-img-icon.png');
}


function fillModalProduct(result) {
    $('#show-info-product-title').text(result.product.nombre);
    $('#show-info-product-codigo').text(result.product.codigo_producto);
    $('#show-info-product-price').text('$'+result.product.precio);
    $('#show-info-product-cantidad').text(result.product.cantidad_disponible);
    $('#show-info-product-final-price').text('$' + result.finalPrice);
    $('#show-info-product-fabricante').text(result.product.nombre_fabricante);
    $('#show-info-product-desc').html(result.product.desc_producto);


    $('#show-info-product-categorias').empty();
    $.each(result.productCategories, function (index, item) {
        $('#show-info-product-categorias').append('<span class="list-product-tags">' + item.nombre + '</span>');
    });


    $('#show-info-product-imgs').empty();
    $('#show-info-product-imgs').append('<img id="principal-image-product" src="' + result.url + result.imgsProduct[0].img + '">');
    $.each(result.imgsProduct, function (index, item) {
        $('#show-info-product-imgs').append('<img class="sub-image-product" src="' + result.url + item.img + '">');
    });
}


// Retorna la fila de un producto creado o actulizada
function productCreateUpdate(result) {
    console.log(result.product);

    var idEmpresa = $('#empresa_id_new').val();
    var idTienda = $('#tienda_id_new').val();
    document.getElementById("form-products-store").reset();
    limpiarInputfile();

    $('#empresa_id_new').val( idEmpresa );
    $('#tienda_id_new').val( idTienda);


    var idEmpresaUp = $('#empresa_id_up').val();
    var idTiendaUp = $('#tienda_id_up').val();
    document.getElementById("form-products-store-update").reset();
    $('#empresa_id_up').val( idEmpresaUp );
    $('#tienda_id_up').val( idTiendaUp);

    return '<tr class="data-product-tr" data-product="' + result.producto.product_id + '">' +
        '<td class="container-list-photo-user">' +
        '<img src="' + result.producto.img + '"></td>' +
        '<td>' +
        '<div class="list-product-title">' + result.producto.nombre + ' ' + '</div>' +
        '<span class="list-product-tags">'+'Oferta:' + result.producto.tipo_oferta + result.producto.regla_porciento + '%' + '</span>' + '<br/>' +
        '<div class="list-product-pz">' + result.producto.cantidad_disponible + 'pz' + '</div>' +
        '<div class="list-product-price">' + '$' + result.producto.precio + '</div>' +
        '</td>' +
        '</tr>';

}

(function($){

    var App;
    App = {
        init: function () {
            App.CreateProduct();
            App.SelectProduct();
            App.UpdateProduct();
            App.SearchAndListAllProducts();
            App.AddInputFileImg();
            App.changeImageModal();
            App.initEditor();
        },

        initEditor: function () {

            /*
             // Get data
             // tinymce.get('desc_producto').getContent()

             tinymce.init({
             selector: 'textarea#desc_producto',
             height: 500,
             plugins: [
             'advlist autolink lists link image charmap print preview anchor',
             'searchreplace visualblocks code fullscreen',
             'insertdatetime media table contextmenu paste code'
             ],
             toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent' // | link image'
             content_css: [
             '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
             '//www.tinymce.com/css/codepen.min.css'
             ]
             });
             */

            tinymce.init({
                selector: 'textarea#desc_producto',
                height: 600,
            });

            tinymce.init({
                selector: 'textarea#desc_producto-up',
                height: 600,
            });


        },

        changeImageModal: function () {

            $('#show-info-product-imgs').on("click", '.sub-image-product', function () {
                $('#principal-image-product').attr('src', $(this).attr('src'));
                $('.sub-image-product').removeClass('principal-image-product');
                $(this).addClass('principal-image-product');
            });

        },

        AddInputFileImg: function () {
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

            $('#core-file-img-principal').on('change', function (e) {
                $('#core-img-principal').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-2').on('change', function (e) {
                $('#core-img-2').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-3').on('change', function (e) {
                $('#core-img-3').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-4').on('change', function (e) {
                $('#core-img-4').attr('src', URL.createObjectURL(e.target.files[0]));
            });

            $('#core-file-img-5').on('change', function (e) {
                $('#core-img-5').attr('src', URL.createObjectURL(e.target.files[0]));
            });
        },

        /**
         * Crear una nota y agregar la nota creada a la lista de notas (Izquierda)
         * @constructor
         */
        CreateProduct: function () {
            $('#store-new-product').click(function () {

                // Agregar irformación del sourceCode del editor al textarea de desc
                $('textarea#desc_producto').val(tinymce.get('desc_producto').getContent());

                if (validateGroup('.form-group-validate') == -1) {
                    initSaveProduct();
                }
            });

            function initSaveProduct() {
                var form = $('#form-products-store');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({

                    url: route,
                    type: 'POST',
                    dataType: 'json',
                    // async:   false,

                    data: new FormData($('#form-products-store')[0]),
                    contentType: false,
                    processData: false,

                    beforeSend: function () {
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        // console.log(result);

                        $('.core-loader').hide();

                        if (result.error) {
                            console.log(result);
                            hideShowAlert('msj-danger', result.error);
                        } else {
                            hideShowAlert('msj-success', result.message);
                            $('#msg-list-vacio').hide();
                            containerProducts.prepend(productCreateUpdate(result));
                            limpiarInputfile();
                            $('#cancel').click();

                        }
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
         * Seleccionar una nota de la lista de notas y mostrar su
         * infomación en la vista lateral (Derecha)
         * @constructor
         */
        SelectProduct: function () {

            $(containerProducts).on("click", "tr", function () {
                tableTrTouched = $(this);
                console.log(tableTrTouched.attr('data-product'));
                $('#id-product-to-show').val(tableTrTouched.attr('data-product'));

                initGetProduct();
            });


            function initGetProduct() {
                var form = $('#form-products-to-show');
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

                        // console.log(result);
                        $('.core-loader').fadeOut();
                        fillModalProduct(result);
                        $('#continaer-product-shows').show();
                        $('#btn-edit-product').show();

                       $('#ver-product-store').show();
                       $('#ver-product-store').attr("href",
                          //'//localhost:8000/tienda/' + result.tiendaGetName.store_route + '/producto/' + result.product.product_id + '/' + result.product.slug
                           result.urlVerEnStore
                       );

                        $('#core-img-principal-up').attr('src', result.url + result.product.img);
                        $('#photo_id_up-1').val(result.imgsProduct[0].id);
                        $('#producto_id_up').val(result.product.id);
                        $('#nombre-up').val(result.product.nombre);
                        $('#codigo_producto-up').val(result.product.codigo_producto);
                        $('#cantidad_disponible-up').val(result.product.cantidad_disponible);
                        $('#precio-up').val(result.product.precio);
                        $('#estado-up').val(result.product.estado);
                        $('#oferta_id-up').val(result.product.oferta_id);
                        $('#fabricante_id-up').val(result.product.fabricante_id);
                        $('textarea#desc_producto-up').val(tinymce.get('desc_producto-up').setContent(result.product.desc_producto));

                        //console.log(result.productCategories[0]);
                        $.each(result.productCategories, function (index, item) {
                            console.log(index);
                            $('#'+item.categoria_id).attr('checked','checked');
                        });


                        var controlImg = 2;

                        $.each(result.imgsProduct, function(index, imgItem) {
                            console.log(index);
                            if (index > 0 ) {
                                $('#photo_id_up-' + controlImg).val(result.imgsProduct[index].id);
                                $('#core-img-'+controlImg+'-up').attr('src', result.url + result.imgsProduct[index].img);
                                controlImg = controlImg + 1;
                            }
                        });
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
         * Actualizar una nota de la lista de notas
         * @constructor
         */
        UpdateProduct: function () {
            $('#btn-update-product').click(function () {

                // Agregar irformación del sourceCode del editor al textarea de desc
                $('textarea#desc_producto-up').val(tinymce.get('desc_producto-up').getContent());

                if (validateGroup('.form-group-validate-up') == -1) {
                    initUpdateProduct();
                }
            });

            function initUpdateProduct() {
                var form = $('#form-products-store-update');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({

                    url: route,
                    type: 'POST',
                    dataType: 'json',
                    // async:   false,

                    data: new FormData($('#form-products-store-update')[0]),
                    contentType: false,
                    processData: false,

                    beforeSend: function () {
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        // console.log(result);

                        $('.core-loader').hide();

                        if (result.error) {
                            console.log(result);
                            hideShowAlert('msj-danger', result.error);
                        } else {
                            hideShowAlert('msj-success', result.message);
                            $('#msg-list-vacio').hide();
                            //containerProducts.prepend(productCreateUpdate(result));
                            window.location.reload(true);
                            $('#cancel').click();

                        }
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


        SearchAndListAllProducts: function () {

            // Llama al método buscarUnoTodoNote cuando se teclea en el buscador
            $('#core-search-group input').keyup(function () {
                buscarUnoTodoProduct();
            });

            // Llama al método buscarUnoTodoNote cuando se le da click
            // Al estar el campo de busqueda vacio, traera toda la data
            $('#btn-list-all-products').click(function () {
                $('#core-search-group input').val('');
                buscarUnoTodoProduct();
            });

            function buscarUnoTodoProduct() {
                var form = $('#form-product-to-search');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'json',
                    data: datos + '&content=' + $('#core-search-group input').val(),

                    success: function (result) {

                        containerProducts.empty();
                        var count = 0;
                        $(result['notes']).each(function (key, value) {
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
                }).fail(function (result) {
                    hideShowAlert('msj-danger', 'Ocurrio un problema');
                    console.log(result)
                });

            }
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);
