/** Created by Ortiz on 04/03/16. */

var appsControl = 0;
var nameApp;
function showModalAppsUI() {
    appsControl = 1;
    $('.core-apps-background-a').fadeIn(300);
    $('.core-apps-container').fadeIn(300);
    $('#main-header-app').css('background', '#7B52FB');
    nameApp = $('#name-app-select').html();
    $('#name-app-select').html("Aplicaciones");
    $('#apps-flecha span').removeClass('fa-rotate-180');

}

function hideModalAppsUI() {
    appsControl = 0;
    $('.core-apps-background-a').fadeOut(300);
    $('.core-apps-container').fadeOut(300);
    $('#main-header-app').css('background', '#1E74D0');
    $('#name-app-select').html(nameApp);
    $('#apps-flecha span').addClass('fa-rotate-180');

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
            var ctrlKey = 17, vKey = 86, cKey = 67, escKey = 27, altkey = 18, mKey = 77,
                bKey = 66;

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
                // Hide/Show Apps menu
                if (ctrlDown && (e.keyCode == altkey))
                    logicModalAppUI();

                // Hide left menu
                if (ctrlDown && (e.keyCode == mKey))
                    $('#hide-show-main').click();

                // Hide modal
                if(e.keyCode == escKey)
                    hideModalAppsUI();

                // Show search
                if (ctrlDown && (e.keyCode == bKey))
                    $('#call-seach').click();
            });
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });
})(jQuery);