/**
 * Created by Codizer on 3/27/16.
 */

(function($) {

    var App = {
        init: function () {
            App.changeImageModal();

        },

        changeImageModal: function() {

            $('.sub-image-product').click( function() {

                $('#principal-image-product').attr('src', $(this).attr('src') );
                $('.sub-image-product').removeClass('principal-image-product');
                $(this).addClass('principal-image-product');

            });

        }

        };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);