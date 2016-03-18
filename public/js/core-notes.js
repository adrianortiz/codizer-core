/**
 * Created by Codizer on 3/11/16.
 */

// Almacena los datos de la fila seleccionada
var tableTrTouched = null;
// Contenedor de la lista de las notas (Izquierdo)
var containerNotes = $('#list-notes');
// Contenedor del lado derecho
var continaerNoteShow = $('#continaer-note-shows');

// Retorna la fila de una notra creada o actulizada
function noteCreateUpdate(result) {
    return '<tr class="data-note-tr" data-note="' + result.note.id + '"><td class="container-list-point"><div></div><div></div><div></div></td><td><div class="list-note-content">' + result.note.content + '</div><span class="list-note-date-update">' + result.note.created_at + '</span></td></tr>';
}

(function($){

    var App = { init: function() {
        App.CreateNote();
        App.SelectNote();
        App.UpdateNote();
        App.DeleteNote();
    },

        /**
         * Crear una nota y agregar la nota creada a la lista de notas (Izquierda)
         * @constructor
         */
        CreateNote: function()
        {
            $('#store-new-note').click( function()
            {
                var form = $('#form-notes-store');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    async:      false,
                    data:       datos,

                    success: function( result ) {
                        console.log(result);

                        if (result.message == "No se pudo crear la nota.") {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);

                            containerNotes.prepend( noteCreateUpdate(result) );
                            $('.close').click();
                            document.getElementById("form-notes-store").reset();
                        }

                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });
        },

        /**
         * Seleccionar una nota de la lista de notas y mostrar su
         * infomación en la vista lateral (Derecha)
         * @constructor
         */
        SelectNote: function()
        {

            $(containerNotes).on("click", "tr", function()
            {
                tableTrTouched = $(this);
                $('.data-note-tr').removeClass('activarFila');
                $(this).addClass('activarFila');

                $('#id-note-to-show').val($(this).attr('data-note'));

                // Enviar id de la nota para eliminar
                $('#id-note-to-delete').val($(this).attr('data-note'));
                $('#btn-group-to-note').show();

                var form = $('#form-note-to-show');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       datos,

                    success: function( result )
                    {
                        console.log(result);
                        // Agregar datos de la nota consultada al contenedor derecho
                        continaerNoteShow.html('<div class="block-content-info">' + result.note[0].content + '</div>');

                        // Agregar datos de la nota seleccionada al formulario de actualización
                        $('#id-note-to-update').val(result.note[0].id);
                        $('#content-note-to-update').val(result.note[0].content);

                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });

        },

        /**
         * Actualizar una nota de la lista de notas
         * @constructor
         */
        UpdateNote: function()
        {
            $('#update-actual-note').click( function()
            {
                var form = $('#form-note-to-update');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'PUT',
                    dataType:   'json',
                    async:      false,
                    data:       datos,

                    success: function( result )
                    {
                        console.log(result);
                        hideShowAlert('msj-success', result.message);
                        containerNotes.prepend( noteCreateUpdate(result) );

                        // Agregar datos de la nota consultada al contenedor derecho
                        continaerNoteShow.html('<div class="block-content-info">' + result.note.content + '</div>');

                        // Agregar datos de la nota seleccionada al formulario de actualización
                        $('#id-note-to-update').val(result.note.id);
                        $('#content-note-to-update').val(result.note.content);

                        // Mostrar mensaje y cerrar modal
                        $('.close').click();

                        // Quitar nota de la vista
                        tableTrTouched.fadeOut();
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function(key,error)
                    {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            });

        },

        /**
         * Eliminar una nota
         * @constructor
         */
        DeleteNote: function() {

            // Mostrar modal global de eliminar
            $('#btn-delete-note').click( function() {
                $('#modal-delete').fadeIn();
            });

            // Ocultar modal global de eliminar
            $('#no').click( function() {
                $('#modal-delete').fadeOut();
            });

            // Eliminar nota
            $('#si').click( function() {
                var form = $('#form-note-to-delete');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'DELETE',
                    dataType:   'json',
                    async:      false,
                    data:       datos,

                    success: function( result )
                    {
                        console.log(result);
                        // Ocultar modal global de eliminar
                        $('#modal-delete').fadeOut();
                        hideShowAlert('msj-success', result.message);
                        // Quitar nota de la vista
                        tableTrTouched.fadeOut();
                        $('#btn-group-to-note').hide();
                        continaerNoteShow.html('<div id="msg-vacio">Ninguna nota seleccionada.</div>');
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();
                    // Ocultar modal global de eliminar
                    $('#modal-delete').fadeOut();
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