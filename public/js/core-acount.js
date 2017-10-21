/**
 * Created by Jonathan Lozano on 11/04/2016.
 */

var controlDir = $('#nDir').val();
var controlTel = $('#nTel').val();
var controlMail = $('#nMail').val();
var controlSocial = $('#nSocial').val();

function hideElements(){
    $('#form-edit').hide();
    $('#core-content-info').show();
    document.getElementById("form-contact-to-update").reset();
    $('#address-edit').hide();
    $('#core-content-dir').show();
    document.getElementById("form-address-to-update").reset();
    $('#phone-edit').hide();
    $('#core-content-tel').show();
    document.getElementById("form-phone-to-update").reset();
    $('#mail-edit').hide();
    $('#core-content-correo').show();
    document.getElementById("form-mail-to-update").reset();
    $('#social-edit').hide();
    $('#core-content-social').show();
    document.getElementById("form-social-to-update").reset();
}

function refillInfoToShowUpdate(result){
    $('#show-info-contact-full-nombre').empty();
    $('#show-info-contact-sexo').empty();
    $('#show-info-contact-f-nacimiento').empty();
    $('#show-info-contact-profesion').empty();
    $('#show-info-contact-estado-civil').empty();
    $('#show-contact-desc-info').empty();

    $('#show-info-contact-full-nombre').append(result.contacto.nombre + ' ' + result.contacto.ap_paterno + ' ' + result.contacto.ap_materno);
    $('#show-info-contact-foto').attr('src','/media/photo-perfil/'+ result.contacto.foto);
    $('#show-info-contact-sexo').append(result.contacto.sexo);
    $('#show-info-contact-f-nacimiento').append(result.contacto.f_nacimiento);
    $('#show-info-contact-profesion').append(result.contacto.profesion);
    $('#show-info-contact-estado-civil').append(result.contacto.estado_civil);
    $('#show-contact-desc-info').append(result.contacto.desc_contacto);

    // LLenar formulario
    $('#nombre-ud').val(result.contacto.nombre);
    $('#ap_paterno-ud').val(result.contacto.ap_paterno);
    $('#ap_materno-ud').val(result.contacto.ap_materno);

    $('#show-info-contact-foto-ud').attr('src', '/media/photo-perfil/' + result.contacto.foto);
    $('#sexo-ud').val(result.contacto.sexo).attr('selected', 'selected');

    var fecha = new Date(result.contacto.f_nacimiento);
    if(fecha == 'Invalid Date'){
        $('#f_nacimiento-ud').val(null);
    } else {
        $('#f_nacimiento-ud').val(fecha.toISOString().slice(0, 10));
    }

    $('#profesion-ud').val(result.contacto.profesion);
    $('#estado_civil-ud').val(result.contacto.estado_civil).attr('selected', 'selected');
    $('#desc_contacto-ud').val(result.contacto.desc_contacto);
}

function refillAddressToShowUpdate(address) {
    $('#core-content-address').empty();
    $.each(address, function (index, item) {
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
    });

    // Llenar formulario direccion
    $('#core-content-form-address').empty();
    $.each(address, function (index, item) {
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
        controlDir = index;
    });
    $('#core-content-form-address').append('<div id="codizer-new-address"></div>');
}

function refillPhoneToShowUpdate(phone){
    $('#core-content-phone').empty();
    $('#core-content-phone').append('<div class="core-show-title-blue">Teléfono</div>');
    $.each(phone, function (index, item) {
        $('#core-content-phone').append(
            '<div><div>' + item.desc_tel + '</div>' +
            '<div class="show-info-contact" id="show-info-contact-num-tel">' + item.numero_tel + '</div></div>'
        );
    });

    $('#core-content-form-phone').empty();
    $.each(phone, function (index, item) {
        $('#core-content-form-phone').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
            '<label for="desc_tel">Descripción</label><input class="form-control" name="desc_tel[]" type="text" value="' + item.desc_tel + '">' +
            '<label for="numero_tel">Número</label><input class="form-control" name="numero_tel[]" type="text" value="' + item.numero_tel + '">' +
            '<hr/>'
        );
    });
    $('#core-content-form-phone').append('<div id="codizer-new-phone"></div>');
}

function refillMailToShowUpdate(mail){
    $('#core-content-mail').empty();
    $.each(mail, function (index, item) {
        $('#core-content-mail').append(
            '<div><div>' + item.desc_mail + '</div>' +
            '<div class="show-info-contact" id="show-info-contact-mail">' + item.email + '</div></div>'
        );
    });

    $('#core-content-form-mail').empty();
    $.each(mail, function (index, item) {
        $('#core-content-form-mail').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
            '<label for="desc_mail">Descripción</label><input class="form-control" name="desc_mail[]" type="text" value="' + item.desc_mail + '">' +
            '<label for="email">Correo</label><input class="form-control" name="email[]" type="text" value="' + item.email + '">' +
            '<hr/>'
        );
    });
    $('#core-content-form-mail').append('<div id="codizer-new-mail"></div>');
}

function refilSocialToShowUpdate(social){
    $('#core-content-social-net').empty();
    $.each(social, function (index, item) {
        $('#core-content-social-net').append(
            '<div><div>' + item.red_social_nombre + '</div>' +
            '<div class="show-info-contact" id="show-info-contact-url">' + item.url + '</div></div>'
        );
    });

    $('#core-content-form-social').empty();
    $.each(social, function (index, item) {
        $('#core-content-form-social').append(
            '<input name="id[]" type="hidden" value="' + item.id + '">' +
            '<label for="red_social_nombre">Descripción</label><select id="r-s-n' + index +'" class="form-control" name="red_social_nombre[]"><option value="Facebook">Facebook</option><option value="Twitter">Twitter</option><option value="Linkedin">Linkedin</option><option value="Google+">Google+</option><option value="Instagram">Instagram</option></select>'+
            '<label for="email">Correo</label><input class="form-control" name="url[]" type="text" value="' + item.url + '"><hr />'
        );
        $('#r-s-n'+ index).val(item.red_social_nombre).attr('selected', 'selected');
    });
    $('#core-content-form-social').append('<div id="codizer-new-social-network"></div>');
}

$(document).ready(function() {

    $('#btn-edit-general').click(function(){
        $('#core-content-info').hide();
        $('#form-edit').show();
    });

    $('#btn-edit-address').click(function(){
        $('#core-content-dir').hide();
        $('#address-edit').show();
    });

    $('#btn-edit-phone').click(function(){
        $('#core-content-tel').hide();
        $('#phone-edit').show();
    });

    $('#btn-edit-mail').click(function(){
        $('#core-content-correo').hide();
        $('#mail-edit').show();
    });

    $('#btn-edit-social').click(function(){
        $('#core-content-social').hide();
        $('#social-edit').show();
    });

    $('#btn-cancel-info').click(function (){
        $('#core-content-info').show();
        $('#form-edit').hide();
    });

    $('#btn-cancel-address').click(function () {
        $('#core-content-dir').show();
        $('#address-edit').hide();
        $('#codizer-new-address').empty();
    });

    $('#btn-cancel-phone').click(function () {
        $('#core-content-tel').show();
        $('#phone-edit').hide();
        $('#codizer-new-phone').empty();
    });

    $('#btn-cancel-mail').click(function () {
        $('#core-content-correo').show();
        $('#mail-edit').hide();
        $('#codizer-new-mail').empty();
    });

    $('#btn-cancel-social').click(function () {
        $('#core-content-social').show();
        $('#social-edit').hide();
        $('#codizer-new-social-network').empty();
    });
});

/**
 * Imagen muestra antes de actualizar
 */
$('#foto-ud').change(function (e) {
    $('#show-info-contact-foto-ud').attr('src', URL.createObjectURL(e.target.files[0]));
});

(function($){

    var App = { init: function() {
        App.UpdateUser();
        App.UpdateContact();
        App.UpdateAddress();
        App.UpdatePhone();
        App.UpdateMail();
        App.UpdateSocial();
        App.AddNewSocial();
        App.AddNewMail();
        App.AddNewPhone();
        App.AddNewAddress();
    },

        /**
         * Añade mas componentes en la seccion de redes sociales
         * @constructor
         */
        AddNewSocial: function()
        {
            $('#btn-update-new-social').click(function(){
                controlSocial ++;
                if(controlSocial <= 10) {
                    $('#codizer-new-social-network').append(
                        '<label for="red_social_nombre">Red social</label>' +
                        '<select name="red_social_nombre[]" class="form-control">' +
                        '<option value="Facebook">Facebook</option>' +
                        '<option value="Twitter">Twitter</option>' +
                        '<option value="Linkedin">Linkedin</option>' +
                        '<option value="Google+">Google+</option>' +
                        '<option value="Instagram">Instagram</option>' +
                        '</select>' +
                        '<label for="url">URL</label>' +
                        '<input class="form-control" name="url[]" type="text"><hr />'
                    );
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
            $('#btn-update-new-mail').click(function () {
                controlMail++;
                if(controlMail <= 10){
                    $('#codizer-new-mail').append(
                        '<label for="desc_mail">Descripción</label>' +
                        '<input id="desc_mail" class="form-control" name="desc_mail[]" type="text">' +
                        '<label for="email">Correo</label>' +
                        '<input id="email" class="form-control" name="email[]" type="text"><hr />'
                    );
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
            $('#btn-update-new-phone').click(function () {
                controlTel++;
                if(controlTel <= 10){
                    $('#codizer-new-phone').append(
                        '<label for="desc_tel">Descripción</label>' +
                        '<input id="desc_tel" class="form-control" name="desc_tel[]" type="text">' +
                        '<label for="numero_tel">Número</label>' +
                        '<input id="numero_tel" class="form-control" name="numero_tel[]" type="text"><hr />');
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
            $('#btn-update-new-address').click(function () {
                controlDir++;
                if(controlDir <= 3) {
                    $("#codizer-new-address").append('<label for="desc_dir">Descripción</label>' +
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
                        '<input id="pais" class="form-control" name="pais[]" type="text"><hr />');
                } else
                    $('#btn-update-new-address').hide();
            });

        },

        /**
         * Actualizar contacto
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
                            hideElements();
                            refillInfoToShowUpdate(result);

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
         * Actualizar usuario
         * @constructor
         */
        UpdateUser: function()
        {
            $('#btn-update-user').click( function()
            {
                var form = $('#form-user-to-update');
                var route = form.attr('action');
                var datos = form.serializeArray();

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    data:       datos,

                    success: function( result )
                    {

                        if (result.error) {
                            hideShowAlert('msj-danger', result.error);
                        } else {
                            form[0].reset();
                            hideShowAlert('msj-success', result.message);
                        }
                    }

                }).fail(function( jqXHR, textStatus ) {
                    $('#msj-danger-state').empty();
                    var message = "";

                    if(jqXHR.responseJSON.password && jqXHR.responseJSON.email){
                        var i = 0;
                        for(i; i < jqXHR.responseJSON.email.length; i++){
                            message = jqXHR.responseJSON.email[i] + '<br>';
                        }
                        for(i; i < jqXHR.responseJSON.password.length; i++){
                            message += jqXHR.responseJSON.password[i] + '<br>';
                        }
                        hideShowAlert('msj-danger', 'Ocurrio un problema.<br>' + message);

                    } else if(jqXHR.responseJSON.password){
                        for(var i = 0; i < jqXHR.responseJSON.password.length; i++){
                            message += jqXHR.responseJSON.password[i] + '<br>';
                        }
                        hideShowAlert('msj-danger', 'Ocurrio un problema.<br>' + message);
                    } else {
                        hideShowAlert('msj-danger', 'Ocurrio un problema.<br>' + jqXHR.responseJSON.email);
                    }

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

                        if (result.error) {
                            hideShowAlert('msj-danger', 'Ocurrio un problema');
                        } else {
                            hideShowAlert('msj-success', result.message);
                            hideElements();
                            refillAddressToShowUpdate(result.address);
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
                            hideElements();
                            refillPhoneToShowUpdate(result.phone);
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
                            hideElements();
                            refillMailToShowUpdate(result.mail);
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
                            hideElements();
                            refilSocialToShowUpdate(result.social);
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


