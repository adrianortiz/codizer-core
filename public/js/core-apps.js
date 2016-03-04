/** Created by Ortiz on 04/03/16. */

var appsControl = 0;
var nameApp;
function showModalAppsUI() {
    $('.core-apps-background-a').fadeIn(300);
    $('.core-apps-container').fadeIn(300);
    $('#main-header-app').css('color', '#FFF');
    $('#main-header-app').css('background', '#7B52FB');
    nameApp = $('#main-header-app div').html();
    $('#main-header-app div').html("Aplicaciones <span class='fa fa-angle-down fa-lg' style='margin-top: 5px;'></span>");
    $('#main-header-app div span').addClass('fa-rotate-180');
    appsControl = 1;
}

function hideModalAppsUI() {
    $('.core-apps-background-a').fadeOut(300);
    $('.core-apps-container').fadeOut(300);
    $('#main-header-app').css('color', '#4A4A4A');
    $('#main-header-app').css('background', '#FAFAFA');
    $('#main-header-app div').html(nameApp);
    $('#main-header-app div span').removeClass('fa-rotate-180');
    appsControl = 0;
}

function logicModalAppUI() {
    if (appsControl == 0) { showModalAppsUI();
    } else { hideModalAppsUI(); }
}

(function($){

    var App = { init: function() {
        App.ShowHideAppsUI();
    },
        ShowHideAppsUI: function() {

            $('#main-header-app').click( function() {
                logicModalAppUI();
            });

            var ctrlDown = false;
            var ctrlKey = 17, vKey = 86, cKey = 67, escKey = 27, altkey = 18;

            // Indentificar Si la tecla control está precionada
            $(document).keydown(function(e)
            {
                if (e.keyCode == ctrlKey) ctrlDown = true;

            }).keyup(function(e)
            {
                if (e.keyCode == ctrlKey) ctrlDown = false;

            });

            $(document).keydown(function(e)
            {
                if (ctrlDown && (e.keyCode == altkey)){
                    logicModalAppUI();
                }

                if(event.which == escKey)
                    hideModalAppsUI();
            });
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });
})(jQuery);