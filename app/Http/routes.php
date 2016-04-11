<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
 * Ruta que captura la petición de lenguaje
 * para  asignar el idioma en la sesión
 */
Route::get('lang/{lang}', function($lang) {
    session(['lang' => $lang]);
    return \Redirect::back();
})->where([
    'lang' => 'en|es'
]);

Route::get('/', [
    'uses'  => 'IndexController@index',
    'as'    => 'index.view.page'
]);

// Authentication routes...
Route::get('login', [
    'uses'  => 'Auth\AuthController@getLogin',
    'as'    => 'login'
]);

Route::post('login', 'Auth\AuthController@postLogin');

Route::get('logout', [
    'uses'  => 'Auth\AuthController@getLogout',
    'as'    => 'logout'
]);

// Registration routes...
Route::get('register', [
    'uses'  => 'Auth\AuthController@getRegister',
    'as'    => 'register'
]);
Route::post('register', 'Auth\AuthController@postRegister');


/*
 *
 */
// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


/**
 * Vista index de las tiendas dadas de alta en Core
 * No se requiere que el usuario este logueado para poder ver
 * y navegar en los productos
 */

// Index de una tienda
Route::get('tienda/{tiendaRoute}/', [
    'uses'  => 'Admin\Tienda\TiendaController@verTienda',
    'as'    => 'store.front'
]);

// Información de la tienda
Route::get('tienda/{tiendaRoute}/info', [
    'uses'  => 'Admin\Tienda\TiendaController@verTiendaInfo',
    'as'    => 'store.front.info'
]);

// Mostrar un producto
Route::get('tienda/{tiendaRoute}/producto/{idProduct}/{slug}', [
    'uses'  => 'Admin\Tienda\TiendaController@verProductoInfo',
    'as'    => 'store.front.product.show'
]);

// Mostrar un producto AJAX
Route::get('tienda/product/show', [
    'uses'  => 'Admin\Tienda\TiendaController@verProductoInfoAjax',
    'as'    => 'store.front.product.show.ajax'
]);



/// ========= CART SESSION ========

// Mostrar carrito de una session
Route::get('tienda/{tiendaRoute}/cart/show', [
    // 'middleware' => 'auth',
   'uses'   => 'Admin\Cart\CartController@show',
    'as'    => 'store.front.product.orden.show'
]);

// Agregar al carrito
Route::get('tienda/product/orden/store', [
    'uses'  => 'Admin\Cart\CartController@add',
    'as'    => 'store.front.product.orden.store'
]);

// Update item from cart
Route::put('tienda/product/orden/update', [
    'uses'  => 'Admin\Cart\CartController@update',
    'as'    => 'store.front.product.orden.update'
]);

Route::delete('tienda/product/orden/delete', [
    'uses'  => 'Admin\Cart\CartController@delete',
    'as'    => 'store.front.product.orden.delete'
]);

// Eliminar carrito
Route::delete('tienda/cart/trash', [
    'uses'   => 'Admin\Cart\CartController@trash',
    'as'    => 'store.front.product.orden.trash'
]);


/// ========= ORDER DETAIL =========
Route::get('tienda/{tiendaRoute}/cart/order', [
    'middleware' => 'auth',
    'uses'   => 'Admin\Cart\CartController@orderDetail',
    'as'    => 'store.front.product.orden.detail'
]);


/*
 * Indentificar si un usuario esta conectado
 * Grupos de rutas de laravel
 * app/Http/Kernel.php
 */
Route::group(['middleware' => 'auth'], function () {

    // Para acceder tengo que tener el role "core"
    Route::group(['middleware' => 'role'], function () {
        // ---
    });


    /**
     * PAYPAL ROUTES API
     */

    // Enviamos nuestro pedido a Paypal
    Route::get('payment/{tiendaRoute}', [
       'uses'   => 'PaypalController@postPayment',
        'as'    => 'payment'
    ]);

    // Paypal redirecciona a esta ruta
    Route::get('payment/status', [
        'uses'  => 'PaypalController@getPaymentStatus',
        'as'    => 'payment.status'
    ]);




        /**
         *  ==== Social - Perfil =====
         */
        Route::get('perfil/{nameFirstName}/', [
            'uses'  => 'Admin\Social\PerfilController@index',
            'as'    => 'perfil'
        ]);

    Route::get('perfil/{nameFirstName}/info', [
        'uses'  => 'Admin\Information\InformationController@index',
        'as'    => 'perfil.info'
    ]);

        // Update cover perfil
        Route::post('perfil/{nameFirstName}/cover/update', [
            'uses'  => 'Admin\Social\CoverController@store',
            'as'    => 'cover.store'
        ]);

        // Update photo user perfil
        Route::post('perfil/{nameFirstName}/photo/user/update', [
           'uses'   => 'Admin\Social\PerfilController@updatePhotoUser',
            'as'    => 'contact.photo.store'
        ]);

        // Add or delete user to my friends
        Route::get('perfil/to/friend', [
           'uses'   => 'Admin\Social\PerfilController@addOrNotAddToFriend',
            'as'    => 'contacto.to.friend'
        ]);

        // Add user to my followers
        Route::get('perfil/to/follower', [
           'uses'   => 'Admin\Social\PerfilController@addOrNotAddToFollower',
            'as'    => 'contacto.to.follower'
        ]);


        /**
         * Contacts - Agenda
         */
        Route::get('perfil/{nameFirstName}/contacts', [
            'uses'  => 'Admin\Contacts\ContactsController@index',
            'as'    => 'contacts'
        ]);

        /**
         * User Friends
         */
        Route::get('perfil/{nameFirstName}/friends',[
            'uses'  => 'Admin\Contacts\FriendsController@index',
            'as'    => 'friends'
        ]);

        /**
         * User Followers
         */
        Route::get('perfil/{nameFirstName}/followers',[
            'uses'  => 'Admin\Contacts\FollowersController@index',
            'as'    => 'followers'
        ]);

        /*
         * ====== Contactos =======
         */

        // Create Contact
        Route::post('perfil/{nameFirstName}/contacts/create', [
            'uses'  => 'Admin\Contacts\ContactsController@store',
            'as'    => 'contact.create'
        ]);

        // Get Contact
        Route::get('perfil/{nameFirstName}/contacts/show', [
            'uses'  => 'Admin\Contacts\ContactsController@show',
            'as'    => 'contact.show'
        ]);

        // Update Contact
        Route::post('perfil/{nameFirstName}/contacts/update', [
            'uses'  => 'Admin\Contacts\ContactsController@update',
            'as'    =>  'contact.update'
        ]);

        // Delete Contact
        Route::delete('perfil/{nameFirstName}/contacts/delete', [
            'uses'   => 'Admin\Contacts\ContactsController@destroy',
            'as'    => 'contact.delete'
        ]);


        /*
         * ======= Notes ======
         * List notes
         */
        Route::get('perfil/{nameFirstName}/notes', [
            'uses'  => 'Admin\Notes\NotesController@index',
            'as'    => 'notes'
        ]);

        // Store note
        Route::post('perfil/{nameFirstName}/notes/store', [
            'uses'  => 'Admin\Notes\NotesController@store',
            'as'    => 'notes.store'
        ]);

        // Get note
        Route::get('perfil/{nameFirstName}/notes/show', [
            'uses'  => 'Admin\Notes\NotesController@show',
            'as'    => 'notes.show'
        ]);

        // Update note
        Route::put('perfil/{nameFirstName}/notes/show', [
            'uses'  => 'Admin\Notes\NotesController@update',
            'as'    =>  'notes.update'
        ]);

        // Delete note
        Route::delete('perfil/note/delete', [
           'uses'   => 'Admin\Notes\NotesController@destroy',
            'as'    => 'notes.delete'
        ]);


        /*
         * === Search note ====
         */
        Route::get('perfil/{nameFirstName}/notes/search', [
            'uses'  => 'Admin\Notes\NotesController@search',
            'as'    => 'notes.search'
        ]);


        /*
         * === Events ====
         */
        Route::get('perfil/{nameFirstName}/events', [
            'uses'  => 'Admin\Events\EventsController@index',
            'as'    => 'events'
        ]);


        /**
         * === Busquedas ====
         */
        Route::get('search-global/', [
            'uses'  => 'Admin\Search\SearchController@searchGlobal',
            'as'    => 'core.searchGlobal'
        ]);


        // ========   SECCION EMPLEADO   ==========

        Route::get('perfil/{nameFirstName}/empleado/tiendas', [
            'uses'  => 'Admin\Employee\EmployeeController@listEmployeeByUser',
            'as'    => 'empleado.tienda.index'
        ]);

        /*
         * ======= EMPLEADO PRODUCTOS ======
         */

        // LIST PRODUCTS
        Route::get('perfil/{nameFirstName}/tienda/{idEmpresa}/{idTienda}/products', [
            'uses'  => 'Admin\Products\ProductsController@index',
            'as'    => 'empleado.products.index'
        ]);


        Route::post('perfil/{nameFirstName}/products/store', [
            'uses'  => 'Admin\Products\ProductsController@store',
            'as'    => 'products.store'
        ]);

        // Get product
        Route::get('perfil/{nameFirstName}/products/show', [
        'uses'  => 'Admin\Products\ProductsController@show',
        'as'    => 'products.show'
        ]);

        // UPDATE product
        Route::post('admin/{nameFirstName}/products/update', [
        'uses'   => 'Admin\Products\ProductsController@update',
        'as'    => 'products.update'
    ]);


        /**
         * ========= COMPANY ========
         */

        // SHOW FORM TO CREATE COMPANY OR GET DATA OF COMPANY
        Route::get('admin/{nameFirstName}/companies', [
            'uses'   => 'Admin\Company\CompanyController@index',
            'as'    => 'companies.index'
        ]);

        // CREATE COMPANY
        Route::post('admin/{nameFirstName}/companies/store', [
            'uses'   => 'Admin\Company\CompanyController@store',
            'as'    => 'companies.store'
        ]);

        // SHOW COMPANY
        Route::get('admin/{nameFirstName}/companies/show', [
            'uses'   => 'Admin\Company\CompanyController@show',
            'as'    => 'companies.show'
        ]);

        // UPDATE COMPANY
        Route::post('admin/{nameFirstName}/companies/update', [
            'uses'   => 'Admin\Company\CompanyController@update',
            'as'    => 'companies.update'
        ]);


        /**
         * ========= TIENDAS ========
         */

        // SHOW ALL TIENDAS
        Route::get('admin/{nameFirstName}/stores', [
           'uses'   => 'Admin\Tienda\TiendaController@index',
            'as'    => 'stores.index'
        ]);

        // CREATE TIENDA
        Route::post('admin/{nameFirstName}/stores/store', [
            'uses'  => 'Admin\Tienda\TiendaController@store',
            'as'    => 'stores.store'
        ]);

        // GET TIENDA
        Route::get('admin/{nameFirstName}/stores/show', [
            'uses'  => 'Admin\Tienda\TiendaController@show',
            'as'    => 'stores.show'
        ]);

        // UPDATE TIENDA
        Route::post('admin/{nameFirstName}/stores/update', [
            'uses'  => 'Admin\Tienda\TiendaController@update',
            'as'    => 'stores.update'
        ]);





        /**
         * ========= EMPLEADOS ========
         */

        // SHOW ALL EMPLEADOS
        Route::get('admin/{nameFirstName}/employee', [
            'uses'   => 'Admin\Employee\EmployeeController@index',
            'as'    => 'employee.index'
        ]);

        // NEW EMPLEADO
        Route::post('admin/{nameFirstName}/employee/store', [
            'uses'   => 'Admin\Employee\EmployeeController@store',
            'as'    => 'employee.store'
        ]);

        // GET EMPLEADO
        Route::get('admin/{nameFirstName}/employee/show', [
            'uses'  => 'Admin\Employee\EmployeeController@show',
            'as'    => 'employee.show'
        ]);

        // update
        Route::put('admin/{nameFirstName}/employee/update', [
            'uses'  => 'Admin\Employee\EmployeeController@update',
            'as'    => 'employee.update'
        ]);




        /**
         * ========= EXTRAS - Categorias, Ofertas y Fabricantes ========
         */

        Route::get('admin/{nameFirstName}/extras', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@index',
            'as'    => 'extras.index'
        ]);

        ///
        // CREATE OFERTA
        Route::post('admin/{nameFirstName}/extras/oferta/store', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@storeOferta',
            'as'    => 'oferta.store'
        ]);

        // GET OFERTA
        Route::get('admin/{nameFirstName}/extras/oferta/show', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@showOferta',
            'as'    => 'oferta.show'
        ]);

        // UPDATE OFERTA
        Route::put('admin/{nameFirstName}/extras/oferta/update', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@updateOferta',
            'as'    => 'oferta.update'
        ]);


        ///
        // CREATE FABRICA
        Route::post('admin/{nameFirstName}/extras/fabrica/store', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@storeFabrica',
            'as'    => 'fabrica.store'
        ]);

        // GET FABRICA
        Route::get('admin/{nameFirstName}/extras/fabrica/show', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@showFabrica',
            'as'    => 'fabrica.show'
        ]);

        // UPDATE FABRICA
        Route::put('admin/{nameFirstName}/extras/fabrica/update', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@updateFabrica',
            'as'    => 'fabrica.update'
        ]);



        ///
        // CREATE CATEGORIA
        Route::post('admin/{nameFirstName}/extras/categoria/store', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@storeCategoria',
            'as'    => 'categoria.store'
        ]);

        // GET CATEGORIA
        Route::get('admin/{nameFirstName}/extras/categoria/show', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@showCategoria',
            'as'    => 'categoria.show'
        ]);

        // UPDATE CATEGORIA
        Route::put('admin/{nameFirstName}/extras/categoria/update', [
            'uses'  => 'Admin\OptionsExtra\OptionExtraController@updateCategoria',
            'as'    => 'categoria.update'
        ]);


    /*
     * ADMIN
     */
    Route::get('admin', [
        'uses'  => 'AdminController@index',
        'as'    => 'panel'
    ]);

    Route::get('admin/{id}/editar', [
        'uses' => 'AdminController@edit',
        'as' => 'admin.edit'
    ]);

    Route::put('admin/{id}/update', [
        'uses' => 'AdminController@update',
        'as' => 'admin.update'
    ]);


    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        Route::resource('colecciones', 'FormsController');
        Route::resource('complements', 'ComplementsController');
        Route::resource('inputs', 'InputsController');

        // DIBUJAR FORMULARIO
        Route::get('coleccion/{id}/form', [
            'uses'  => 'InputsController@drawForm',
            'as'    => 'form'
        ]);

        // SAVE FORMULARIO
        Route::get('coleccion/form/{id}/new', [
            'uses'  => 'DvarcharController@storeFormData',
            'as'    => 'admin.colecciones.form.data.store'
        ]);

        // SHOW DATA FROM COLLECTION
        Route::get('coleccion/form/{id}/lista', [
            'uses'  => 'DvarcharController@index',
            'as'    => 'admin.colecciones.form.data.index'
        ]);

        // DESTROY ROW DATA
        Route::delete('coleccion/form/lista/row/{id}/delete', [
            'uses'  => 'DvarcharController@destroy',
            'as'    => 'admin.colecciones.form.data.list.destroy'
        ]);

        // SAVE FORMULARIO
        Route::put('coleccion/form/lista/row/{id}/update', [
            'uses'  => 'DvarcharController@update',
            'as'    => 'admin.colecciones.form.data.list.update.input'
        ]);


        /*
         * STATISTIC CONTROLLER
         */

        // VIEW STATISTICS
        Route::get('estadisticas', [
            'uses'  => 'StatisticController@index',
            'as'    => 'admin.statistics.index'
        ]);

        Route::post('estadisticas/colums', [
            'uses'  => 'StatisticController@showColums',
            'as'    => 'admin.statistics.index.columns'
        ]);

        Route::post('estadisticas/colums/data', [
            'uses'  => 'StatisticController@getDataColumns',
            'as'    => 'admin.statistics.index.columns.data'
        ]);

        Route::get('estadisticas/dispersion/puntos/data', [
           'uses'   => 'StatisticController@getPoints' ,
            'as'    => 'statistics.dispersion.puntos.data'
        ]);



        /*
         * EXCEL
         */

        Route::get('export-all', [
            'uses'  => 'ExcelController@exportAll',
            'as'    => 'admin.export.all'
        ]);

        Route::post('{id}/import-all', [
            'uses'  => 'ExcelController@importAllToCollection',
            'as'    => 'admin.import.all'
        ]);

    });


});





