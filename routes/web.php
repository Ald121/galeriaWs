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
    Route::post('registrar', 'userController@registrar');
    Route::post('activar', 'userController@activar');
    Route::post('uploadFiles', 'imagesController@uploadFiles');
    Route::post('imagesList', 'imagesController@imagesList');
});

