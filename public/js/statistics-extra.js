/**
 * Created by Codizer on 12/1/15.
 */



$("#close-modal-stats-extra").click(function()
{

    var content = $('#content-data-extra');

    content.empty();
    $('#modal-stats-extra').animate({left: '-320px'});
});


function modalStacsExtra()
{

    $('#close-modal-stats-extra').click();
    var modal = $('#modal-stats-extra');
    var content = $('#content-data-extra');

    var title = $('#opcion-extra-selected');

    title.text( 'Cargando....' );

    content.append('<div id="loading-codizer"><svg width="80" height="80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><g fill="none" stroke-linecap="round"><path d="m44.785 10.363c3.097-1.796 8.119-1.801 11.214-.013l24.29 14.03c3.096 1.789 5.614 6.148 5.624 9.717l.087 30.869c.01 3.578-2.477 7.963-5.543 9.787l-24.977 14.858c-3.071 1.827-8.06 1.834-11.138.017l-25.827-15.246c-3.08-1.818-5.549-6.196-5.516-9.769l.274-29.542c.033-3.577 2.564-7.929 5.668-9.729l25.842-14.982" stroke="#2C2C2C" stroke-width="10"/><path d="m44.785 10.363c3.097-1.796 8.119-1.801 11.214-.013l24.29 14.03c3.096 1.789 5.614 6.148 5.624 9.717l.087 30.869c.01 3.578-2.477 7.963-5.543 9.787l-24.977 14.858c-3.071 1.827-8.06 1.834-11.138.017l-25.827-15.246c-3.08-1.818-5.549-6.196-5.516-9.769l.274-29.542c.033-3.577 2.564-7.929 5.668-9.729l25.842-14.982" stroke="#3997ee" stroke-width="4"><animate attributeName="stroke-dashoffset" dur="2s" repeatCount="indefinite" from="0" to="502"/><animate attributeName="stroke-dasharray" dur="2s" repeatCount="indefinite" values="150.6 100.4;1 250;150.6 100.4"/></path></g></svg></div>');

    modal.animate({left: '0px'});


}


function addExtraDataStats(option,  graphDiv )
{

    var datos = charConfig[graphDiv];

    if(option == 'clonar') {

        getDataToGraphics( option, datos );

    } else {

        modalStacsExtra();

        datos.push({name: "extra", value: option});

        var route = $("#form-columns-data").attr('action');

        $.ajax({
            url: route,
            type: 'POST',
            dataType: 'json',
            data: datos,
            // async: false,

            success: function (result)
            {

                var title = $('#opcion-extra-selected');
                var content = $('#content-data-extra');

                content.empty();

                title.text( result[0][7] );

                // Tendencia central
                if( result[0][7] == 'Tendencia central'){

                    content.append('<div class="container-rangos"> <div><div></div><h3>' + result[0][4].toFixed(2)  + '</h3><p>Media</p></div> <div><div></div><h3>' + result[0][5] + '</h3><p>Mediana</p></div> <div><div></div><h3>'+result[0][6]+'</h3><p>Moda</p></div> </div>');
                }


                // Medidas de dispersión
                var tableContent = '';
                var contador = 1;
                var title = [];

                if( result[0][7] == 'Medidas de dispersión'){

                    title = ['Desviación Media', 'Varianza', 'Desciación Estándar'];

                    for(var i = 1; i<= 3; i++ ){
                        tableContent += '<table class="table table-condensed"><thead><tr>';
                        tableContent += '<th>' + title[i-1] + '</th></tr></thead>';
                        tableContent += '<tbody>';
                        tableContent += '<tr><td>' + result[0][i] + '</td></tr>';
                        tableContent += '</tbody></table>';
                    }
                }


                // Medidas de Posición
                if( result[0][7] == 'Medidas de Posición'){

                    title = ['Deciles', 'Percentiles', 'Cuartiles'];

                    for(var i = 1; i<= 3; i++ ){

                        tableContent += '<table class="table table-condensed"><thead><tr>';
                        tableContent += '<th>#</th> <th>' + title[i-1] + '</th></tr></thead>';
                        tableContent += '<tbody>';
                        contador = 1;
                        $(result[0][i]).each( function(key, value) {
                            tableContent += '<tr><th scope="row">' + contador++ + '</th><td>' + value + '</td></tr>';
                        });

                        tableContent += '</tbody></table></br>';

                    }
                }

                // Medidas de Deformación
                if( result[0][7] == 'Medidas de Deformación'){

                    title = ['Sesgo empleando Moda', 'Sesgo empleando Mediana', 'Sesgo empleando percentiles', 'Sesgo empleando cuartiles', 'Sesgo - A', 'Momento de orden', 'Curtosis - Q', 'Curtosis', 'Curtosis - A'];
                    result[0][7] = result[0][10];
                    for(var i = 1; i<= 9; i++ ){
                        tableContent += '<table class="table table-condensed"><thead><tr>';

                        if( i == 6 ) {
                            tableContent += '<th>#</th> <th>' + title[i-1] + '</th></tr></thead>';
                            tableContent += '<tbody>';

                            contador = 1;
                            $(result[0][i]).each( function(key, value) {
                                tableContent += '<tr><th scope="row">' + contador++ + '</th><td>' + value + '</td></tr>';
                            });

                        } else {

                            tableContent += '<th>' + title[i - 1] + '</th></tr></thead>';
                            tableContent += '<tbody>';
                            tableContent += '<tr><td>' + result[0][i] + '</td></tr>';
                        }

                        tableContent += '</tbody></table>';

                    }
                }

                content.append( tableContent );

            }

        }).fail(function( jqXHR, textStatus ) {

                hideShowAlert('msj-danger', 'Ocurrio un problema al obtener los datos');
        });
    }


}