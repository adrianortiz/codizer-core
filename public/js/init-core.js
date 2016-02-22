/** Created by Ortiz on 13/07/15. */

function cambiosUI() {
    var articleContent = $('#article-content').width();
    // $('.left-content-list').css('width', articleContent / 3);
    $('.left-content-list').css('height', $( document ).height() - 81);

    // $('.right-content-list').css('width', (articleContent / 3) * 2);
    $('.right-content-list').css('height', $( document ).height() - 81);
}

(function($){

    var App = { init: function() {
        App.HideShowMain();
        App.AddContentFake();
        App.SetSizeLists();
    },
        HideShowMain: function() {

            $('#hide-show-main').click(function() {
                $('#main').toggleClass('hideShowMain');
                $('#content').toggleClass('hideShowContent');
                $('header').toggleClass('hideShowContent');
                $('#main-header-info-app-perfil').toggleClass('hideShowMain');
            });
        },

        AddContentFake: function() {
            // for (var i = 0; i<100; i++) {
                // $('#article-content').append('<h3>Contenido: ' + i +'</h3>');
                // $('#main-header-options-app ul').append('<li><a href="#!">Opction '+ i +'</a></li>');
            //}
        },

        SetSizeLists: function() {
            $( window ).resize(function() { cambiosUI(); });
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);