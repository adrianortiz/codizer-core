/**
 * Created by Jonathan Lozano on 19/03/2016.
 */

var containerContacts = $('#list-contacts');
var tableTrTouched = null;
var continaerContact = $('#info-contact');

var contacto = null;

// Retorna la fila de un contacto creado o actulizado
function contactNewEdit(result) {
    return '<tr class="data-contacto-tr" data-contacto="' + result.contacto.id + '">' +
        '<td class="container-list-photo-user">' +
        '<img src="/media/photo-perfil/' + result.contacto.foto + '"></td>' +
        '<td>' +
        '<div class="list-contact-full-name">' + result.contacto.nombre + ' ' + result.contacto.ap_paterno + '</div>' +
        '<span class="list-contact-mail">' + result.contacto.profesion + '</span>' +
        '</td>' +
        '</tr>';
}

function emptyAndRefillFieldsToUpdate(){
    $('#nombre-ud').empty();
    $('#ap_paterno-ud').empty();
    $('#ap_materno-ud').empty();

    $('input:radio[name=sexo-ud]').filter('[value=Masculino]').prop('checked', true);

    $('#f_nacimiento-ud').empty();
    $('#profesion-ud').empty();
    $('#estado_civil-ud').empty();
    $('#desc_contacto-ud').empty();
    $('#desc_dir-ud').empty();
    $('#calle-ud').empty();
    $('#numero_dir-ud').empty();
    $('#piso_edificio-ud').empty();
    $('#ciudad-ud').empty();
    $('#cp-ud').empty();
    $('#estado_dir-ud').empty();
    $('#pais-ud').empty();
    $('#desc_tel-ud').empty();
    $('#numero_tel-ud').empty();
    $('#desc_mail-ud').empty();
    $('#email-ud').empty();
    $('#red_social_nombre-ud').empty();
    $('#url-ud').empty();

    $('#nombre-ud').val(contacto[0].nombre);
    $('#ap_paterno-ud').val(contacto[0].ap_paterno);
    $('#ap_materno-ud').val(contacto[0].ap_materno);

    $('#show-info-contact-foto').attr('src','/media/photo-perfil/'+ contacto[0].foto);

    $('input:radio[name=sexo-ud]').filter('[value='+contacto[0].sexo+']').prop('checked', true);

    $('#f_nacimiento-ud').val($.formatDate('d/m/Y', contacto[0].f_nacimiento));
    $('#profesion-ud').val(contacto[0].profesion);
    $('#estado_civil-ud').val(contacto[0].estado_civil);
    $('#desc_contacto-ud').val(contacto[0].desc_contacto);
    $('#desc_dir-ud').val(contacto[0].desc_dir);
    $('#calle-ud').val(contacto[0].calle);
    $('#numero_dir-ud').val(contacto[0].numero_dir);
    $('#piso_edificio-ud').val(contacto[0].piso_edificio);
    $('#ciudad-ud').val(contacto[0].ciudad);
    $('#cp-ud').val(contacto[0].cp);
    $('#estado_dir-ud').val(contacto[0].estado_dir);
    $('#pais-ud').val(contacto[0].pais);
    $('#desc_tel-ud').val(contacto[0].desc_tel);
    $('#numero_tel-ud').val(contacto[0].numero_tel);
    $('#desc_mail-ud').val(contacto[0].desc_mail);
    $('#email-ud').val(contacto[0].email);
    $('#red_social_nombre-ud').val(contacto[0].red_social_nombre);
    $('#url-ud').val(contacto[0].url);
}

function emptyAndRefillFieldsToShow(){
    $('#show-info-contact-nombre-completo').empty();
    $('#show-info-contact-sexo').empty();
    $('#show-info-contact-f-nacimiento').empty();
    $('#show-info-contact-profesion').empty();
    $('#show-info-contact-estado-civil').empty();
    $('#show-info-contact-desc-info').empty();
    $('#show-info-contact-desc-dir').empty();
    $('#show-info-contact-calle').empty();
    $('#show-info-contact-num-dir').empty();
    $('#show-info-contact-p-e').empty();
    $('#show-info-contact-cd').empty();
    $('#show-info-contact-cp').empty();
    $('#show-info-contact-edo').empty();
    $('#show-info-contact-pais').empty();
    $('#show-info-contact-desc-tel').empty();
    $('#show-info-contact-num-tel').empty();
    $('#show-info-contact-desc-mail').empty();
    $('#show-info-contact-mail').empty();
    $('#show-info-contact-social').empty();
    $('#show-info-contact-url').empty();

    $('#show-info-contact-nombre-completo').append(contacto[0].nombre + ' ' + contacto[0].ap_paterno + ' ' + contacto[0].ap_materno);
    $('#show-info-contact-foto').attr('src','/media/photo-perfil/'+ contacto[0].foto);
    $('#show-info-contact-sexo').append(contacto[0].sexo);
    $('#show-info-contact-f-nacimiento').append(contacto[0].f_nacimiento);
    $('#show-info-contact-profesion').append(contacto[0].profesion);
    $('#show-info-contact-estado-civil').append(contacto[0].estado_civil);
    $('#show-info-contact-desc-info').append(contacto[0].desc_contacto);
    $('#show-info-contact-desc-dir').append(contacto[0].desc_dir);
    $('#show-info-contact-calle').append(contacto[0].calle);
    $('#show-info-contact-num-dir').append(contacto[0].numero_dir);
    $('#show-info-contact-p-e').append(contacto[0].piso_edificio);
    $('#show-info-contact-cd').append(contacto[0].ciudad);
    $('#show-info-contact-cp').append(contacto[0].cp);
    $('#show-info-contact-edo').append(contacto[0].estado_dir);
    $('#show-info-contact-pais').append(contacto[0].pais);
    $('#show-info-contact-desc-tel').append(contacto[0].desc_tel);
    $('#show-info-contact-num-tel').append(contacto[0].numero_tel);
    $('#show-info-contact-desc-mail').append(contacto[0].desc_mail);
    $('#show-info-contact-mail').append(contacto[0].email);
    $('#show-info-contact-social').append(contacto[0].red_social_nombre);
    $('#show-info-contact-url').append(contacto[0].url);
}

$(document).ready(function(){
    $('#form-register').hide();
    $('#form-edit').hide();
    $('#info-contact').hide();
    $('#btns-group-to-contact').hide();

    $('#btn-new-contact').click(function(){
        $('#msg-list-vacio').hide();
        $('#form-register').show();
        $('#btn-new-contact').hide();
        $('#form-edit').hide();
        $('#info-contact').hide();
        $('#btns-group-to-contact').hide();
    });

    $('#btn-edit-contact').click(function(){
        $('#form-edit').show();
        emptyAndRefillFieldsToUpdate();
        $('#form-register').hide();
        $('#info-contact').hide();
        $('#btn-new-contact').show();
    });

    $('#btn-cancel-contact').click(function(){
        $('#msg-list-vacio').show();
        $('#form-register').hide();
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
        App.SelectContact();
        App.UpdateContact();
    },

        /**
         * Guardar un contacto y agregar en la lista de contactos
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

                        containerContacts.prepend( contactNewEdit(result) );
                        document.getElementById("form-contact-to-create").reset();
                        $('#msg-list-vacio').show();
                        $('#form-register').hide();
                        $('#btn-new-contact').show();
                        $('#list-vacio').remove();
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
         * Seleccionar un cantacto de la lista y mostrar su
         * infomacion
         * @constructor
         */
        SelectContact: function()
        {
            $(containerContacts).on("click", "tr", function()
            {
                tableTrTouched = $(this);
                $('.data-contacto-tr').removeClass('activarFila');
                $(this).addClass('activarFila');

                $('#id-contact-to-show').val($(this).attr('data-contacto'));

                var form = $('#form-contact-show');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'GET',
                    dataType:   'json',
                    data:       datos,

                    success: function( result )
                    {
                        contacto = result.contacto;
                        $('#msg-list-vacio').hide();
                        $('#btns-group-to-contact').show();
                        continaerContact.show();

                        emptyAndRefillFieldsToShow();

                        // Asignar id del contacto seleccionado para eliminar
                        $('#id-contact-to-delete').val($(this).attr('data-contacto'));

                        // Asignar id del contacto seleccionado para actualizar
                        //$('#id-note-to-update').val(result.contacto[0].id);
                        //$('#form-contact-to-update').val(result.contacto[0]);



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
         * Actualizar contacto seleccionado
         * @constructor
         */
        UpdateContact: function()
        {
            $('#btn-update-contact').click( function()
            {
                emptyAndRefillFieldsToUpdate();

                //alert(contacto.id);
                //var form = $('#form-contact-to-update');
                //var datos = form.serializeArray();
                //var route = form.attr('action');
                //
                //$.ajax({
                //    url:        route,
                //    type:       'PUT',
                //    dataType:   'json',
                //    async:      false,
                //    data:       datos,
                //
                //    success: function( result )
                //    {
                //        // console.log(result);
                //        hideShowAlert('msj-success', result.message);
                //        containerNotes.prepend( contactNewEdit(result) );
                //
                //        // Agregar datos de la nota consultada al contenedor derecho
                //        continaerNoteShow.html('<div class="block-content-info">' + result.note.content + '</div>');
                //
                //        // Agregar datos de la nota seleccionada al formulario de actualización
                //        $('#id-note-to-update').val(result.note.id);
                //        $('#content-note-to-update').val(result.note.content);
                //
                //        // Mostrar mensaje y cerrar modal
                //        $('.close').click();
                //
                //        // Quitar nota de la vista
                //        tableTrTouched.fadeOut();
                //    }
                //
                //}).fail(function( jqXHR, textStatus ) {
                //    $('#msj-danger-state').empty();
                //
                //    $(jqXHR).each(function(key,error)
                //    {
                //        hideShowAlert('msj-danger', 'Ocurrio un problema');
                //    });
                //
                //});
            });

        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });
})(jQuery);


