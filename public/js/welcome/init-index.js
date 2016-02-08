/** Created by Ortiz on 13/07/15. */

(function($){

    var App = { init: function() {
        App.Elementos_materialize();
        App.Elementos_animacion();
    },
        Elementos_animacion: function() {
            $('#tu-tienda-aqui-ahora').waypoint(function() {
                setTimeout(function(){$('.content_anim1').addClass('animated fadeInUp')},0);
                setTimeout(function(){$('.content_anim2').addClass('animated fadeInUp')},200);
            }, { offset: '50%' });

            $('#simple-eficiente').waypoint(function() {
                setTimeout(function(){$('.content_anim3').addClass('animated fadeInUp')},0);
                setTimeout(function(){$('.content_anim4').addClass('animated fadeInUp')},400);
            }, { offset: '50%' });

            $('#todo-genial-precio').waypoint(function() {
                setTimeout(function(){$('.content_anim5').addClass('animated fadeInUp')},0);
                setTimeout(function(){$('.content_anim6').addClass('animated fadeInUp')},200);
                setTimeout(function(){$('.content_anim7').addClass('animated fadeInUp')},400);
                setTimeout(function(){$('.content_anim8').addClass('animated fadeInUp')},400);
                setTimeout(function(){$('.content_anim9').addClass('animated fadeInUp')},600);
                setTimeout(function(){$('.content_anim10').addClass('animated fadeInUp')},800);
            }, { offset: '50%' });

            $('#increibles-disenos').waypoint(function () {
                setTimeout(function(){ $('.content_anim11').addClass('animated fadeInUp')}, 0);
                setTimeout(function(){ $('.content_anim12').addClass('animated fadeInUp')}, 200);
                setTimeout(function(){ $('.content_anim13').addClass('animated fadeInUp')}, 600);
                setTimeout(function(){ $('.content_anim14').addClass('animated fadeInUp')}, 800);
                setTimeout(function(){ $('.content_anim15').addClass('animated fadeInUp')}, 1000);
                setTimeout(function(){ $('.content_anim16').addClass('animated fadeInUp')}, 1200);
                setTimeout(function(){ $('.content_anim17').addClass('animated fadeInUp')}, 1400);
                setTimeout(function(){ $('.content_anim18').addClass('animated fadeInUp')}, 1600);
                setTimeout(function(){ $('.content_anim19').addClass('animated fadeInUp')}, 1800);
                setTimeout(function(){ $('.content_anim20').addClass('animated fadeInUp')}, 2000);
                setTimeout(function(){ $('.content_anim21').addClass('animated fadeInUp')}, 2200);
            }, {offset: '50%'});

            $('#contacto-y-comparte').waypoint(function() {
                setTimeout(function(){$('.content_anim22').addClass('animated fadeInUp')},0);
                setTimeout(function(){$('.content_anim23').addClass('animated fadeInUp')},200);
                setTimeout(function(){$('.content_anim24').addClass('animated fadeInUp')},400);
            }, { offset: '50%' });
        },

        Elementos_materialize: function() {
            $('.button-collapse').sideNav();
            $('.parallax').parallax();
            $('ul.tabs').tabs();
            $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrain_width: false, // Does not change width of dropdown to that of the activator
                    hover: true, // Activate on hover
                    gutter: 0, // Spacing from edge
                    belowOrigin: false, // Displays dropdown below the button
                    alignment: 'left'
                }
            );
        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);