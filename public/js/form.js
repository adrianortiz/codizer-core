/**
 * Created by Ortiz on 10/23/15.
 */

$('[data-toggle="tooltip"]').tooltip();

$( "#save-data" ).submit(function( event ) {

    if ( validateGroup(".form-group-validate") == -1 ) {
        // hideShowAlert('msj-success', 'Inicia el guardado');
        return;
    }

    hideShowAlert('msj-danger', 'Revisa los campos marcados en rojo');
    event.preventDefault();
});