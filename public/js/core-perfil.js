/**
 * Created by Codizer on 3/30/16.
 */

(function($) {

    var App = {
        init: function () {
            App.changeFriend();
            App.changeFollower();
        },

        changeFriend: function() {
            $('.container-add-friend').on("click", '#btn-add-delete-friend', function(event) {
                event.preventDefault();
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

        },

        changeFollower: function() {
            $('#options-menu-seguir').on("click", 'a', function(event) {
                event.preventDefault();
                initChangeUserFollower();
            });

            function initChangeUserFollower() {
                var form = $('#form-add-to-fallower');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       data,

                    success: function (result) {
                        if ( result.result === 1 ) {
                            $('#options-menu-seguir').html('<a href="#" class="btn" role="button" title="Dejar de seguir">- Seguir</a>');
                            hideShowAlert('msj-success', 'Usuario agregado a tus followers');
                        } else {
                            $('#options-menu-seguir').html('<a href="#" class="btn" role="button" title="Comenzar a seguir">+ Seguir</a>');
                            hideShowAlert('msj-success', 'Usuario eliminado de tus followers');
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
