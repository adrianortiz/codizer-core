/**
 * Created by Codizer on 11/23/15.
 */

/*
 * GRAFICAR POR VARIABLE
 */

function byVar(res, graphDiv, colorA, colorB) {

    var barChartData = {
        // labels : ["January","February","March","April","May","June","July"],
        labels : res[0][0]['categories'],
        label: "Datos acumulados por variable",

        datasets : [
            {
                fillColor : colorB,
                strokeColor : colorB,
                highlightFill : colorB,
                highlightStroke : colorB,
                data : res[0][2]['data']
            }
        ]

    };

    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60,
    });

    $('#graphB' + graphDiv).click(
        function(evt){

            var activeBars = myBarChart.getBarsAtEvent(evt);

            activeBars.forEach(function(dato) {
                // console.log(dato);
            });


        }
    );
}


/*
 * GRAFICAR POR VARIABLE
 */

function byAutoInterval(res, graphDiv, colorA, colorB) {
    var barChartData = {
        labels : res[0][4], // X
        label: "Histograma",
        datasets : [
            {
                fillColor : colorB,
                strokeColor : colorB,
                highlightFill : colorB,
                highlightStroke : colorB,
                data : res[0][5]
            }
        ]
    };
    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Bar(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60
    });

    $('#graphB' + graphDiv).click(
        function(evt){

            var activeBars = myBarChart.getBarsAtEvent(evt);

            activeBars.forEach(function(dato) {
                // console.log(dato);
            });
        }
    );
}


/*
 * GRAFICAR POR OJIVA
 */

function byAutoIntervalOji(res, graphDiv, colorA, colorB) {
    var barChartData = {
        labels : res[0][4], // X
        label: "Ojiva 1",
        datasets : [
            {
                label: "Datos de Ojiva",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: "#FFFFFF",
                pointStrokeColor: "#6365DB",
                pointHighlightFill: "#6365DB",
                pointHighlightStroke: "#6365DB",
                data : res[0][6]
            }
        ]
    };
    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");
    var myBarChart = new Chart(ctx).Line(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60,
        bezierCurve: false,
        pointDotStrokeWidth : 2,
        datasetFill : false,
    });

    $('#graphB' + graphDiv).click(
        function(evt){
            var activeBars = myBarChart.getPointsAtEvent(evt);
            activeBars.forEach(function(dato) {
                // console.log(dato);
            });
        }
    );
}


/*
 GRÁFICA POR DISPERSIÓN
 */

function byAutoIntervalDisp(res, graphDiv, colorA, colorB) {

    console.log( res );

    var barChartData = {
        labels : res[0][4], // X
        label: "OJIVA 2",
        datasets : [
            {
                label: "Intervalo automatico por dispersion",
                fillColor: "rgba(220,220,220,0)",
                strokeColor: "#E5E5E5",
                pointColor: "#FFFFFF",
                pointStrokeColor: "#494949",
                pointHighlightFill: "#494949",
                pointHighlightStroke: "#494949",
                data : res[0][8]
            }
        ]
    };

    var ctx = document.getElementById('graphB' + graphDiv ).getContext("2d");

    var myLiveChart = new Chart(ctx).Line(barChartData, {
        responsive : true,
        animateScale: true,
        animationSteps: 60,
        bezierCurve: false,
        pointDotStrokeWidth : 2,
        datasetFill : false,
        // multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
    });


    $('#graphB' + graphDiv).click(
        function(evt){
            var activeBars = myLiveChart.getPointsAtEvent(evt);

            contador = 0;
            activeBars.forEach(function(dato) {

                if( $('#radio1' + graphDiv).prop('checked') && contador == 0) {
                    $('#radio1' + graphDiv).val(dato.value);
                    $('#radio3' + graphDiv).val(dato.label);
                    $('#span1' + graphDiv).text(dato.value);
                }

                if( $('#radio2' + graphDiv).prop('checked') && contador == 0) {
                    $('#radio2' + graphDiv).val(dato.value);
                    $('#radio4' + graphDiv).val(dato.label);
                    $('#span2' + graphDiv).text(dato.value);
                }

                contador++;

            });
        }
    );

    return myLiveChart;
}



/*
    VALIDAR DATOS DE PUNTOS SELECTO AL FOMULARIO
    VALIDAR PARA ENVIAR
 */
function getDataPuntos(graphDiv)
{
    $('#punto1X').val( $('#radio1' + graphDiv).val() );
    $('#punto1Y').val( $('#radio3' + graphDiv).val() );
    $('#punto2X').val( $('#radio2' + graphDiv).val() );
    $('#punto2Y').val( $('#radio4' + graphDiv).val() );

    if( $('#radio1' + graphDiv).val() == null || $('#radio1' + graphDiv).val() == ''
        || $('#radio2' + graphDiv).val() == null || $('#radio2' + graphDiv).val() == ''
        || $('#radio3' + graphDiv).val() == null || $('#radio3' + graphDiv).val() == ''
        || $('#radio4' + graphDiv).val() == null || $('#radio4' + graphDiv).val() == '')
    {

        $('#msj-danger-state').empty();
        hideShowAlert('msj-danger', 'Por favor selecciona los dos puntos.');

    } else {
        addDataPointSelected(graphDiv);
    }
}



function addDataPointSelected(graphDiv)
{
    var datos = $("#form-points-data").serializeArray();
    var route = $("#form-points-data").attr('action');

    $.ajax({
        url: route,
        type: 'GET',
        dataType: 'json',
        // async: false,
        data: datos,

        success: function (result)
        {

            var punto1X = result[0]['Punto 1']['X'] ;
            var punto1Y = result[0]['Punto 1']['Y'] ;

            var punto2X = result[0]['Punto 2']['X'] ;
            var punto2Y = result[0]['Punto 2']['Y'] ;

            console.log("Cantidad de DataSets");
            console.log(char[graphDiv].datasets.length);

            /*
             var dataChart = char[graphDiv].datasets.length;

             for (var i = 1; i < dataChart; i++ ) {
                char[graphDiv].datasets[i].points.forEach(function (value, i) {
                    console.log(value);
                    char[graphDiv].removeData();
                });
            }

            for (var i = 0; i < 1; i++ ) {
                console.log(i);
                char[graphDiv].removeData();
            }


            char[graphDiv].datasets[1].points.forEach(function (value, i) {
                console.log(value + " " + i);
                // char[graphDiv].removeData();
            });*/

            var puntos = [];

            char[graphDiv].datasets[0].points.forEach(function (valueChar, iChar) {

                    if(char[graphDiv].datasets[0].points[iChar].label == punto1X ) {

                        puntos.push(new char[graphDiv].PointClass({
                            value: punto1Y,
                            label: char[graphDiv].datasets[0].points[iChar].label,
                            x: char[graphDiv].scale.calculateX(char[graphDiv].datasets.length + 1, char[graphDiv].datasets.length, iChar),
                            y: char[graphDiv].scale.endPoint
                        }))

                    } else if( char[graphDiv].datasets[0].points[iChar].label == punto2X ) {

                        puntos.push(new char[graphDiv].PointClass({
                            value: punto2Y,
                            label: char[graphDiv].datasets[0].points[iChar].label,
                            x: char[graphDiv].scale.calculateX(char[graphDiv].datasets.length + 1, char[graphDiv].datasets.length, iChar),
                            y: char[graphDiv].scale.endPoint
                        }))

                    } else {

                        puntos.push(new char[graphDiv].PointClass({
                            value: null,
                            label: char[graphDiv].datasets[0].points[iChar].label,
                            x: char[graphDiv].scale.calculateX(char[graphDiv].datasets.length + 1, char[graphDiv].datasets.length, iChar),
                            y: char[graphDiv].scale.endPoint
                        }))
                    }
            });


            char[graphDiv].datasets.push({
                label: [punto1X, punto2X],
                points: puntos,
                strokeColor: "#9688FC",
                pointColor: "#9688FC",
                pointStrokeColor: "#9688FC",
                pointHighlightFill: "#9688FC",
                pointHighlightStroke: "#9688FC"
            });

            char[graphDiv].update();

        }

    }).fail(function( jqXHR, textStatus ) {

        alert('Error al enviar ' + textStatus);

    });

}


/*
 ADD DATA MIN QUA
 */
function addDataMinCuadrado( graphDiv )
{

    var labels = resX[graphDiv][0][4];
    var medDis = resX[graphDiv][0][8];
    var minCua = resX[graphDiv][0][9];


    var myNewDataset = {
        data : resX[graphDiv][0][9]
    };

    var puntos = [];

    myNewDataset.data.forEach(function (value, i) {
        puntos.push(new char[graphDiv].PointClass({
            value: value,
            label: char[graphDiv].datasets[0].points[i].label,
            x: char[graphDiv].scale.calculateX(char[graphDiv].datasets.length + 1, char[graphDiv].datasets.length, i),
            y: char[graphDiv].scale.endPoint,
            pointColor: "#E5E5E5"
        }))
    });

    char[graphDiv].datasets.push({
        label: "Minimos cuadrados",
        strokeColor: "#E5863D",
        pointColor: "#E5863D",
        pointStrokeColor: "#E5863D",
        pointHighlightFill: "#E5863D",
        pointHighlightStroke: "#E5863D",
        points: puntos
    });

    char[graphDiv].update();

}