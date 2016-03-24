/** Created by Ortiz on 13/07/15. */

/**
 * Asignar tamaños a los contenedores
 */
function resizeContiainers() {
    $('#content-body-ui').css('height', $( window ).height() - 55);
    $('#article-content').css('height', $( window ).height() - 114);
    $('.left-content-list').css('height', $( window ).height() - 102);
    $('.right-content-list').css('height', $( window ).height() - 102);
}

(function($){

    var App = { init: function() {
        App.HideShowMain();
        App.SetSizeLists();
    },
        HideShowMain: function() {
            $('#hide-show-main').click(function() {
                $('#chat-icon-perfil, #more-icon-perfil').toggle();
                $('#main').toggleClass('decrementarAnimation');
                $('#content-body-ui').toggleClass('hideShowContent');
            });
        },

        SetSizeLists: function() {

            var intervaloId;
            $(window).resize(function(){
                clearTimeout(intervaloId);
                intervaloId = setTimeout(function(){
                    resizeContiainers();
                }, 300);
            });

        }
    };

    $(function(){
        App.init();
        $(window).resize();
        resizeContiainers();
    });

})(jQuery);