/**
 * Created by Codizer on 3/15/16.
 */

(function($) {

    var App = { init: function() {
        App.changePhoto();
        App.changeCover();
    },

        /**
         * Actualizar la photo de perfil de un usuario
         */
        changePhoto: function()
        {
            $('#btn-file-foto-store').change( function(e) {
                e.preventDefault();

                var form = $('#form-foto-to-store');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:      false,
                    data:new FormData($("#form-foto-to-store")[0]),

                    // Para subir archivos via ajax
                    // cache: false,
                    contentType: false,
                    processData: false,

                    // Mientras enviamos el archivo
                    beforeSend: function(){
                        $('#view-subiendo-foto').show();
                    },

                    success: function( result ) {
                        $('#view-subiendo-foto').hide();
                        $('#container-foto-perfil-user img').attr('src', result.cover);
                        $('#img-user-admin').attr('src', result.cover);
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#view-subiendo-foto').hide();
                    $('#msj-danger-state').empty();
                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });

        },

        /**
         * Actualizar la foto de cover de un perfil
         */
        changeCover: function()
        {
            $('#btn-file-cover-store').change( function(e) {
                e.preventDefault();

                var form = $('#form-cover-to-store');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:      false,
                    data:new FormData($("#form-cover-to-store")[0]),

                    // Para subir archivos via ajax
                    // cache: false,
                    contentType: false,
                    processData: false,

                    // Mientras enviamos el archivo
                    beforeSend: function(){
                        $('#view-subiendo-cover').show();
                    },

                    success: function( result ) {
                        $('#view-subiendo-cover').hide();
                        $('#container-img-perfils img').attr('src', result.cover);
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#view-subiendo-cover').hide();
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