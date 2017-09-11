<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('email_registro');
});

Route::group(['middleware' => 'cors'], function(){
	Route::post('acceso', 'userController@login');
    Route::post('imagesList', 'imagesController@imagesList');
    Route::post('productsList', 'productsController@productsList');
	Route::group(['middleware' => ['auth.galeria']], function ()
    {
	    Route::post('registrar', 'userController@registrar');
	    Route::post('activar', 'userController@activar');
	    Route::post('uploadFiles', 'imagesController@uploadFiles');
	    Route::post('deleteImg', 'imagesController@deleteImg');
	    Route::post('salir', 'userController@salir');
	    Route::post('checkSession', 'userController@checkSession');
	    // Productos
	    Route::post('addProduct', 'productsController@addProduct');
	    Route::post('addImgProduct', 'productsController@addImgProduct');
    });
});

