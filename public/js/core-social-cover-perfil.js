/**
 * Created by Codizer on 3/15/16.
 */

(function($) {

    var App = { init: function() {
        App.changeCover();
    },

        changeCover: function()
        {
            /*
            $('#container-img-perfils').click( function() {
                $('#container-img-perfils img').attr('src', 'hola.png');
            });
            */

            $('#form-cover-to-store').on("submit", function() {
                e.preventDefault();
                var form = $('#form-cover-to-store');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                   // dataType:   'json',
                   //  async:      false,
                    data:       datos,

                    //necesario para subir archivos via ajax
                    cache: false,
                    contentType: false,
                    processData: false,

                    /*
                    //mientras enviamos el archivo
                    beforeSend: function(){
                        console.log('Enviado mensaje');
                    },
                    */

                    success: function( result ) {
                        console.log(result);
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });

        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });
})(jQuery);