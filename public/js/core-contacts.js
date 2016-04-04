/**
 * Created by Jonathan Lozano on 19/03/2016.
 */

var containerContacts = $('#list-contacts');
var tableTrTouched = null;
var continaerContact = $('#info-contact');
//var contacto = null;


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

/**
 * Llena el formulario para actualizar informacion del contacto
 * @param contacto
 * Recibe el objeto con la informacion del contacto
 */
function emptyAndRefillFieldsToUpdate(contacto) {
    // Info contacto
    $('#id-contact-to-update').empty();
    $('#nombre-ud').empty();
    $('#ap_paterno-ud').empty();
    $('#ap_materno-ud').empty();
    $('#sexo-ud').val('Masculino').attr('selected', 'selected');
    $('#f_nacimiento-ud').empty();
    $('#profesion-ud').empty();
    $('#estado_civil-ud').val('Soltero').attr('selected', 'selected');
    $('#desc_contacto-ud').empty();

    $('#id-contact-to-update').val(contacto.id);
    $('#nombre-ud').val(contacto.nombre);
    $('#ap_paterno-ud').val(contacto.ap_paterno);
    $('#ap_materno-ud').val(contacto.ap_materno);

    $('#show-info-contact-foto-ud').attr('src', '/media/photo-perfil/' + contacto.foto);
    $('#sexo-ud').val(contacto.sexo).attr('selected', 'selected');

    var fecha = new Date(contacto.f_nacimiento);
    $('#f_nacimiento-ud').val(fecha.toISOString().slice(0,10));
    $('#profesion-ud').val(contacto.profesion);
    $('#estado_civil-ud').val(contacto.estado_civil).attr('selected', 'selected');
    $('#desc_contacto-ud').val(contacto.desc_contacto);
}

$('#foto-ud').change(function (e) {
    $('#show-info-contact-foto-ud').attr('src', URL.createObjectURL(e.target.files[0]));
});

function emptyAndRefillPhoneFieldsToUpdate(phone) {
    $('#core-content-form-phone').empty();
    $.each(phone, function (index, item) {
        $('#core-content-form-phone').append(
            '<label for="desc_tel">Descripción</label><input class="form-control" name="desc_tel[]" type="text" value="' + item.desc_tel + '">' +
            '<label for="numero_tel">Número</label><input class="form-control" name="numero_tel[]" type="text" value="' + item.numero_tel + '">' +
            '<hr/>'
        );
    });
}

function emptyAndRefillAddressFieldsToUpdate(address) {
    $('#core-content-form-address').empty();
    $.each(address, function (index, item) {
        $('#core-content-form-address').append(
            '<label for="desc_dir">Descripción</label><input class="form-control" name="desc_dir[]" type="text" value="' + item.desc_dir + '">' +
            '<label for="calle">Calle</label><input class="form-control" name="calle[]" type="text" value="' + item.calle + '">' +
            '<label for="numero_dir">Número</label><input class="form-control" name="numero_dir[]" type="text" value="' + item.numero_dir + '">' +
            '<label for="piso_edificio">Piso/Edificio</label><input class="form-control" name="piso_edificio[]" type="text" value="' + item.piso_edificio + '">' +
            '<label for="ciudad">Ciudad</label><input class="form-control" name="ciudad[]" type="text" value="' + item.ciudad + '">' +
            '<label for="cp">Código Postal</label><input class="form-control" name="cp[]" type="text" value="' + item.cp + '">' +
            '<label for="estado_dir">Estado</label><input class="form-control" name="estado_dir[]" type="text" value="' + item.estado_dir + '">' +
            '<label for="pais">País</label><input class="form-control" name="pais[]" type="text" value="' + item.pais + '">' +
            '<hr/>'
        );
    });
}

function emptyAndRefillMailFieldsToUpdate(mail) {
    $('#core-content-form-mail').empty();
    $.each(mail, function (index, item) {
        $('#core-content-form-mail').append(
            '<label for="desc_mail">Descripción</label><input class="form-control" name="desc_mail[]" type="text" value="' + item.desc_mail + '">' +
            '<label for="email">Correo</label><input class="form-control" name="email[]" type="text" value="' + item.email + '">' +
            '<hr/>'
        );
    });
}

function emptyAndRefillSocialFieldsToUpdate(social) {
    $('#core-content-form-social').empty();
    $.each(social, function (index, item) {
        $('#core-content-form-social').append(
            '<label for="red_social_nombre">Descripción</label><select id="r-s-n' + index +'" class="form-control" name="red_social_nombre[]"><option value="Facebook">Facebook</option><option value="Twitter">Twitter</option><option value="Linkedin">Linkedin</option><option value="Google+">Google+</option><option value="Instagram">Instagram</option></select>'+
            '<label for="email">Correo</label><input class="form-control" name="email[]" type="text" value="' + item.url + '">' +
            '<hr/>'
        );
        $('#r-s-n'+ index).val(item.red_social_nombre).attr('selected', 'selected');
    });
}

/**
 * Vacea y rellena la vista del lado derecho que mostrar informacion de contacto
 * @param result
 */
function emptyAndRefillFieldsToShow(result){
    $('#show-info-contact-nombre-completo').empty();
    $('#show-info-contact-sexo').empty();
    $('#show-info-contact-f-nacimiento').empty();
    $('#show-info-contact-profesion').empty();
    $('#show-info-contact-estado-civil').empty();
    $('#show-contact-desc-info').empty();

    $('#show-info-contact-desc-dir').empty();
    $('#show-info-contact-calle').empty();
    $('#show-info-contact-num-dir').empty();
    $('#show-info-contact-p-e').empty();
    $('#show-info-contact-cd').empty();
    $('#show-info-contact-cp').empty();
    $('#show-info-contact-edo').empty();
    $('#show-info-contact-pais').empty();

    $('#show-info-contact-nombre-completo').append(result.contacto[0].nombre + ' ' + result.contacto[0].ap_paterno + ' ' + result.contacto[0].ap_materno);
    $('#show-info-contact-foto').attr('src','/media/photo-perfil/'+ result.contacto[0].foto);
    $('#show-info-contact-sexo').append(result.contacto[0].sexo);
    $('#show-info-contact-f-nacimiento').append(result.contacto[0].f_nacimiento);
    $('#show-info-contact-profesion').append(result.contacto[0].profesion);
    $('#show-info-contact-estado-civil').append(result.contacto[0].estado_civil);
    $('#show-contact-desc-info').append(result.contacto[0].desc_contacto);

    $('#core-content-address').empty();
    $.each(result.address, function (index, item) {
        $('#core-content-address').append(
            '<div class="core-show-title-blue">Dirección '+ item.desc_dir +'</div>' +
            '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-dir">' + item.desc_dir + '</div></div>' +
            '<div><div>Calle</div><div class="show-info-contact" id="show-info-contact-calle">' + item.calle + '</div></div>' +
            '<div><div>Número</div><div class="show-info-contact" id="show-info-contact-num-dir">' + item.numero_dir + '</div></div>' +
            '<div><div>Piso/Edificio</div><div class="show-info-contact" id="show-info-contact-p-e">' + item.piso_edificio + '</div></div>' +
            '<div><div>Ciudad</div><div class="show-info-contact" id="show-info-contact-cd">' + item.ciudad + '</div></div>' +
            '<div><div>Código Postal</div><div class="show-info-contact" id="show-info-contact-cp">' + item.cp + '</div></div>' +
            '<div><div>Estado</div><div class="show-info-contact" id="show-info-contact-edo">' + item.estado_dir + '</div></div>' +
            '<div><div>País</div><div class="show-info-contact" id="show-info-contact-pais">' + item.pais + '</div></div>'
        );
    });

    $('#core-content-phone').empty();
    $.each(result.phone, function (index, item) {
        if (item.desc_tel == "" && item.numero_tel == "") {
            $('#core-content-phone').append(
                '<div class="core-show-title-blue">Teléfono</div>' +
                '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-tel">Aun no has añadido ninguna descripción</div></div>' +
                '<div><div>Número</div><div class="show-info-contact" id="show-info-contact-num-tel">Aun no has añadido ningun teléfono</div></div>'
            );
        } else {
            $('#core-content-phone').append(
                '<div class="core-show-title-blue">Teléfono ' + item.desc_tel + '</div>' +
                '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-tel">' + item.desc_tel + '</div></div>' +
                '<div><div>Número</div><div class="show-info-contact" id="show-info-contact-num-tel">' + item.numero_tel + '</div></div>'
            );
        }
    });

    $('#core-content-mail').empty();
    $.each(result.mail, function (index, item) {
        if (item.desc_mail == "" && item.email == "") {
            $('#core-content-mail').append(
                '<div class="core-show-title-blue">Correo</div>' +
                '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-mail">Aun no has añadido ninguna descripcion</div></div>' +
                '<div><div>Correo</div><div class="show-info-contact" id="show-info-contact-mail">Aun no has añadido ningun correo</div></div>'
            );
        } else {
            $('#core-content-mail').append(
                '<div class="core-show-title-blue">Correo ' + item.desc_mail + '</div>' +
                '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-mail">' + item.desc_mail + '</div></div>' +
                '<div><div>Correo</div><div class="show-info-contact" id="show-info-contact-mail">' + item.email + '</div></div>'
            );
        }
    });

    $('#core-content-social').empty();
    $.each(result.social, function (index, item) {
        if (item.red_social_nombre == "" && item.url == "") {
            $('#core-content-social').append(
                '<div class="core-show-title-blue">Redes sociales</div>' +
                '<div><div>Red social</div><div class="show-info-contact" id="show-info-contact-social">Aun no has añadido ninguna red social</div></div>' +
                '<div><div>URL</div><div class="show-info-contact" id="show-info-contact-url">Aun no has añadido ninguna url</div></div>'
            );
        } else {
            $('#core-content-social').append(
                '<div class="core-show-title-blue">Red social ' + item.red_social_nombre + '</div>' +
                '<div><div>Red social</div><div class="show-info-contact" id="show-info-contact-social">' + item.red_social_nombre + '</div></div>' +
                '<div><div>URL</div><div class="show-info-contact" id="show-info-contact-url">' + item.url + '</div></div>'
            );
        }
    });
}

/**
 * Oculta, vacea y recetea los elementos no necesarios
 */
function hideElements(){
    $('#form-register').hide();
    $('#form-edit').hide();
    $('#info-contact').hide();
    $('#btn-edit-contact').show();
    $('#btns-group-to-contact').hide();
    document.getElementById("form-contact-to-create").reset();
    document.getElementById("form-contact-to-update").reset();
    $('.codizer-new-social-network').empty();
    $('.codizer-new-mail').empty();
    $('.codizer-new-phone').empty();
    $('.codizer-new-address').empty();
    $(".codizer-new-addresa").empty();
    $('#btn-new-contact').show();
}

$(document).ready(function() {

    $('#btn-new-contact').click(function(){
        hideElements();
        $('#form-register').show();
        $('#msg-list-vacio').hide();
        $('#btn-new-contact').hide();
    });

    $('#btn-cancel-contact').click(function(){
        hideElements();
        $('#msg-list-vacio').show();
    });

    $('#btn-cancel-update').click(function (){
        hideElements();
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });

    $('#btn-cancel-address').click(function () {
        hideElements();
        $('#core-content-form-address').empty();
        $('#address-edit').hide();
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });

    $('#btn-cancel-phone').click(function () {
        hideElements();
        $('#core-content-form-phone').empty();
        $('#phone-edit').hide();
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });
});


(function($){

    var App = { init: function() {
        App.CreateContact();
        App.SelectContact();
        App.UpdateContact();
        App.AddNewSocial();
        App.AddNewMail();
        App.AddNewPhone();
        App.AddNewAddress();
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
                var route = form.attr('action');

                $.ajax({
                url:        route,
                type:       'POST',
                dataType:   'json',

                data:new FormData( $('#form-contact-to-create')[0] ),
                contentType: false,
                processData: false,

                success: function( result ) {
                    // console.log(result);

                    if (result.error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    } else {
                        hideShowAlert('msj-success', result.message);

                        containerContacts.prepend( contactNewEdit(result) );
                        $('#msg-list-vacio').show();
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
                        //contacto = result.contacto[0];
                        $('#msg-list-vacio').hide();

                        hideElements();

                        $('#btns-group-to-contact').show();
                        continaerContact.show();

                        emptyAndRefillFieldsToShow(result);

                        // Asignar id del contacto seleccionado para eliminar
                        $('#id-contact-to-delete').val($(this).attr('data-contacto'));

                        /**
                         * Evento que se lanza al editar informacion de contacto
                         */
                        $('#btn-edit-contact').click(function(){
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#btn-edit-contact').hide();
                            $('#form-edit').show();
                            emptyAndRefillFieldsToUpdate(result.contacto[0]);
                        });

                        /**
                         * Evento que se lanaza al editar direccion(es) de contacto
                         */
                        $('#btn-update-address').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#btn-edit-contact').hide();
                            $('#address-edit').show();
                            emptyAndRefillAddressFieldsToUpdate(result.address);
                        });

                        /**
                         * Evento que se lanza al editar telefono(s) de contacto
                         */
                        $('#btn-update-phone').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#btn-edit-contact').hide();
                            $('#phone-edit').show();
                            emptyAndRefillPhoneFieldsToUpdate(result.phone);
                        });

                        $('#btn-update-mail').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#btn-edit-contact').hide();
                            $('#mail-edit').show();
                            emptyAndRefillMailFieldsToUpdate(result.mail);
                        });

                        $('#btn-update-social').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#btn-edit-contact').hide();
                            $('#social-edit').show();
                            emptyAndRefillSocialFieldsToUpdate(result.social);
                        });

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
             * Añade mas componentes en la seccion de redes sociales
             * @constructor
             */
            AddNewSocial: function()
            {
                var control = 2;
                $('#btn-add-new-social').click(function(){
                    if(control <= 10) {
                        $('.codizer-new-social-network').append('<hr/><label for="red_social_nombre">Red social</label>' +
                            '<select name="red_social_nombre[]" class="form-control">' +
                            '<option value="Facebook">Facebook</option>' +
                            '<option value="Twitter">Twitter</option>' +
                            '<option value="Linkedin">Linkedin</option>' +
                            '<option value="Google+">Google+</option>' +
                            '<option value="Instagram">Instagram</option>' +
                            '</select>' +
                            '<label for="url">URL</label>' +
                            '<input class="form-control" name="url[]" type="text">');
                        control ++;
                    } else
                        $('#btn-add-new-social').hide();
                });
            },

            /**
             * Añade mas componentes en la seccion de correo
             * @constructor
             */
            AddNewMail: function ()
            {
                var control = 2;
                $('#btn-add-new-mail').click(function () {
                    if(control <= 10){
                        $('.codizer-new-mail').append('<hr/><label for="desc_mail">Descripción</label><input id="desc_mail" class="form-control" name="desc_mail[]" type="text"><label for="email">Correo</label><input id="email" class="form-control" name="email[]" type="text">')
                        control++;
                    } else
                        $('#btn-add-new-mail').hide();
                });
            },

            /**
             * Añade mas componentes en la seccion de telefono
             * @constructor
             */
            AddNewPhone: function ()
            {
                var control = 2;
                $('#btn-add-new-phone').click(function () {
                    if(control <= 10){
                        $('.codizer-new-phone').append('<hr/><label for="desc_tel">Descripción</label><input id="desc_tel" class="form-control" name="desc_tel[]" type="text"><label for="numero_tel">Número</label><input id="numero_tel" class="form-control" name="numero_tel[]" type="text">');
                        control++;
                    } else
                        $('#btn-add-new-phone').hide();
                });
            },

            /**
             * Añade mas componentes en la seccion de direccion
             * @constructor
             */
            AddNewAddress: function ()
            {
                var control = 2;
                $('#btn-add-new-address').click(function () {
                    if(control <= 3) {
                        $(".codizer-new-addresa").append('<hr/>' +
                            '<label for="desc_dir">Descripción</label>' +
                            '<input id="desc_dir" class="form-control" name="desc_dir[]" type="text">' +
                            '<label for="calle">Calle</label>' +
                            '<input id="calle" class="form-control" name="calle[]" type="text">' +
                            '<label for="numero_dir">Número</label>' +
                            '<input id="numero_dir" class="form-control" name="numero_dir[]" type="text">' +
                            '<label for="piso_edificio">Piso/Edificio</label>' +
                            '<input id="piso_edificio" class="form-control" name="piso_edificio[]" type="text">' +
                            '<label for="ciudad">Ciudad</label>' +
                            '<input id="ciudad" class="form-control" name="ciudad[]" type="text">' +
                            '<label for="cp">Código Postal</label>' +
                            '<input id="cp" class="form-control" name="cp[]" type="text">' +
                            '<label for="estado_dir">Estado</label>' +
                            '<input id="estado_dir" class="form-control" name="estado_dir[]" type="text">' +
                            '<label for="pais">País</label>' +
                            '<input id="pais" class="form-control" name="pais[]" type="text">');
                        control++;
                    } else
                    $('#btn-add-new-address').hide();
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
                var form = $('#form-contact-to-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',

                    data:new FormData( $('#form-contact-to-update')[0] ),
                    contentType: false,
                    processData: false,

                    success: function( result )
                    {

                        if (result.message == "No se pudo guardar el contacto.") {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);

                            containerContacts.prepend( contactNewEdit(result) );

                            $('#msg-list-vacio').show();
                            $('#btn-new-contact').show();
                            hideElements();

                            tableTrTouched.fadeOut();
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

        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });
})(jQuery);


