/**
 * Created by Codizer on 3/18/16.
 */

$('#btn-new-company').click();
$('#company-tag').addClass('companies-tag-selectionated');

function fillFormCompany(result)
{
    $('#nombre').val(result.company.nombre);
    $('#giro_empresa').val(result.company.giro_empresa);
    $('#sector').val(result.company.sector);
    $('#rfc').val(result.company.rfc);
    $('#direccion').val(result.company.direccion);
    $('#tel').val(result.company.tel);
    $('#fax').val(result.company.fax);
    $('#correo').val(result.company.correo);
    $('#pagina_web').val(result.company.pagina_web);
    $('#idioma').val(result.company.idioma);
    $('#pais').val(result.company.pais);
}

function fillShowInfoCompany(result)
{
    $('#show-info-contact-logo').attr('src', result.company.logo);
    $('#show-info-contact-nombre-tag').html(result.company.nombre.substring(0, 6) + '...');
    $('#show-info-contact-nombre').html(result.company.nombre);
    $('#show-info-contact-giro-empresa').html(result.company.giro_empresa);
    $('#show-info-contact-sector').html(result.company.sector);
    $('#show-info-contact-rfc').html(result.company.rfc);
    $('#show-info-contact-direccion').html(result.company.direccion);
    $('#show-info-contact-tel').html(result.company.tel);
    $('#show-info-contact-fax').html(result.company.fax);
    $('#show-info-contact-correo').html(result.company.correo);
    $('#show-info-contact-pagina-web').html(result.company.pagina_web);
    $('#show-info-contact-idioma').html(result.company.idioma);
    $('#show-info-contact-pais').html(result.company.pais);
}

(function($) {

    var App = {
        init: function () {
            App.GetDataCompany();
            App.CreateCompany();
            App.UpdateCompany();
        },

        GetDataCompany: function() {

            $('#btn-update-company').click( function() {
                var form = $('#form-company-to-show');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       datos,
                    // async:   false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        fillFormCompany(result);
                        $('.core-loader').hide();

                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });
        },

        CreateCompany: function () {

            $('#store-new-company').click( function() {
                if ( validateGroup(".form-group-validate") == -1 )
                    initSaveCompany();
            });

            function initSaveCompany() {
                var form = $('#form-company-store');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,

                    data:new FormData( $('#form-company-store')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {

                        $('.core-loader').hide();

                        if( result.error ) {
                            hideShowAlert('msj-danger', result.error);
                            console.log(result.errore);

                        } else {
                            hideShowAlert('msj-success', result.message);
                            $('.close').click();
                            document.getElementById("form-company-store").reset();
                            window.location.href = result.url;

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

        UpdateCompany: function () {

            $('#update-company').click( function() {
                if ( validateGroup(".form-group-validate") == -1 )
                    initUpdateCompany();
            });

            function initUpdateCompany() {
                var form = $('#form-company-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,

                    data:new FormData( $('#form-company-update')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();
                        $('.close').click();
                        console.log(result);
                        document.getElementById("form-company-update").reset();
                        fillShowInfoCompany(result);
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

