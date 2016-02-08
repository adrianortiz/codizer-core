/**
 * Created by Ortiz on 11/4/15.
 */



function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type=="number")) {return false;}
}

document.onkeypress = stopRKey;


/**
 * OCULTAR DISPERCIÓN
 */
var selectColumns = $('#num_colums');
var selectGrafica = $('#frecuencia');

function selectToGrafic() {

    if( selectColumns.val() == 1 ) {
        selectGrafica.find("option").show();
        selectGrafica.find("option[value='intervalAutDisp']").hide();
        selectGrafica.find("option[value='intervalAut']").prop('selected', true);
    }

    if( selectColumns.val() == 2 ) {
        selectGrafica.find("option").hide();
        selectGrafica.find("option[value='intervalAutDisp']").show();
        selectGrafica.find("option[value='intervalAutDisp']").prop('selected', true);
    }
}






function inputToGruops() {
    // grupos-de-ou
    var gruposUO = $('#grupos-de-ou');

    if( selectGrafica.val() == 'porvar' ){
        gruposUO.slideUp();
    } else {
        gruposUO.slideDown();
    }
}

selectToGrafic();
inputToGruops();

selectGrafica.change( inputToGruops );

selectColumns.change( function() {
    selectToGrafic();
    inputToGruops();
});

/*
 SHOW/HIDE MODALS STATISTICS
 */
function closeModalInputs( nameModal )
{
    $("#"+nameModal).fadeOut();
    resetClear();
    /*
    for(i=0; i<= 51; i++)
    {
        $('#graphA' + i).empty();
        $('#graphC' + i).empty();
        // Creamos nuestro canvas
        var canvas = document.getElementById("graphB" + i);
        var ctx = canvas.getContext("2d");
        // Borramos el área que nos interese
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
    */
}

function showModalInputs(nameModal)
{
    $('#title').val('');
    $('#description').val('');
    $('#titleChangeTo').text('Título del campo');
    $("span#descChangeTo").attr("data-original-title", 'Descripción de este campo.' );
    $("#"+nameModal).fadeIn();
}






/*
    GET COLUMNS FROM COLLECTION SELECTED
 */

$("#get-columns").click( function()
{
    selectToGrafic();

    var datos = $("#form-columns").serializeArray();
    var route = $("#form-columns").attr('action');
    var formColumns = $('#list-colums');
    formColumns.empty();

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        // async: false,
        data: datos,

        success: function (result)
        {
            $('#get-columns').attr("disabled", true);
            $('#id').attr("disabled", true);
            $(result).each(function(key,value)
            {
                formColumns.append('<label class="btn btn-primary inactive check-input"><input type="checkbox" name="title[]" autocomplete="off" class="hola" value="'+ value.title +'">' + value.title + '</label>');
            });

            hideShowAlert('msj-success', 'Columnas obtenidas');

            $('#get-columns').slideUp( function()
            {
                $('#form-colums-div').slideDown();
            });

            $('#controlX').val( $('#id').val());

        }

    }).fail(function( jqXHR, textStatus )
    {

        $('#msj-danger-state').empty();
        $(jqXHR).each(function(key,error)
        {
            // console.log( error.responseJSON );
            /*
            if ( !(error.responseJSON.title == null) )
                $('#msj-danger-state').append('<li>' + error.responseJSON.title + '</li>');

            if ( !(error.responseJSON.description == null) )
                $('#msj-danger-state').append('<li>' + error.responseJSON.description + '</li>');
                */
            hideShowAlert('msj-danger', 'Ocurrio un problema');
        });

    });

});





/*
     VALIDATE COLUMNS SELECTED BY NUM COLUMNS TO GRAPHICS
 */
$("#get-data").click( function()
{
    var columsGraph = $('#num_colums').val();
    var numColSelect = 0;

    if( $('#group').val() >= 2 && $('#group').val() <= 15 ) {

        $('input:checkbox:checked').each( function() { numColSelect++; });

        if (numColSelect == 0)
            hideShowAlert('msj-danger', 'Seleccionar columnas a gráficar.');

        if( columsGraph == 1 && numColSelect == 1)
            getDataToGraphics();

        if( columsGraph == 1 && numColSelect >= 2)
            hideShowAlert('msj-danger', 'No puedes elegir más de 1 columna.<br>Porque seleccionaste 1 columna a gráficar.');

        if( columsGraph == 2 && numColSelect >= 2)
            getDataToGraphics();

        if( columsGraph == 2 && numColSelect < 2)
            hideShowAlert('msj-danger', 'Selecciona almenos 2 columnas');

        numColSelect = 0;
    } else {
        hideShowAlert('msj-danger', 'La graficación en grupos tiene que estar en un rango de 2 a 15.');
    }

});


/*
 GET COLUMNS DATA FROM COLUMNS SELECTED
 */
var graphDiv = 0;
var char = [];
var charConfig = [];
var resX = [];

function getDataToGraphics(option, newDataClone )
{
    var datos;

    if(option == 'clonar') {
        datos = newDataClone;
    } else {
        datos = $("#form-columns-data").serializeArray();
    }


    var route = $("#form-columns-data").attr('action');

    var items = ['#FFAE00', '#A75BDF', '#FF3F50', '#39E861', '#00D6D5', '#00B7FE', '#D7D7D7'];

    var rint = Math.round(0xffffff * Math.random());
    var colorA = 'rgba(' + (rint >> 16) + ',' + (rint >> 8 & 255) + ',' + (rint & 255);
    var colorB = items[Math.floor(Math.random()*items.length)];
    colorB = "#B3B7BC";
    colorB = "#9688FC";

    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        data: datos,
        // async: false,

        success: function (res) {

            $(".alert").click();
            graphDiv++;

            $('#graph' + graphDiv).css({'max-height': '600 !important', 'width': '44%'});
            $('#graphB' + graphDiv).css({'height': 'auto', 'width': '100%'});


            if(res[0][7] == 'byAutoInterval')
                byAutoInterval(res, graphDiv, items, colorB);

            if(res[0][7] == 'intervalAutOji')
                byAutoIntervalOji(res, graphDiv, items, colorB);

            optionsCData = null;
            tendenCenter = '<li><a href="#" onclick="saveImg(\'#graphC'+ graphDiv +'\');">Medidas de tendencias central</a></li>';

            if( !(res[0][7] == 'byVar' ||  res[0][7] == 'intervalAutDisp') ) {
                optionsCData = '<div class="btn-group" style="float: right;" role="group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><img src="/images/icon-estadistica.svg" class="icon-button "> <span>  <span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right"> <li class="dropdown-header">Mostrar:</li> ' + tendenCenter + ' <li><a href="#" onclick="addExtraDataStats(\'medidasDispersion\','+ graphDiv +');">Medidas de dispersión</a></li>     <li><a href="#" onclick="addExtraDataStats(\'medidasPosicion\','+ graphDiv +');">Medidas de posición</a></li>       <li><a href="#" onclick="addExtraDataStats(\'medidasDeformacion\','+ graphDiv +');">Medidas de deformación</a></li> <li role="separator" class="divider"></li> </ul></div>';
            } else {
                if( res[0][7] == 'intervalAutDisp' )
                    tendenCenter = "";

                optionsCData = "";
            }


            $('#graphA' + graphDiv).append('<div><h3 style="text-align: center">Datos analizados</h3> </div> <p style="text-align: center"> ' + res[0][1] + ' -> ' + res[0][3] + '<p><div class="tag-collect"> ' + res[0][1] + ' </div></dvi>   <div class="btn-toolbar" role="toolbar"><div class="btn-group" style="float: right;" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span><img src="/images/icon-menu.svg" class="icon-button"></span><span class="caret"></span></button><ul class="dropdown-menu dropdown-menu-right"> <li class="dropdown-header">Descargar imagen de:</li> <li><a href="#" onclick="saveImg(\'#graphB'+ graphDiv +'\');">Solo gráfica</a></li> ' + tendenCenter + ' <li role="separator" class="divider"></li>     <li><a href="#" onclick="addExtraDataStats(\'clonar\','+ graphDiv +');">Clonar cofiguración base</a></li>    <li><a href="#" onclick="$(\'#graph'+ graphDiv +'\').fadeOut().empty();">Eliminar gráfica</a></li></ul></div>' + optionsCData + '</div>');
            $('#graphC' + graphDiv).append('<div class="tag-var"><span> ' + res[0][3] + ' </span></div>');

            if(res[0][7] == 'byVar')
                byVar(res, graphDiv, items, colorB);

            charConfig[graphDiv] = datos;


            // byAutoIntervalDisp
            if(res[0][7] == 'intervalAutDisp') {

                char[graphDiv] = byAutoIntervalDisp(res, graphDiv, items, colorB);
                resX[graphDiv] = res;

                $('#graphC' + graphDiv).append('<div class="container-radios"><div style="width: 100%;"> <label class="radio-inline"><input style="width: 14px !important;" type="radio" name="radio-disp' + graphDiv + '" id="radio1' + graphDiv + '" value="" checked="checked"> Punto 1 = <span id="span1'+ graphDiv +'">0</span></label> <br> <label class="radio-inline"> <input style="width: 14px !important;" type="radio" name="radio-disp' + graphDiv + '" id="radio2'+ graphDiv +'" value=""> Punto 2 = <span id="span2'+ graphDiv +'">0</span></label> </div>   </div>       <a href="#" class="btn btn-primary btn-sm" onclick="getDataPuntos(' + graphDiv + ');">Ver Punto selecto</a> <a href="#" class="btn btn-primary btn-sm" id="addDataMinCuadrado" onclick="addDataMinCuadrado(' + graphDiv + ');">Ver Minimos cuadrados</a>   ' + optionsCData + '       <input type="hidden" id="radio3'+ graphDiv +'" value=""/> <input type="hidden" id="radio4'+ graphDiv +'" value=""/> ');
            } else {
                // Medidas de tendencia central
                // .toFixed(2)
                $('#graphC' + graphDiv).append('<div class="container-rangos"> <div><div></div><h3>' + res[0][20]  + '</h3><p>Media</p></div> <div><div></div><h3>' + res[0][21] + '</h3><p>Mediana</p></div> <div><div></div><h3>'+res[0][22]+'</h3><p>Moda</p></div> </div>');
            }

        }

    }).fail(function( jqXHR, textStatus ) {
        $(jqXHR).each(function(key,error){
            hideShowAlert('msj-danger', 'Ocurrio un problema al obtener datos de la gráfica');
        });

    });
}






$('#btn-limpiar').click( function()
{
    resetClear();
});

function resetClear()
{
    $('#get-columns').attr("disabled", false);
    $('#id').attr("disabled", false);
    $('#get-columns').slideDown( function()
    {
        $('#list-colums').empty(); // limpiar columnas
        $('#form-colums-div').slideUp(); // mostrar boton enviar collection
    });
}



function filterPath(string)
{
    return string
        .replace(/^\//,'')
        .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
        .replace(/\/$/,'');
}
var locationPath = filterPath(location.pathname);
var scrollElem = scrollableElement('html', 'body');

$('a[href*=#]').each(function()
{
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
        && (location.hostname == this.hostname || !this.hostname)
        && this.hash.replace(/#/,'') ) {
        var $target = $(this.hash), target = this.hash;
        if (target) {
            var targetOffset = $target.offset().top;
            $(this).click(function(event) {
                event.preventDefault();
                $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
                    location.hash = target;
                });
            });
        }
    }
});


// use the first element that is "scrollable"
function scrollableElement(els)
{
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
        var el = arguments[i],
            $scrollElement = $(el);
        if ($scrollElement.scrollTop()> 0) {
            return el;
        } else {
            $scrollElement.scrollTop(1);
            var isScrollable = $scrollElement.scrollTop()> 0;
            $scrollElement.scrollTop(0);
            if (isScrollable) {
                return el;
            }
        }
    }
    return [];
}


$('#graphA1xx').click( function()
{
    $('#div-data').scrollTop( -1000 );
});


/*
    SAVE A IMAGE .PNG
 */
function saveImg( toImage )
{
    html2canvas($( toImage ), {
        onrendered: function(canvas) {
            theCanvas = canvas;
            document.body.appendChild(canvas);

            canvas.toBlob(function(blob) {
                saveAs(blob, "codizer-data.png");
            }, "image/png");

            document.body.removeChild(canvas);
        }
    });
}