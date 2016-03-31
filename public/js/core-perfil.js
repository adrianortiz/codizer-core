/**
 * Created by Codizer on 3/30/16.
 */

(function($) {

    var App = {
        init: function () {
            App.changeFriend();
        },

        changeFriend: function() {
            $('.container-add-friend').on("click", '#btn-add-delete-friend', function() {
                initChangeUserFriend();
            });

            function initChangeUserFriend() {
                var form = $('#form-add-to-friend');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       data,

                    success: function (result) {
                        if ( result.result === 1 ) {
                            $('.container-add-friend').html('<li><a id="btn-add-delete-friend" href="#">Quitar de mis amigo</a></li>');
                            hideShowAlert('msj-success', 'Usuario agregado a tus contactos');
                        } else {
                            $('.container-add-friend').html('<li><a id="btn-add-delete-friend" href="#">Agregar como amigo</a></li>');
                            hideShowAlert('msj-success', 'Usuario eliminado de tus contactos');
                        }
                    }

                }).fail(function (jqXHR, textStatus) {
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
