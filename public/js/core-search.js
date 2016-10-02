/** Created by Ortiz on 13/07/15. */

(function($){

    var App = { init: function() {
        App.ShowSearchUI();
        App.HideSearchUI();
        App.DoHightSuggestionsUI();
        App.SearchUI();
    },
        ShowSearchUI: function() {
            $('#call-seach').click( function(e) {
                e.preventDefault();
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
                var tableItemsSuggestions = $('#container-product-suggestions');
                var tableStoresSuggestions = $('#container-store-suggestions');

                $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'JSON',
                    data: datos,
                    // async: false,

                    success: function( result ) {

                        $users = result['users'];
                        $items = result['items'];
                        $stores = result['stores'];

                        tablaUserSuggestions.empty();
                        tableItemsSuggestions.empty();
                        tableStoresSuggestions.empty();

                        // Add users
                        $($users).each(function(key, value) {
                            var urlUser = result.url + '/perfil/' + value.perfil_route;
                            tablaUserSuggestions.append('<div class="suggestion"> <a href="' + urlUser + '"> <img src="' + result.urlImgUser + value.foto +'" /> <div> <h4>' + value.nombre + ' ' + value.ap_paterno + ' ' + value.ap_materno + '</h4> <h5>' + value.profesion + '</h5> </div> </a> <a href="' + urlUser + '" class="btn-suggestions-go">Ver</a> </div>');
                        });

                        if (txtSearch.val() == "" || $users.length == 0)
                            tablaUserSuggestions.html('<h5>No results</h5>');

                        // Add items
                        $($items).each( function(key, value) {
                            var urlItem = result.url + '/tienda/' + value.store_route + '/producto/'+ value.producto_id +'/'+ value.slug;
                            tableItemsSuggestions.append('<div class="suggestion"><a href="' + urlItem +'" target="_blank"><img src="'+ result.urlImgItem + value.img +'" /><div><h4>' + value.product_name + '</h4><h5>'+ value.nombre +' - <span>$'+ value.precio + ' ' + value.tipo_oferta + ' ' + value.regla_porciento + '%</span></h5></div></a><a href="' + urlItem + '" target="_blank" class="btn-suggestions-go">Ver</a></div>');
                        });

                        if (txtSearch.val() == "" || $items.length == 0)
                            tableItemsSuggestions.html('<h5>No results</h5>');

                        // Add stores
                        $($stores).each( function(key, value) {
                            var urlStore = result.url + '/tienda/' + value.store_route;
                            tableStoresSuggestions.append('<div class="suggestion"> <a href="' + urlStore +'" target="_blank"> <img src="' + result.urlImgStore + value.foto + '" /> <div> <h4>' + value.nombre + '</h4> <h5>Official Store</h5> </div> </a> <a href="' + urlStore + '" target="_blank" class="btn-suggestions-go">Ver</a> </div>');
                        });

                        if (txtSearch.val() == "" || $stores.length == 0)
                            tableStoresSuggestions.html('<h5>No results</h5>');

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
