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

Route::get('/', function() {
    // return view('auth.login');
    return view('welcome');
});

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


/*
 * PRUEBA: Indentificar si un usuario esta conectado
 * Grupos de rutas de laravel
 * app/Http/Kernel.php
 */

Route::group(['middleware' => 'auth'], function () {

    // Para acceder tengo que tener el role "core"
    Route::group(['middleware' => 'role'], function () {

        /**
         *  ==== Social - Perfil =====
         */
        Route::get('perfil/{nameFirstName}/', [
            'uses'  => 'Admin\Social\PerfilController@index',
            'as'    => 'perfil'
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


        /*
         * Contacts - Agenda
         */
        Route::get('perfil/{nameFirstName}/contacts', [
            'uses'  => 'Admin\Contacts\ContactsController@index',
            'as'    => 'contacts'
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

        // Search note
        Route::get('perfil/{nameFirstName}/notes/search', [
            'uses'  => 'Admin\Notes\NotesController@search',
            'as'    => 'notes.search'
        ]);

        /*
         * Events
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


        /*
         * ======= Productos ======
         * List products
         */
        Route::get('perfil/{nameFirstName}/products', [
            'uses'  => 'Admin\Products\ProductsController@index',
            'as'    => 'products'
        ]);



        /**
         * ========= EMPRESA ========
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

    });

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





