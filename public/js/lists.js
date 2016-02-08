/**
 * Created by Ortiz on 10/19/15.
 */


/*
    SHOW/HIDE MODALS INPUTS
 */

function closeModalInputs( nameModal )
{
    $("#"+nameModal).fadeOut();
}

function showModalInputs(nameModal)
{
    $("#"+nameModal).fadeIn();
}


/*
    DELETE DATA LIST WITH AJAX
 */

var objX = null;
var toDeleteX = null;

function eliminarInput(objThis, deleteThis)
{
    $('#modal-delete').fadeIn();
    objX = objThis;
    toDeleteX = deleteThis;
}

$('#si').click(function (e)
{
    e.preventDefault();
    var div = $(objX).parent('td').parent('tr');
    var id = toDeleteX;
    var form = $('#form-delete');
    var url = form.attr('action').replace(':USER_ID', id);
    var data = form.serialize();

    div.fadeOut();

    $('.notificacion-text-fondo').fadeOut();
    $.post(url, data, function (result) {
        div.remove();
        console.log(result.message);
    }).fail(function () {
        console.log('Input no eliminado');
        div.fadeIn();
    });
});

$('#no').click(function (e)
{
    e.preventDefault();
    $('#modal-delete').fadeOut();
});



/*
 UPDATE DATA LIST SINGLE INPUT WITH AJAX
 */

var objY = null;
var toUpdateY = null;

function getVaInput(objThis)
{
    objY = objThis.value;
}

function updateInput(objThis, updateThis)
{

    if ( !(objY === objThis.value) ) {

        if (validateItem(objThis) == -1) {

            $("#contentUpdate").val("" + objThis.value);

            var id = updateThis;
            var form = $('#form-update');
            var url = form.attr('action').replace(':USER_ID', id);
            var data = form.serialize();

            $.post(url, data, function (result) {
                objThis.value = result.content;
                hideShowAlert('msj-success', result.message);

            }).fail(function () {
                hideShowAlert('msj-danger', 'Ocurrio un error');
                objThis.value = objY;

            });

        } else {

            hideShowAlert('msj-danger', 'El formato no es valido<br>Contenido restaurado');
            objThis.value = objY;
            validateItem(objThis);
        }
    }

}



