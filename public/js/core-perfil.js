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

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {

                        $('.core-loader').hide();
                        console.log(result);

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
