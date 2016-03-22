/**
 * Created by Codizer on 3/18/16.
 */

$('#btn-new-company').click();

(function($) {

    var App = {
        init: function () {
            App.CreateCompany();
        },

        CreateCompany: function () {

            $('#store-new-company').click( function() {
                if ( validateGroup(".form-group-validate") == -1 )
                    initSaveCompany();
            });

            function initSaveCompany() {
                var form = $('#form-company-store');
                // var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url: route,
                    type: 'POST',
                    dataType: 'json',
                    // async: false,

                    data:new FormData( $('#form-company-store')[0] ),
                    contentType: false,
                    processData: false,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();

                        hideShowAlert('msj-success', result.message);
                        $('.close').click();
                        document.getElementById("form-company-store").reset();

                        window.location.href = result.url;
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

