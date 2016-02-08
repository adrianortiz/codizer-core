/**
 * Created by Ortiz on 21/07/15.
 */

$(function() {

    function slider() {
        $('#slider-mac-codizer').toggleClass('blurEfecto');
        $('#slider-os-codizer').toggleClass('blurEfecto');
        TweenMax.to("#slider-os-codizer, #slider-mac-codizer", 0.9, {x:"0%", ease:Back.easeOut});
    }

    $(function(){

        var appleDev = $('.device-apple');
        var androidDev = $('.device-android');
        var windowsDev = $('.device-windows');
        var fireFoxDev = $('.device-firefox');

        $('#slider-mac-codizer').addClass('blurEfecto');
        $("#btn-cambio-slider1").click(function(){
            TweenMax.to("#slider-mac-codizer", 0.6, {x:"-86%"});
            TweenMax.to("#slider-os-codizer", 0.6, {x:"86%", onComplete:slider });
        });


        $('#device-apple').click( function() {
            appleDev.show();
            androidDev.addClass('animated ' + 'bounceOutRight');
            windowsDev.addClass('animated ' + 'bounceOutRight');
            fireFoxDev.addClass('animated ' + 'bounceOutRight');

            appleDev.addClass('animated ' + 'bounceInDown');

            window.setTimeout( function(){
                appleDev.removeClass('animated ' + 'bounceInDown');

                androidDev.removeClass('animated ' + 'bounceOutRight');
                windowsDev.removeClass('animated ' + 'bounceOutRight');
                fireFoxDev.removeClass('animated ' + 'bounceOutRight');
                androidDev.hide();
                windowsDev.hide();
                fireFoxDev.hide();
            }, 900);
        });

        $('#device-android').click( function() {
            androidDev.show();
            appleDev.addClass('animated ' + 'bounceOutRight');
            windowsDev.addClass('animated ' + 'bounceOutRight');
            fireFoxDev.addClass('animated ' + 'bounceOutRight');

            androidDev.addClass('animated ' + 'bounceInDown');

            window.setTimeout( function(){
                androidDev.removeClass('animated ' + 'bounceInDown');

                appleDev.removeClass('animated ' + 'bounceOutRight');
                windowsDev.removeClass('animated ' + 'bounceOutRight');
                fireFoxDev.removeClass('animated ' + 'bounceOutRight');
                appleDev.hide();
                windowsDev.hide();
                fireFoxDev.hide();
            }, 900);
        });


        $('#device-windows').click( function() {
            windowsDev.show();
            appleDev.addClass('animated ' + 'bounceOutRight');
            androidDev.addClass('animated ' + 'bounceOutRight');
            fireFoxDev.addClass('animated ' + 'bounceOutRight');

            windowsDev.addClass('animated ' + 'bounceInDown');

            window.setTimeout( function(){
                windowsDev.removeClass('animated ' + 'bounceInDown');

                appleDev.removeClass('animated ' + 'bounceOutRight');
                androidDev.removeClass('animated ' + 'bounceOutRight');
                fireFoxDev.removeClass('animated ' + 'bounceOutRight');
                appleDev.hide();
                androidDev.hide();
                fireFoxDev.hide();
            }, 900);
        });

        $('#device-firefox').click( function() {
            fireFoxDev.show();
            appleDev.addClass('animated ' + 'bounceOutRight');
            androidDev.addClass('animated ' + 'bounceOutRight');
            windowsDev.addClass('animated ' + 'bounceOutRight');

            fireFoxDev.addClass('animated ' + 'bounceInDown');

            window.setTimeout( function(){
                fireFoxDev.removeClass('animated ' + 'bounceInDown');

                appleDev.removeClass('animated ' + 'bounceOutRight');
                androidDev.removeClass('animated ' + 'bounceOutRight');
                windowsDev.removeClass('animated ' + 'bounceOutRight');
                appleDev.hide();
                androidDev.hide();
                windowsDev.hide();
            }, 900);
        });

    });

});
