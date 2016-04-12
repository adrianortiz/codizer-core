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
 * Imagen muestra antes de actualizar
 */
$('#foto-ud').change(function (e) {
    $('#show-info-contact-foto-ud').attr('src', URL.createObjectURL(e.target.files[0]));
});

/**
 * Llena el formulario para actualizar informacion del contacto
 * @param contacto
 * Recibe el objeto con la informacion del contacto
 */
function emptyAndRefillFieldsToUpdate(contacto) {
    // Info contacto
    $('#nombre-ud').empty();
    $('#ap_paterno-ud').empty();
    $('#ap_materno-ud').empty();
    $('#sexo-ud').val('Masculino').attr('selected', 'selected');
    $('#f_nacimiento-ud').empty();
    $('#profesion-ud').empty();
    $('#estado_civil-ud').val('Soltero').attr('selected', 'selected');
    $('#desc_contacto-ud').empty();

    $('#nombre-ud').val(contacto.nombre);
    $('#ap_paterno-ud').val(contacto.ap_paterno);
    $('#ap_materno-ud').val(contacto.ap_materno);

    $('#show-info-contact-foto-ud').attr('src', '/media/photo-perfil/' + contacto.foto);
    $('#sexo-ud').val(contacto.sexo).attr('selected', 'selected');

    var fecha = new Date(contacto.f_nacimiento);
    if(fecha == 'Invalid Date'){
        $('#f_nacimiento-ud').val(null);
    } else {
        $('#f_nacimiento-ud').val(fecha.toISOString().slice(0, 10));
    }

    $('#profesion-ud').val(contacto.profesion);
    $('#estado_civil-ud').val(contacto.estado_civil).attr('selected', 'selected');
    $('#desc_contacto-ud').val(contacto.desc_contacto);
}

function emptyAndRefillPhoneFieldsToUpdate(phone) {
    $('#core-content-form-phone').empty();
    $.each(phone, function (index, item) {
        $('#contactId-contactPhone-to-update').val(item.contacto_id);
        $('#core-content-form-phone').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
            '<label for="desc_tel">Descripción</label><input class="form-control" name="desc_tel[]" type="text" value="' + item.desc_tel + '">' +
            '<label for="numero_tel">Número</label><input class="form-control" name="numero_tel[]" type="text" value="' + item.numero_tel + '">' +
            '<hr/>'
        );
    });
    $('#core-content-form-phone').append('<div id="codizer-new-phone"></div>');
}

function emptyAndRefillAddressFieldsToUpdate(address) {
    $('#core-content-form-address').empty();
    $.each(address, function (index, item) {
        $('#contactId-contactAddress-to-update').val(item.contacto_id);
        $('#core-content-form-address').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
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
    $('#core-content-form-address').append('<div id="codizer-new-address"></div>');
}

function emptyAndRefillMailFieldsToUpdate(mail) {
    $('#core-content-form-mail').empty();
    $.each(mail, function (index, item) {
        $('#contactId-contactMail-to-update').val(item.contacto_id);
        $('#core-content-form-mail').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
            '<label for="desc_mail">Descripción</label><input class="form-control" name="desc_mail[]" type="text" value="' + item.desc_mail + '">' +
            '<label for="email">Correo</label><input class="form-control" name="email[]" type="text" value="' + item.email + '">' +
            '<hr/>'
        );
    });
    $('#core-content-form-mail').append('<div id="codizer-new-mail"></div>');
}

function emptyAndRefillSocialFieldsToUpdate(social) {
    $('#core-content-form-social').empty();
    $.each(social, function (index, item) {
        $('#contactId-contactSocial-to-update').val(item.contacto_id);
        $('#core-content-form-social').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
            '<label for="red_social_nombre">Descripción</label><select id="r-s-n' + index +'" class="form-control" name="red_social_nombre[]"><option value="Facebook">Facebook</option><option value="Twitter">Twitter</option><option value="Linkedin">Linkedin</option><option value="Google+">Google+</option><option value="Instagram">Instagram</option></select>'+
            '<label for="email">Correo</label><input class="form-control" name="url[]" type="text" value="' + item.url + '"><hr />'
        );
        $('#r-s-n'+ index).val(item.red_social_nombre).attr('selected', 'selected');
    });
    $('#core-content-form-social').append('<div id="codizer-new-social-network"></div>');
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
    $('#core-content-address').append('<div class="core-show-title-blue">Dirección</div>');
    $.each(result.address, function (index, item) {
        if(item.desc_dir == "" &&
            item.calle == "" &&
            item.numero_dir == "" &&
            item.piso_edificio == "" &&
            item.ciudad == "" &&
            item.cp == "" &&
            item.estado_dir == "" &&
            item.pais == "") {
            $('#core-content-address').append(
                '<div><div class="show-info-contact">' +
                '<div id="show-info-contact-desc-dir">Descripcion: <b>Aun no has agregado una descripcion</b></div>' +
                '<div id="show-info-contact-calle">Calle: <b>Aun no has agregado una calle</b></div>' +
                '<div id="show-info-contact-num-dir">Número: <b>Aun no has agregado un numero</b></div>' +
                '<div id="show-info-contact-p-e">Piso/Edificio: <b>Aun no has agregado piso/edificio</b></div>' +
                '<div id="show-info-contact-cd">Ciudad: <b>Aun no has agregado ciudad</b></div>' +
                '<div id="show-info-contact-cp">Código Postal: <b>Aun no has agegado codigo postal</b></dv>' +
                '<div id="show-info-contact-edo">Estado: <b>Aun no has agregado estado</b></div>' +
                '<div id="show-info-contact-pais">País: <b>Aun no has agregado pais</b></div>' +
                '</div></div>'
            );
        } else {
            $('#core-content-address').append(
                '<div><div class="show-info-contact">' +
                '<div id="show-info-contact-desc-dir">Descripcion: <b> ' + item.desc_dir + '</b></div>' +
                '<div id="show-info-contact-calle">Calle: <b> ' + item.calle + '</b></div>' +
                '<div id="show-info-contact-num-dir">Número: <b> ' + item.numero_dir + '</b></div>' +
                '<div id="show-info-contact-p-e">Piso/Edificio: <b> ' + item.piso_edificio + '</b></div>' +
                '<div id="show-info-contact-cd">Ciudad: <b> ' + item.ciudad + '</b></div>' +
                '<div id="show-info-contact-cp">Código Postal: <b> ' + item.cp + '</b></dv>' +
                '<div id="show-info-contact-edo">Estado: <b> ' + item.estado_dir + '</b></div>' +
                '<div id="show-info-contact-pais">País: <b> ' + item.pais + '</b></div>' +
                '</div></div>'
            );
        }
    });

    $('#core-content-phone').empty();
    $('#core-content-phone').append('<div class="core-show-title-blue">Teléfono</div>');
    $.each(result.phone, function (index, item) {
        if (item.desc_tel == "" && item.numero_tel == "") {
            $('#core-content-phone').append(
                '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-tel">Aun no has añadido ninguna descripción</div></div>' +
                '<div><div>Número</div><div class="show-info-contact" id="show-info-contact-num-tel">Aun no has añadido ningun teléfono</div></div>'
            );
        } else {
            $('#core-content-phone').append(
                '<div><div>' + item.desc_tel + '</div>' +
                '<div class="show-info-contact" id="show-info-contact-num-tel">' + item.numero_tel + '</div></div>'
            );
        }
    });

    $('#core-content-mail').empty();
        $('#core-content-mail').append('<div class="core-show-title-blue">Correo</div>');
        $.each(result.mail, function (index, item) {
            if (item.desc_mail == "" && item.email == "") {
                $('#core-content-mail').append(
                    '<div><div>Descripción</div><div class="show-info-contact" id="show-info-contact-desc-mail">Aun no has añadido ninguna descripcion</div></div>' +
                    '<div><div>Correo</div><div class="show-info-contact" id="show-info-contact-mail">Aun no has añadido ningun correo</div></div>'
                );
            } else {

                $('#core-content-mail').append(
                    '<div><div>' + item.desc_mail + '</div>' +
                    '<div class="show-info-contact" id="show-info-contact-mail">' + item.email + '</div></div>'
                );
            }
        });

    $('#core-content-social').empty();
    //$('#social-nets').empty();
    $('#core-content-social').append('<div class="core-show-title-blue">Redes sociales</div>');
        $.each(result.social, function (index, item) {
            if (item.url == "") {
                $('#core-content-social').append(
                    '<div><div>' + item.red_social_nombre + '</div>' +
                    '<div class="show-info-contact" id="show-info-contact-url">Aun no has añadido ninguna url</div></div>'
                );
            } else {
                //$('#social-nets').append(
                //    '<a href="' +item.url+ '" target="_blank" class="btn btn-social-radius btn-shadow-white"><i class="fa fa-' +item.red_social_nombre+ '"></i></a>'
                //);
                $('#core-content-social').append(
                    '<div><div>' + item.red_social_nombre + '</div>' +
                    '<div class="show-info-contact" id="show-info-contact-url">' + item.url + '</div></div>'
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
    $('#address-edit').hide();
    $('#phone-edit').hide();
    $('#mail-edit').hide();
    $('#social-edit').hide();
    $('#info-contact').hide();
    $('#btns-group-to-contact').hide();
    document.getElementById("form-contact-to-create").reset();
    document.getElementById("form-contact-to-update").reset();
    document.getElementById("form-address-to-update").reset();
    document.getElementById("form-phone-to-update").reset();
    document.getElementById("form-mail-to-update").reset();
    document.getElementById("form-social-to-update").reset();
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
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });

    $('#btn-cancel-phone').click(function () {
        hideElements();
        $('#core-content-form-phone').empty();
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });

    $('#btn-cancel-mail').click(function () {
        hideElements();
        $('#core-content-form-mail').empty();
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });

    $('#btn-cancel-social').click(function () {
        hideElements();
        $('#core-content-form-social').empty();
        $('#msg-list-vacio').show();
        $('#btn-new-contact').show();
    });
});


(function($){

    var App = { init: function() {
        App.CreateContact();
        App.SelectContact();
        App.UpdateContact();
        App.UpdateAddress();
        App.UpdatePhone();
        App.UpdateMail();
        App.UpdateSocial();
        App.AddNewSocial();
        App.AddNewMail();
        App.AddNewPhone();
        App.AddNewAddress();
        App.DeleteContact();
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
                        var nContacts = parseInt($('#NContacts').html()) + 1;
                        $('#NContacts').empty();
                        $('#NContacts').append(nContacts);
                        if(nContacts < 6){
                            $('#core-contacts-container').append(
                                '<a href="#" class="core-menu-list menu-list-option menu-lis-img" id="' + result.contacto.id + '">' +
                                '<img src="http://localhost:8000/media/photo-perfil/' + result.contacto.foto + '">' +
                                '<div class="list-contact-full-name">' + result.contacto.nombre + ' ' + result.contacto.ap_paterno + ' ' + result.contacto.ap_materno + '</div>' +
                                '</a>'
                            );
                        }

                        hideElements();
                        $('#msg-list-vacio').show();
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
                        $('#id-contact-to-delete').val(result.contacto[0].id);

                        /**
                         * Evento que se lanza al editar informacion de contacto
                         */
                        $('#id-contact-to-update').val(result.contacto[0].id);
                        $('#btn-edit-contact').click(function(){
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#form-edit').show();
                            emptyAndRefillFieldsToUpdate(result.contacto[0]);
                        });

                        /**
                         * Evento que se lanaza al editar direccion(es) de contacto
                         */
                        $('#btn-edit-address').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#address-edit').show();
                            emptyAndRefillAddressFieldsToUpdate(result.address);
                        });

                        /**
                         * Evento que se lanza al editar telefono(s) de contacto
                         */
                        $('#btn-edit-phone').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#phone-edit').show();
                            emptyAndRefillPhoneFieldsToUpdate(result.phone);
                        });

                        $('#btn-edit-mail').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
                            $('#mail-edit').show();
                            emptyAndRefillMailFieldsToUpdate(result.mail);
                        });

                        $('#btn-edit-social').click(function () {
                            hideElements();
                            $('#btns-group-to-contact').show();
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

                var cont = '<label for="red_social_nombre">Red social</label>' +
                    '<select name="red_social_nombre[]" class="form-control">' +
                    '<option value="Facebook">Facebook</option>' +
                    '<option value="Twitter">Twitter</option>' +
                    '<option value="Linkedin">Linkedin</option>' +
                    '<option value="Google+">Google+</option>' +
                    '<option value="Instagram">Instagram</option>' +
                    '</select>' +
                    '<label for="url">URL</label>' +
                    '<input class="form-control" name="url[]" type="text"><hr />';

                $('#btn-add-new-social').click(function(){
                    if(control <= 10) {
                        $('.codizer-new-social-network').append(cont);
                        control ++;
                    } else
                        $('#btn-add-new-social').hide();
                });

                $('#btn-update-new-social').click(function(){
                    if(control <= 10) {
                        $('#codizer-new-social-network').append(cont);
                        control ++;
                    } else
                        $('#btn-update-new-social').hide();
                });
            },

            /**
             * Añade mas componentes en la seccion de correo
             * @constructor
             */
            AddNewMail: function ()
            {
                var control = 2;

                var content = '<label for="desc_mail">Descripción</label>' +
                    '<input id="desc_mail" class="form-control" name="desc_mail[]" type="text">' +
                    '<label for="email">Correo</label>' +
                    '<input id="email" class="form-control" name="email[]" type="text"><hr />';

                $('#btn-add-new-mail').click(function () {
                    if(control <= 10){
                        $('.codizer-new-mail').append(content);
                        control++;
                    } else
                        $('#btn-add-new-mail').hide();
                });

                $('#btn-update-new-mail').click(function () {
                    if(control <= 10){
                        $('#codizer-new-mail').append(content);
                        control++;
                    } else
                        $('#btn-update-new-mail').hide();
                });
            },

            /**
             * Añade mas componentes en la seccion de telefono
             * @constructor
             */
            AddNewPhone: function ()
            {
                var control = 2;

                var content = '<label for="desc_tel">Descripción</label>' +
                '<input id="desc_tel" class="form-control" name="desc_tel[]" type="text">' +
                '<label for="numero_tel">Número</label>' +
                '<input id="numero_tel" class="form-control" name="numero_tel[]" type="text"><hr />';

                $('#btn-add-new-phone').click(function () {
                    if(control <= 10){
                        $('.codizer-new-phone').append(content);
                        control++;
                    } else
                        $('#btn-add-new-phone').hide();
                });

                $('#btn-update-new-phone').click(function () {
                    if(control <= 10){
                        $('#codizer-new-phone').append(content);
                        control++;
                    } else
                        $('#btn-update-new-phone').hide();
                });

            },

            /**
             * Añade mas componentes en la seccion de direccion
             * @constructor
             */
            AddNewAddress: function ()
            {
                var control = 2;

                var content = '<label for="desc_dir">Descripción</label>' +
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
                '<input id="pais" class="form-control" name="pais[]" type="text"><hr />';

                $('#btn-add-new-address').click(function () {
                    if(control <= 3) {
                        $(".codizer-new-addresa").append(content);
                        control++;
                    } else
                    $('#btn-add-new-address').hide();
                });

                $('#btn-update-new-address').click(function () {
                    if(control <= 3) {
                        $("#codizer-new-address").append(content);
                        control++;
                    } else
                        $('#btn-update-new-address').hide();
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

                        if (result.error) {
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

        },

        UpdateAddress: function()
        {
            $('#btn-update-address').click( function()
            {
                var form = $('#form-address-to-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',

                    data:new FormData( $('#form-address-to-update')[0] ),
                    contentType: false,
                    processData: false,

                    success: function( result )
                    {

                        if (result.message == "No se pudo guardar el contacto.") {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);

                            $('#msg-list-vacio').show();
                            $('#btn-new-contact').show();
                            hideElements();
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

        UpdatePhone: function()
        {
            $('#btn-update-phone').click( function()
            {
                var form = $('#form-phone-to-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',

                    data:new FormData( $('#form-phone-to-update')[0] ),
                    contentType: false,
                    processData: false,

                    success: function( result )
                    {

                        if (result.error) {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);
                            $('#msg-list-vacio').show();
                            $('#btn-new-contact').show();
                            hideElements();
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

        UpdateMail: function()
        {
            $('#btn-update-mail').click( function()
            {
                var form = $('#form-mail-to-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',

                    data:new FormData( $('#form-mail-to-update')[0] ),
                    contentType: false,
                    processData: false,

                    success: function( result )
                    {

                        if (result.error) {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);

                            $('#msg-list-vacio').show();
                            $('#btn-new-contact').show();
                            hideElements();
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

        UpdateSocial: function()
        {
            $('#btn-update-social').click( function()
            {
                var form = $('#form-social-to-update');
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',

                    data:new FormData( $('#form-social-to-update')[0] ),
                    contentType: false,
                    processData: false,

                    success: function( result )
                    {

                        if (result.error) {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);

                            $('#msg-list-vacio').show();
                            $('#btn-new-contact').show();
                            hideElements();
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

        DeleteContact: function() {

            // Mostrar modal global de eliminar
            $('#btn-delete-contact').click( function() {
                $('#modal-delete').fadeIn();
                $('.notificacion-text').addClass('in');
            });

            // Ocultar modal global de eliminar
            $('#no').click( function() {
                $('.notificacion-text').removeClass('in');
                $('#modal-delete').fadeOut();
            });

            // Ejecutar accion de eliminar al pulsar si
            $('#si').click( function() {

                $('.notificacion-text').removeClass('in');
                $('#modal-delete').fadeOut();

                var form = $('#form-contact-delete');
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
                        if(result.error){
                            hideShowAlert('msj-danger', result.error);
                        } else {
                            hideShowAlert('msj-success', result.message);

                            var nContacts = parseInt($('#NContacts').html()) - 1;
                            $('#NContacts').empty();
                            $('#NContacts').append(nContacts);
                            $('#' + result.remove).fadeOut();
                            tableTrTouched.fadeOut();
                            hideElements();
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


