<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

#LOGIN-------------------STESSO CONTROLLER
Route::get('login','App\Http\Controllers\LoginController@login_form');
//Subimit del login    
Route::post('login','App\Http\Controllers\LoginController@do_login'); 
#REGISTER
Route::get('register','App\Http\Controllers\LoginController@register_form');
//Subimit del register    
Route::post('register','App\Http\Controllers\LoginController@do_register');
#LOGOUT
Route::get('logout','App\Http\Controllers\LoginController@logout');

#HOME--------------------STESSO CONTROLLER
Route::get('home','App\Http\Controllers\HomeController@home');
//Carica i prodotti ordinabili chiamata tramite fetch
Route::get('home/product','App\Http\Controllers\HomeController@product');
//Se metto un parametro con l'accento sulla 'a' la route non viene trovata-FETCH
Route::get('productById/{id}/{quantita}','App\Http\Controllers\HomeController@productById');
//Creo carrello graficamente
Route::get('creaCarrello/{tot}/{tav}','App\Http\Controllers\HomeController@creaCarrello');
//Invio l'ordine al server che lo salva in db
Route::post('creaOrdine/{cart_id}','App\Http\Controllers\HomeController@do_ordine');

#PRODUCT---------------STESSO CONTROLLER
Route::get('products','App\Http\Controllers\ProductController@prodotti');
//Chiamata da fetch
Route::get('products/{search}','App\Http\Controllers\ProductController@cerca');
Route::get('products/img/{search}','App\Http\Controllers\ProductController@cercaImg');

#MONGODB---------------STESSO CONTROLLER
Route::get('menu','App\Http\Controllers\MenuController@menu');
Route::get('menu/mostra','App\Http\Controllers\MenuController@mostra');

?>