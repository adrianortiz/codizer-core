/**
 * Created by Jonathan Lozano on 19/03/2016.
 */
// Almacena los datos de la fila seleccionada
var tableTrTouched = null;
// Contenedor de la lista de las notas (Izquierdo)
var containerNotes = $('#list-contacts');
// Contenedor del lado derecho
var continaerNoteShow = $('#continaer-note-shows');

var contacts = $('#NContacts');

// Retorna la fila de un contacto creado o actulizado
function noteCreateUpdate(result) {
    return '<tr class="data-contacto-tr" data-contacto="' + result.contacto.id + '">' +
        '<td class="container-list-photo-user">' +
        '<img src="/media/photo-perfil/' + result.contacto.foto + '"></td>' +
        '<td>' +
        '<div class="list-contact-full-name">' + result.contacto.nombre + ' ' + result.contacto.ap_paterno + '</div>' +
        '<span class="list-contact-mail">' + result.contacto.profesion + '</span>' +
        '</td>' +
        '</tr>';
    }


$(document).ready(function(){
    $('#form').hide();
    $('#info-contact').hide();
    $('#btn-edit-contact').hide();
    $('#btn-delete-contact').hide();

    $('#btn-new-contact').click(function(){
        $('#msg-list-vacio').hide();
        $('#form').show();
        $('#btn-new-contact').hide();
    });

    $('#btn-cancel-contact').click(function(){
        $('#msg-list-vacio').show();
        $('#form').hide();
        $('#btn-new-contact').show();
        document.getElementById("form-contact-to-create").reset();
    });

    //$('#btn-save-contact').click(function(){
    //    alert($('#f_nacimiento').val());
    //});

});

(function($){

    var App = { init: function() {
        App.CreateContact();
        App.SelectNote();
        App.UpdateNote();
        App.DeleteNote();
        App.SearchAndListAllNotes();
    },

        /**
         * Crear una nota y agregar la nota creada a la lista de notas (Izquierda)
         * @constructor
         */
        CreateContact: function()
        {
            $('#btn-save-contact').click( function()
            {
                var form = $('#form-contact-to-create');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                url:        route,
                type:       'POST',
                dataType:   'json',
                async:      false,
                data:       datos,

                success: function( result ) {
                    // console.log(result);

                    if (result.message == "No se pudo guardar el contacto.") {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    } else {
                        hideShowAlert('msj-success', result.message);

                        containerNotes.prepend( noteCreateUpdate(result) );
                        document.getElementById("form-contact-to-create").reset();
                        $('#msg-list-vacio').show();
                        $('#form').hide();
                        $('#btn-new-contact').show();
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
                        // console.log(result);
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
                        // console.log(result);
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
                $('.notificacion-text').addClass('in');
            });

            // Ocultar modal global de eliminar
            $('#no').click( function() {
                $('.notificacion-text').removeClass('in');
                $('#modal-delete').fadeOut();
            });

            // Eliminar nota
            $('#si').click( function() {

                $('.notificacion-text').removeClass('in');
                $('#modal-delete').fadeOut();

                var form = $('#form-note-to-delete');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'DELETE',
                    dataType:   'json',
                    // async:      false,
                    data:       datos,

                    success: function( result )
                    {
                        // console.log(result);

                        // Mensaje de alerta
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
        },

        SearchAndListAllNotes: function() {

            // Llama al método buscarUnoTodoNote cuando se teclea en el buscador
            $('#core-search-group input').keyup( function() {
                buscarUnoTodoNote();
            });

            // Llama al método buscarUnoTodoNote cuando se le da click
            // Al estar el campo de busqueda vacio, traera toda la data
            $('#btn-list-all-notes').click( function() {
                $('#core-search-group input').val('');
                buscarUnoTodoNote();
            });

            function buscarUnoTodoNote() {
                var form = $('#form-note-to-search');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       datos + '&content=' + $('#core-search-group input').val(),

                    success: function( result) {

                        containerNotes.empty();
                        var count = 0;
                        $( result['notes']).each( function(key, value) {
                            count++;
                            containerNotes.prepend(
                                '<tr class="data-note-tr" data-note="' + value.id + '">' +
                                '<td class="container-list-point">' +
                                '<div></div><div></div><div></div></td>' +
                                '<td>' +
                                '<div class="list-note-content">' + value.content.substring(0, 40) + '...</div>' +
                                '<span class="list-note-date-update">' + value.updated_at + '</span>' +
                                '</td>' +
                                '</tr>'
                            );
                        });

                        if (count == 0)
                            containerNotes.html('<div id="msg-list-vacio">Ninguna coincidencia.</div>');

                    }
                }).fail( function( result ) {
                    hideShowAlert('msj-danger', 'Ocurrio un problema');
                    console.log( result )
                });

            }
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });
})(jQuery);


