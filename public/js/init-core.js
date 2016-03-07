/** Created by Ortiz on 13/07/15. */
$('.left-content-list').css('height', 400);
$('.right-content-list').css('height', 400);

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
            /* for (var i = 0; i<100; i++) {
                $('#article-content').append('<h3>Contenido: ' + i +'</h3>');
                $('#main-header-options-app ul').append('<li><a href="#!">Opction '+ i +'</a></li>');
            } */
        },

        SetSizeLists: function() {
            $( window ).resize(function() {
                // var articleContent = $('#article-content').width();
                // $('.left-content-list').css('width', articleContent / 3);
                $('.left-content-list').css('height', $( document ).height() - 98);
                $('#main-header-options-app').css('height', $( document ).height() - 290);

                // $('.right-content-list').css('width', (articleContent / 3) * 2);
                $('.right-content-list').css('height', $( document ).height() - 98);

                if ( $( document ).width() <= 1050) {
                    $('#main').addClass('hideShowMain');
                    $('#content').addClass('hideShowContent');
                    $('header').addClass('hideShowContent');
                    $('#main-header-info-app-perfil').addClass('hideShowMain');
                } else {
                    $('#main').removeClass('hideShowMain');
                    $('#content').removeClass('hideShowContent');
                    $('header').removeClass('hideShowContent');
                    $('#main-header-info-app-perfil').removeClass('hideShowMain');
                }
            });
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);