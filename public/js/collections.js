/**
 * Created by Ortiz on 10/17/15.
 */

$(document).ready(function () {



    /*
        DELETE A COLLECTION
     */
    var objX = null;
    $('.btn-eliminar').click(function (e) {
        e.preventDefault();
        $('.notificacion-text-fondo').fadeIn();
        objX = this;
    });

    $('#si').click(function (e) {

        e.preventDefault();
        var div = $(objX).parent('li').parent('ul').parent('div').parent('div');
        var id = div.data('id');
        var form = $('#form-delete');
        var url = form.attr('action').replace(':USER_ID', id);
        var data = form.serialize();

        div.fadeOut();
        $('.notificacion-text-fondo').fadeOut();
        $.post(url, data, function (result) {
            div.remove();
            console.log(result.message);
        }).fail(function () {
            console.log('La colección no fue eliminada');
            div.fadeIn();
        });
    });

    $('#no').click(function (e) {
        e.preventDefault();
        $('.notificacion-text-fondo').fadeOut();
    });


});