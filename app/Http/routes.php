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

Route::get('/', function ()
{
    // Main site home page
    return view('pages.home');
});

Route::controllers([
    'auth' => 'Auth\AuthController'
]);

Route::group(['middleware' => 'auth'], function(){

    Route::get('/app', function ()
    {
        // App view - Angular from here on out
        return view('app');
    });

    Route::group(['prefix' => 'api/v1'], function(){

        Route::resource('lists', 'Api\ListsController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

        Route::resource('lists.items', 'Api\ItemsController', ['only' => ['index', 'store']]);
        Route::post('/lists/{list}/items/{item}/complete', 'Api\ItemsController@complete');
    });

});
