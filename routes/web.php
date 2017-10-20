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
    Route::post('imagesListByCat', 'imagesController@imagesListByCat');
    Route::post('productsList', 'productsController@productsList');
    Route::post('sliderProdDestacados', 'productsController@sliderProdDestacados');
    Route::post('sliderList', 'productsController@sliderList');
    Route::post('prodDetails', 'productsController@prodDetails');
    // Ciudades
    Route::post('getCiudades', 'locationController@getCiudades');
    Route::post('getProvincias', 'locationController@getProvincias');
    Route::post('registrar', 'userController@registrar');
    Route::post('activar', 'userController@activar');
    Route::post('bancosList', 'bancosController@bancosList');
	Route::group(['middleware' => ['auth.galeria']], function ()
    {
	    Route::post('uploadFiles', 'imagesController@uploadFiles');
	    Route::post('deleteImg', 'imagesController@deleteImg');
	    Route::post('salir', 'userController@salir');
	    Route::post('checkSession', 'userController@checkSession');
	    // Productos
	    Route::post('addProduct', 'productsController@addProduct');
	    Route::post('updateProd', 'productsController@updateProduct');
	    Route::post('addImgProduct', 'productsController@addImgProduct');
	    Route::post('deleteProd', 'productsController@deleteProd');
	    // Colores
	    Route::post('colorList', 'colorController@colorList');
	    Route::post('addColor', 'colorController@addColor');
	    Route::post('deleteColor', 'colorController@deleteColor');
	    // Pedidos
	    Route::post('pedidosList', 'pedidosController@pedidosList');
	    Route::post('addPedido' ,'pedidosController@addPedido');
	    Route::post('deletePedido' ,'pedidosController@deletePedido');
	    Route::post('pedidoDetails' ,'pedidosController@pedidoDetails');
	    Route::post('procesPedido' ,'pedidosController@procesPedido');
	    Route::post('pedidosListCliente' ,'pedidosController@pedidosListCliente');
	    Route::post('uploadComprobante' ,'pedidosController@uploadComprobante');
	    // Tallas
	    Route::post('addTalla', 'tallasController@addTalla');
	    Route::post('tallasList', 'tallasController@tallasList');
	    // Bancos
	    Route::post('addBanco', 'bancosController@addBanco');
	    Route::post('updateBanco', 'bancosController@updateBanco');
	    Route::post('deleteBanco', 'bancosController@deleteBanco');
	    // Categorias
	    Route::post('categoriasList', 'categoriasController@categoriasList');
		Route::post('addCategoria', 'categoriasController@addCategoria');
		Route::post('updateCategoria', 'categoriasController@updateCategoria');
		Route::post('deleteCategoria', 'categoriasController@deleteCategoria');

    });

});

