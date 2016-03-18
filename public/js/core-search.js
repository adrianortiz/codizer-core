/** Created by Ortiz on 13/07/15. */

(function($){

    var App = { init: function() {
        App.ShowSearchUI();
        App.HideSearchUI();
        App.DoHightSuggestionsUI();
        App.SearchUI();
    },
        ShowSearchUI: function() {
            $('#call-seach').click( function() {
                $('.core-search-container').fadeIn(300);
                $('.core-search').addClass('search-ui-in');
                $('.core-search-suggestions').addClass('search-result-ui-in');
                $('#btn-search-ui').focus();
            });
        },

        HideSearchUI: function() {
            $(document).keydown( function(event) {
                if(event.which==27)
                    hideModalSearch();
            });

            $('#btn-close-modal-search').click(hideModalSearch);
            function hideModalSearch() {
                $('.core-search-container').fadeOut(300);
                $('.core-search').removeClass('search-ui-in');
                $('.core-search-suggestions').removeClass('search-result-ui-in');
            }
        },

        DoHightSuggestionsUI : function() {
            var txtSearch = $('#btn-search-ui');
            var contSuggestions = $('.core-search-suggestions');

            txtSearch.keyup( function(){
                if (txtSearch.val() == "") {
                    contSuggestions.css('height', 322);
                } else {
                    contSuggestions.css('height', $( document ).height() - 81);
                }
            });
        },

        SearchUI: function() {
            var txtSearch = $('#btn-search-ui');
            var btnSearch = $('#btn-global-search');

            txtSearch.keyup( searchGlobalAjax );
            btnSearch.click( searchGlobalAjax );

            function searchGlobalAjax() {
                var datos = $('#form-global-search').serializeArray();
                var route = $('#form-global-search').attr('action');
                var tablaUserSuggestions = $('#container-user-suggestions');

                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'JSON',
                    data: datos,
                    // async: false,

                    success: function( result ) {
                        $users = result['users'];
                        tablaUserSuggestions.empty();
                        var count = 0;
                        $($users).each(function(key, value) {
                            count++;
                            tablaUserSuggestions.append('<div class="suggestion"> <a href="/perfil/' + value.perfil_route + '"> <img src="/media/photo-perfil/'+ value.foto +'" /> <div> <h4>' + value.nombre + ' ' + value.ap_paterno + ' ' + value.ap_materno + '</h4> <h5>' + value.profesion + '</h5> </div> </a> <a href="/perfil/' + value.perfil_route + '" class="btn-suggestions-go">Ver</a> </div>');
                        });

                        if (txtSearch.val() == "" || count == 0)
                            $('#container-user-suggestions').html('<h5>No results</h5>');
                    }

                }).fail(function(jqXHR, textStatus) {
                    /*
                    $('#msj-danger-state').empty();
                    $(jqXHR).each(function(key,error){
                        if ( !(error.responseJSON.title == null) )
                            hideShowAlert('msj-danger', error.responseJSON.title);

                        if ( !(error.responseJSON.description == null) )
                            hideShowAlert('msj-danger', error.responseJSON.description);
                    });

                    $('#msj-danger').fadeIn();
                    */
                }); // Ajax

            } // Methos searchGlobalAjax

        }
    };

    $(function(){
        App.init();
        $(window).resize();
    });

})(jQuery);