/**
 * Created by ANGELDAVID on 26/03/2016.
 */
// Método de guardar producto
function initSaveProducto() {

    {
        $('#store-new-product').click( function()
        {
            var form = $('#form-products-store');
            var datos = form.serializeArray();
            var route = form.attr('action');

            $.ajax({
                url:        route,
                type:       'POST',
                dataType:   'json',
                async:      false,
                data:       datos,

                success: function( result ) {
                    alert(result)
                    // console.log(result);

                    if (result.message == "No se pudo guardar el producto.") {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    } else {
                        hideShowAlert('msj-success', result.message);

                        containerProducts.prepend( contactNewEdit(result) );
                        document.getElementById("form-products-store").reset();
                        $('#msg-list-vacio').show();
                        $('#form-register').hide();
                        $('#store-new-product').show();
                        $('#list-vacio').remove();
                    }
                }

            }).fail(function( jqXHR, textStatus ) {
                $('#msj-danger-state').empty();

                $(jqXHR).each(function(key,error)
                {
                    hideShowAlert('msj-danger', 'Ocurrio un problema');
                });

            });
        });
    }}

