$('#equipo-tag').addClass('companies-tag-selectionated');

var employeeContainer = $('#container-employees-list-all');
var employeeOldContainerToHide = null;

function addEmployee(result) {
    return '<div class="employee-container-mini" data-id="' + result.empleado.empleado_id  + '"> <div class="btn-employee-container"> <div class="btn-group" role="group"> <button type="button" class="btn btn-default btn-sm dropdown-toggle btn-extra btn-extra-morado-bg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-h fa-lg"></i> </button> <ul class="dropdown-menu"> <li><a class="btn-update-employee" href="#" data-toggle="modal" data-target="#modalUpdateEmployee">Editar Empleado</a></li> </ul> </div> </div> <div class="body-nivel"> <span class="txt-color-morado">Nivel</span> <div>' + result.empleado.nivel + '</div> </div> <img src="' + result.empleado.foto + '" class="body-photo-employee"> <div class="body-name-employee"> <span class="txt-color-morado">Empleado</span> <div><a href="' + result.empleado.perfil_route + '" target="_blank">' + result.empleado.nombre + ' ' + result.empleado.ap_paterno + ' ' + result.empleado.ap_materno + '</a></div> </div> <div class="body-tienda-employee"> <span class="txt-color-morado">Tienda</span> <div><a href="' + result.empleado.store_route + '" target="_blank">' + result.empleado.nombre_tienda + '</a></div> </div> <img src="' + result.empleado.foto_tienda + '" class="body-photo-tienda-employee"> </div>';
}

function fillFormEmployee(result) {

    $('#id').val(result.empleado.empleado_id);

    $(".radio-employee-ghange").each(function (index) {
        if ( $(this).val() == result.empleado.users_id ) {
            // $(this).prop( "checked", true );
            $(this).click();
        }
    });

    $('#empresa_id').val(result.empleado.empresa_id);
    $('#tienda_id').val(result.empleado.tienda_id);
    $('#nivel').val(result.empleado.nivel);
    $('#estado').val(result.empleado.empleado_estado);
    $('#salario').val(result.empleado.salario);
}

(function($) {

    var App = {
        init: function () {
            App.GetDataEmployee();
            App.CreateEmployee();
            App.UpdateEmployee();
        },

        CreateEmployee: function () {

            $('#new-employee').click( function() {
                if ( validateGroup(".form-group-validate-employee-new") == -1 )
                    initSaveEmployee();
            });

            function initSaveEmployee() {
                var form = $('#form-employee-store');
                var data = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'POST',
                    dataType:   'json',
                    // async:   false,
                    data:       data,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {

                        $('.core-loader').hide();
                        $('#msg-vacio').hide();

                        if (result.message)
                        {
                            hideShowAlert('msj-danger', result.message);
                        } else {

                            console.log(result.empleado);

                            $('.close').click();
                            // document.getElementById("form-employee-store").reset();

                            // Incrementamos en más 1 el contador de employee
                            $('#lb-count-employee').html( parseInt($('#lb-count-employee').html()) + 1 );

                            employeeContainer.append( addEmployee(result) );
                        }

                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }
        },

        GetDataEmployee: function() {

            // Escuchar eventos dentro de categoriaContainer sobre .btn-update-employee
            employeeContainer.on("click", '.btn-update-employee', function() {

                // Obtener el elemento padre
                employeeOldContainerToHide = $(this).parents('div.employee-container-mini');

                // Obtener el data-id del elemento padre y agregarlo al formulario de show employee para obtener la data
                $('#id-employee-to-show').val( employeeOldContainerToHide.data('id') );

                initGetEmployee();
            });

            function initGetEmployee() {
                var form = $('#form-employee-to-show');
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
                        console.log(result.empleado);
                        fillFormEmployee(result);
                    }

                }).fail(function (jqXHR, textStatus) {
                    $('.core-loader').hide();

                    $('#msj-danger-state').empty();

                    $(jqXHR).each(function (key, error) {
                        hideShowAlert('msj-danger', 'Ocurrio un problema');
                    });

                });
            }

        },

        UpdateEmployee: function() {
            $('#update-employee').click( function() {
                if ( validateGroup(".form-group-validate-employee-update") == -1 )
                    initUpdateEmployee();
            });

            function initUpdateEmployee() {
                var form = $('#form-employee-update');
                var datos = form.serializeArray();
                var route = form.attr('action');

                $.ajax({
                    url:        route,
                    type:       'PUT',
                    dataType:   'json',
                    // async:   false,
                    data:       datos,

                    beforeSend: function(){
                        $('.core-loader').show();
                    },

                    success: function (result) {
                        $('.core-loader').hide();

                        if (result.message)
                        {
                            hideShowAlert('msj-danger', result.message);
                        } else {
                            $('.close').click();
                            document.getElementById("form-employee-update").reset();

                            employeeOldContainerToHide.hide();
                            employeeOldContainerToHide.after(addEmployee(result));
                        }
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